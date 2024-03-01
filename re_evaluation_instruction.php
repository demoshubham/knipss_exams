<?php
set_time_limit(0);
//session_cache_limiter('nocache');
//session_start();
include("settings.php");
include("exam_crosslist_marksheet_functions.php");
 page_header();
$response=1;
$msg='';
?>
<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 300px;
  background-color: #f1f1f1;
}

li a {
  display: block;
  color: #000;
  padding: 10px 16px;
  text-decoration: none;
  font-size:20px;
  text-align:left;
}



li a:hover:not(.active) {
  background-color: blue;
  color: white;
}
li a.active {
  background-color: blue;
  color: white;
}
</style>
</head>
<body>
<style>
  .imgs{
    /* box-shadow:1px 1px 1px #222; */
    margin-bottom:2rem;
  }
</style>
<div class="d-flex justify-content-center " style="gap:1rem;">
<ul>
  <li><a  href="#home" class="active">Instructions</a></li>
  <li><a href="re_evaluation_notification.php">Notification</a></li>
  <li><a href="re_evaluation_reg.php">Click To Registration</a></li>
  <li><a href="re_evalucation_reprint_application_view_scanned.php">Reprint Application</a></li>
  <li><a href="re_evalucation_reprint_application_view_scanned.php">View Scanned Copy</a></li>
  <li><a href="#about">Check Payment Status</a></li>
  <li><a href="index.php">Go to Home</a></li>
</ul>
<div id="container" width="70%">
	<div class="row " style="width:98%;text-align:justify;">
		<section class="content-header">
			<h1 style="color: #000!important;">Online Application of Inspection of Answer Book</h1> <br>
		</section>
		<section class="content-header" style="margin-top: -25px">
			<h5 style="font-size: 20px; font-weight: 600;margin:1rem;">GENERAL Instructions</h3>
		</section>
    <div class="text-center " style="font-size:1rem;font-weight: 600;">जनसूचना अधिकार अधिनियम-२००५ के अंतर्गत परीक्षार्थियों को उनकी उत्तर पुस्तिकाएं अवलोकित कराये जाने की प्रक्रिया हेतु निर्देश
    </div>
    <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">प्रथम चरण -: <br>
१- उपरोक्त प्रक्रिया के आवेदन हेतु अभ्यर्थी को प्रथम चरण में Click to Registration पर जाकर वंक्षित सूचनाओं यथा Roll No, EMail, Mobile Number & Course को पूरित करते हुए verify details को सबमिट करना होगा |
    </div>
      <div class="imgs">
        <img src="images/recheck/a.png" alt="First Step" class="img-fluid">
      </div>
      
    <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">2- सफलतापूर्वक वंक्षित सूचनाओं के पूरित करने के उपरांत अभ्यर्थी को ऑनलाइन आवेदन करने हेतु उसके स्क्रीन पर स्वतः दर्शित होंगे. जिसमे अभ्यर्थी को उसके द्वारा लिए गए पाठ्यक्रम के किसी एक विषय के एक प्रश्न पत्र का चयन करना होगा|
    </div>
      <div class="imgs">
        <img src="images/recheck/b.png" alt="First Step" class="img-fluid">
      </div>


      <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">3- अभ्यर्थी को Answer Books Viewing के लिए किसी एक प्रश्न पत्र को सेलेक्ट करने हेतु Check Box पर Tick करना होगा एवं Terms & Condition Check Box को Tick करना होगा. उसके उपरांत Proceed to Pay Button पर क्लिक कर शुल्क का भुगतान करना होगा|
    </div>
      <div class="imgs">
        <img src="images/recheck/c.png" alt="First Step" class="img-fluid">
      </div>
      <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">4- सफलतापूर्वक विवरणों के चयन एवं ऑनलाइन शुल्क जमा होने के उपरांत उपरांत अभ्यर्थी द्वारा किये गए आवेदन के सापेक्ष प्रिंट आउट में एक Application Number प्राप्त होगा.|
    </div>
      <div class="imgs">
        <img src="images/recheck/d.png" alt="First Step" class="img-fluid">
      </div>
      <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">5- सफलतापूर्वक Application Number Generate होने के उपरांत 30 कार्य दिवस के पश्चात निर्धारित पोर्टल पर View Scanned Copy लिंक पर क्लिक करने पर वंक्षित सूचनाओं के पूरित होने के उपरांत अभ्यर्थी को उसके आवेदन के सापेक्ष उत्तर पुस्तिकाएं विश्वविद्यालय द्वारा अगले 30 दिनों तक अवलोकन किये जाने हेतु उपलब्ध होंगी|
    </div>
      
      <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">नोट : यदि अभ्यर्थी एक से अधिक प्रश्न पत्रों के लिए उपरोक्त प्रक्रिया का इच्छुक है तो उसे पृथक पृथक रूप से आवेदन करना होगा|
    </div>
          
<!---Student info section-------------------------------------------------------------------------------------------------------------------------------->
				
				<div style=" width:95%;">
					
			</div>	
	</div>
</div> 
</div>



</body>
</html>


<?php 

	page_footer();
	ob_end_flush();
?>

