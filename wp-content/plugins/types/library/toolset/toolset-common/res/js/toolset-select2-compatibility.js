/*
 * This module is for hijacking select2 4.0 prototype to make it compatible with select2 2.0 method calling
 */

var ToolsetCommon = ToolsetCommon || {};

ToolsetCommon.initSelect2Compatibility = function( $ ){
	if(!jQuery().select2)
		return
	//preserve original select2 object
	jQuery.fn.select2_original = jQuery.fn.select2;
	//backwards compatible object
	jQuery.fn.select2  = function(options, param){
		if(typeof options == "string"){
			ToolsetCommon.select2ExecMethods(this, options, param)
		}else if (typeof options == "object"){
			if(jQuery(this)){
				return ToolsetCommon.select2ConvertInputToSelect(jQuery(this), options);
			}
		}else if(options === null || options === undefined){
			if(jQuery(this)){
				return ToolsetCommon.select2ConvertInputToSelect(jQuery(this));
			}
		}
	};
};
/*
 * @description convert ordinary inputs to select elements, and apply select2 to them.
 */
ToolsetCommon.select2ConvertInputToSelect = function(el, options){
	if(ToolsetCommon.select2ConversionRequired(el, options) && typeof el[0] != "string" && el[0] !== undefined){
		//check if the element isn't previously initailized to prevent duplicate elements
		if(jQuery(el).data("select2"))
			return el;

		//create a select element to replace the normal input
		var convertedEl = jQuery("<select></select>");
		
		//if is a tags field create a hidden input to hold value for backwards compatibility with v2
		if(options && options.hasOwnProperty("tags") && options.tags){
			var hiddenInput = jQuery("<input type='hidden' />");
		}

		//copy all attributes to the new select element
		jQuery.each(jQuery(el).get(0).attributes, function() {
		    if(hiddenInput && this.specified && (this.name == "name" || this.name == "class")){
		    	jQuery(hiddenInput).attr(this.name, this.value);
		    }
		    if(this.specified && this.name != "type") {
		      jQuery(convertedEl).attr(this.name, this.value);
		    }
		});
		
		//create dynamicClass with select2 prefix and add to the new element to be able to reference the element in the future
		var dynamicClass = ToolsetCommon.addSelect2RandomClassName(convertedEl);
		var hiddenDynamicClass = ToolsetCommon.addSelect2RandomClassName(hiddenInput);

		//remove the old input and replace it with the new select
		jQuery(el).replaceWith(convertedEl);
		jQuery(el).remove();

		//Insert the hidden input after the select
		if(hiddenInput){
			jQuery(hiddenInput).insertAfter("."+dynamicClass);
		}
		//initialize select2
		convertedEl = jQuery("."+dynamicClass).select2_original(options);

		//Add event listener on tags fields to update hidden inputs on change
		if(options && options.hasOwnProperty("tags")){
			jQuery(convertedEl).on("change", function(){
				var actualValue = jQuery(convertedEl).val();

				if(actualValue && actualValue.length > 0 && hiddenInput){
					jQuery("."+hiddenDynamicClass).attr("value", actualValue.join(","));
				}
			});
			jQuery("."+dynamicClass).trigger("change");
		}
		return convertedEl;
	}else{
		var dynamicClass = ToolsetCommon.addSelect2RandomClassName(el);
		return jQuery("."+dynamicClass).select2_original(options);
	}
};
/*
 * @description checks if input needs to be converted to a select element.
 */
ToolsetCommon.select2ConversionRequired = function(el, options){
	if(options && options.hasOwnProperty("tags")){
		jQuery(el).prop("multiple", "multiple");
		options.multiple = true;
		if(options.tags instanceof Array && options.tags.length > 0){
			options.data = [];
			options.tags.forEach(function(item){
				options.data.push({
					id: item,
					text: item
				});
			});
			options.tags = true;
		}
		return true;
	}else{
		return (jQuery(el).prop("tagName") !== "SELECT");
	}
};

/*
 * @description executes select2 methods after filtering deprecated ones, and applying compatible replacement.
 */

ToolsetCommon.select2ExecMethods = function(el, method, param){
	if(jQuery(el).data("select2")){
		var elm_id = jQuery(el).attr("id");
						console.log(method);

		switch(method){
			case "val":
				if(param !== undefined && param !== null){
					jQuery(el).val(param).trigger("change");
				}else{
					return jQuery(el).val();
				}
			break;
			case "enable":
				jQuery(el).prop("disabled", !param);
			break;
			case "data":
				jQuery(el).val(param.ID).trigger("change").trigger("select2:selecting");
			break;
			case "close":
				jQuery(el).select2_original("close");
				break;
			default:
				jQuery("#"+elm_id).select2_original(method, param);
			break;
		}
	}
};

/*
 * @description creates and adds dynamic class name to the element.
 */
ToolsetCommon.addSelect2RandomClassName = function(el) {
    var className = ("select2_prefix_" + (Math.round(Math.random() * (100000 - 99) + 99)).toString()); 
    jQuery(el).addClass(className);
    return className;
};

/*
 * @description start the compatibility listener on document ready.
 */
jQuery(document).ready(function($){ ToolsetCommon.initSelect2Compatibility(); });