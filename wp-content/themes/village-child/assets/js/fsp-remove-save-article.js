
/*   
 * Author: Muthupandi
 * Date: June 24,2016
 */
jQuery(document).ready( function($) {
    $('.fsp_remove_btn').live('click', function() {
        
        dhis = $(this);
        url = document.location.href.split('#')[0];       
        params = dhis.attr('href').replace('?', '') + '&ajax=1';
         location.reload(); 
          jQuery.ajax({
             url: url,
             data:params,
             success:function(){
                location.reload(); 
             }             
          });
        return false;
    });
        
});


    
