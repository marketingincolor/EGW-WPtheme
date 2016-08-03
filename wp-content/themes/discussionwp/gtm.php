<?php

//Get the URL
$request_url = $_SERVER["REQUEST_URI"];

//Main Categories
$inActivity = strpos($request_url, '/activity');
$inMedical = strpos($request_url, '/medical');
$inRelationships = strpos($request_url, '/relationships');
$inNutrition = strpos($request_url, '/nutrition');
$inMindSpirit = strpos($request_url, '/mind-spirit');

//Activity Subcategories
$inCycling = strpos($request_url, '/activity/cycling/');
$inDancing = strpos($request_url, '/activity/dancing/');
$inExercise = strpos($request_url, '/activity/exercise/');
$inSports = strpos($request_url, '/activity/sports/');
$inSwimming = strpos($request_url, '/activity/swimming/');
$inTennis = strpos($request_url, '/activity/tennis/');
$inWalkingRunning = strpos($request_url, '/activity/walking-running/');

//Medical Subcategories
$inCholesterol = strpos($request_url, '/medical/cholesterol/');
$inHeartHealth = strpos($request_url, '/medical/heart-health/');
$inSleep = strpos($request_url, '/medical/sleep/');
$inSunProtection = strpos($request_url, '/medical/sun-protection/');

//Relationship Subcategories
$inCareGiving = strpos($request_url, '/relationships/caregiving/');
$inFrienships = strpos($request_url, '/relationships/friendships/');
$inMarriage = strpos($request_url, '/relationships/marriage/');
$inSocial = strpos($request_url, '/relationships/social/');

//Nutrition Subcategories
$inDiningOut = strpos($request_url, '/nutrition/dining-out/');
$inFood = strpos($request_url, '/nutrition/food/');
$inHydration = strpos($request_url, '/nutrition/hydration/');

//Mind & Spirit Subcategories
$inBookReviews = strpos($request_url, '/mind-spirit/book-reviews/');
$inGardening = strpos($request_url, '/mind-spirit/gardening/');
$inHealing = strpos($request_url, '/mind-spirit/healing/');
$inHobbiesInterests = strpos($request_url, '/mind-spirit/hobbies-interests/');
$inHumor = strpos($request_url, '/mind-spirit/humor/');
$inLearning = strpos($request_url, '/mind-spirit/learning/');
$inMeditation = strpos($request_url, '/mind-spirit/meditation/');
$inMentalHealth = strpos($request_url, '/mind-spirit/mental-health/');
$inTechnology = strpos($request_url, '/mind-spirit/technology/');
$inVolunteering = strpos($request_url, '/mind-spirit/volunteering/');
$inYoga = strpos($request_url, '/mind-spirit/yoga/');


//Category Checks
if ($inActivity!==false)
{
    //url contains '/activity'
    $cat_name = 'Activity';
}
else if ($inMedical!==false)
{
    //url contains '/medical'
    $cat_name = 'Medical';
}
else if ($inRelationships!==false)
{
    //url contains '/relationships'
    $cat_name = 'Relationships';
}
else if ($inNutrition!==false)
{
    //url contains '/nutrition'
    $cat_name = 'Nutrition';
}
else if ($inMindSpirit!==false)
{
    //url contains '/nutrition'
    $cat_name = 'Mind & Spirit';
}
else {
	
	$cat_name = 'No Category';
}

//Subcategory Checks
if ($inCycling!==false)
{
    $sub_name = 'Cycling';
}
else if ($inDancing!==false)
{
    $sub_name = 'Dancing';
}
else if ($inExercise!==false)
{
    $sub_name = 'Exercise';
}
else if ($inSports!==false)
{
    $sub_name = 'Sports';
}
else if ($inSwimming!==false)
{
    $sub_name = 'Swimming';
}
else if ($inTennis!==false)
{
	$sub_name = 'Tennis';
}
else if ($inWalkingRunning!==false)
{
	$sub_name = "Walking & Running";
}
else if ($inCholesterol!==false)
{
	$sub_name = "Cholesterol";
}
else if ($inHeartHealth!==false)
{
	$sub_name = "Heart Health";
}
else if ($inSleep!==false)
{
	$sub_name = "Sleep";
}
else if ($inSunProtection!==false)
{
	$sub_name = "Sun Protection";
}
else if ($inCareGiving!==false)
{
	$sub_name = "Caregiving";
}
else if ($inFrienships!==false)
{
	$sub_name = "Friendships";
}
else if ($inMarriage!==false)
{
	$sub_name = "Marriage";
}
else if ($inSocial!==false)
{
	$sub_name = "Social";
}
else if ($inDiningOut!==false)
{
	$sub_name = "Dining Out";
}
else if ($inFood!==false)
{
	$sub_name = "Food";
}
else if ($inHydration!==false)
{
	$sub_name = "Hydration";
}
else if ($inBookReviews!==false)
{
	$sub_name = "Book Reviews";
}
else if ($inGardening!==false)
{
	$sub_name = "Gardening";
}
else if ($inHealing!==false)
{
	$sub_name = "Healing";
}
else if ($inHobbiesInterests!==false)
{
	$sub_name = "Hobbies & Interests";
}
else if ($inHumor!==false)
{
	$sub_name = "Humor";
}
else if ($inLearning!==false)
{
	$sub_name = "Learning";
}
else if ($inMeditation!==false)
{
	$sub_name = "Meditation";
}
else if ($inMentalHealth!==false)
{
	$sub_name = "Mental Health";
}
else if ($inTechnology!==false)
{
	$sub_name = "Technology";
}
else if ($inVolunteering!==false)
{
	$sub_name = "Volunteering";
}
else if ($inYoga!==false)
{
	$sub_name = "Yoga";
}


?>
<script>
window.dataLayer = window.dataLayer || [];
dataLayer.push({
'egwCategory': '<?php echo $cat_name; ?>',
'egwSubcategory' : '<?php echo $sub_name; ?>'
});
</script>


<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-556TBH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-556TBH');</script>
<!-- End Google Tag Manager -->

