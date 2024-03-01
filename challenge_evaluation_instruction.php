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
<!-- <ul>
  <li><a  href="#home" class="active">Instructions</a></li>
  <li><a href="re_evaluation_notification.php">Notification</a></li>
  <li><a href="re_evaluation_reg.php">Click To Registration</a></li>
  <li><a href="re_evalucation_reprint_application_view_scanned.php">Reprint Application</a></li>
  <li><a href="re_evalucation_reprint_application_view_scanned.php">View Scanned Copy</a></li>
  <li><a href="#about">Check Payment Status</a></li>
  <li><a href="index.php">Go to Home</a></li>
</ul> -->
<ul>
  <li><a  href="challenge_evaluation_instruction.php" class="active">Instructions</a></li>
  <li><a href="challenge_notification.php">Notification</a></li>

  <li><a href="challenge_evaluation_reg.php">Click To Registration</a></li>
  <li><a href="#about">Reprint Application</a></li>
  <li><a href="#about">View Scanned Copy</a></li>
  <li><a href="#about">Check Payment Status</a></li>
  <li><a href="index.php">Go to Home</a></li>
</ul>
<div id="container" width="70%">
	<div class="row  " style="width:98%;text-align:justify;">
		<section class="content-header">
			<h1 style="color: #000!important;">Online Application of Inspection of Answer Book</h1> <br>
		</section>
		<section class="content-header" style="margin-top: -25px">
			<h5 style="font-size: 20px; font-weight: 600;margin:1rem;">GENERAL Instructions</h3>
		</section>
        <div class="text-center " style="font-size:1rem;font-weight: 600;">मूल्यांकन को चुनौती</div>
        <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">१- उपरोक्त प्रक्रिया के आवेदन हेतु अभ्यर्थी को प्रथम चरण में Click to Registration पर जाकर वंक्षित Application Number (Inspection of Copy), Bank Reference Number & Roll Number सूचनाओं को पूरित करते हुए verify details को सबमिट करना होगा
        </div>
        <div class="imgs">
            <img src="images/recheck/e.png" alt="First Step" class="img-fluid">
        </div>
        
        <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">2- सफलतापूर्वक वंक्षित सूचनाओं के पूरित करने के उपरांत अभ्यर्थी को मूल्यांकन को चुनौती हेतु ऑनलाइन आवेदन करने हेतु उसके स्क्रीन पर स्वतः दर्शित होंगे एवं अभ्यर्थी को Terms & Condition Check Box को Tick करना होगा. उसके उपरांत Proceed to Pay Button पर क्लिक कर शुल्क का भुगतान करना होगा|
        </div>
        <div class="imgs">
            <img src="images/recheck/f.png" alt="First Step" class="img-fluid">
        </div>


        <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">3- अभ्यर्थी को मूल्यांकन को चुनौती हेतु Terms & Condition Check Box को Tick करना होगा. उसके उपरांत Proceed to Pay Button पर क्लिक कर शुल्क का भुगतान करना होगा|
        </div>
        <div class="imgs">
            <img src="images/recheck/c.png" alt="First Step" class="img-fluid">
        </div>
        <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">4- सफलतापूर्वक विवरणों के चयन एवं ऑनलाइन शुल्क जमा होने के उपरांत उपरांत अभ्यर्थी द्वारा किये गए आवेदन के सापेक्ष प्रिंट आउट में एक Application Number प्राप्त होगा|
        </div>
        <div class="imgs">
            <img src="images/recheck/g.png" alt="First Step" class="img-fluid">
        </div>
        <div class="text-center " style="font-size:1rem;font-weight: 600;">मूल्यांकन को चुनौती करने वाले अभ्यर्थियों हेतु आवश्यक निर्देश</div>

        <div style="font-size:0.8rem;font-weight: 600;margin:1rem;">महाविद्यालय  की वार्षिक एवं सेमेस्टर परीक्षाओं में उत्तर पुस्तिकाओं की संख्या अत्यधिक होने के कारण उत्तर पुस्तिकाओं की गुणवत्तापरक मूल्यांकन सम्बन्धी प्रत्यावेदन, परीक्षाफल निर्माण त्रुटिपूर्ण होने तथा उत्तर पुस्तिकाओं की स्क्रूटनी हुेतु बहुतायत में छात्रों के आवेदन पत्र प्राप्त होते है। महाविद्यालय  में केन्द्रीयत रूप से कतिपय कोडेड एवं अधिकांशतः सामान्य प्रक्रिया के अन्तर्गत उत्तर पुस्तिकाओं के मूल्यांकन कराये जाने की व्यवस्था वर्तमान में प्रचलित है। मूल्यांकन की सतत् गुणवत्ता सुनिश्चित किये जाने हेतु मूल्यांकनकर्ताओं मेें मूल्यांकन कार्य के प्रति संवेदनशीलता एवं उत्तरदायित्व बढ़ाया जाना नितांत आवश्यक है। उक्त के अतिरिक्त छात्रों द्वारा समय‘-समय पर मूल्यांकित उत्तर पुस्तिकाएं आर.टी.आई के अन्तर्गत भी उपलब्ध कराये जाने हेतु आवेदन पत्र प्राप्त होते है, छात्रों को आर.टी.आई/स्क्रूटनी के अन्र्तगत उपलब्ध करायी गयी उत्तर पुस्तिकाओं में अनेकों ऐसे प्रकरण प्रकाश में आये है, जिनमें छात्रों ने मूल्यांकनकर्ता/शिक्षकों द्वारा किये गये अंको पर अंसतोष व्यक्त किया है तथा मूल्यांकनकर्ता से इतर विषय विशेषज्ञों का अभिमत प्राप्त करने पर यह पाया गया है कतिपय मूल्यांकनकर्ताओं द्वारा न्यायसंगत मूल्याकंन नही किया गया है। महाविद्यालय  में उत्तर पुस्तिकाओं के पुनर्मल्यांकन की व्यवस्था न होने तथा समुचित मूल्यांकन न होने के कारण अनेकों प्रकरणों में परीक्षार्थियांे/छात्रों का अहित हो जाता है। उपरोक्त तथ्यों के दृष्टिगत छात्रहित में उत्तर पुस्तिका के अवलोकन के उपरान्त मूल्यांकन से असन्तुष्ट छात्रों को चैलेंज इवैलुवेशन (मूल्यांकन को चुनौती) का अवसर प्रदान किये जाने की व्यवस्था निम्नानुसार प्रस्तावित की जाती हैः-
        <ol>
            <li>छात्र जनसूचना का अधिकार अधिनियम-2005 के अन्तर्गत उत्तर पुस्तिका अवलोकित कराये जाने की प्रक्रिया का अनुसरण करते हुए मूल्यांकित उत्तरपुस्तिका की स्कैन्ड कापी प्राप्त करेगा।</li>
            <li>उत्तर पुस्तिका के अवलोकन से असन्तुष्ट छात्र उत्तर पुस्तिका प्राप्ति की तिथि से 30 दिन के अन्दर रू॰ 2500/- प्रति प्रश्नपत्र की दर से देय शुल्क का भुगतान कर चैंलेज इवैलुवेशन के लिए आवेदन कर सकेगा।</li>
            <li>सम्बन्धित उत्तर पुस्तिका का मूल्यांकन मूल मूल्याकनकर्ता से इतर माननीय कुलपति जी द्वारा नामित दो चैलेंज मूल्यांकनकर्ताओं द्वारा अलग-अलग कराया जायेगा तथा दोनों मूल्यांकनकर्ताओं द्वारा प्रदत्त अंको का औसत चुनौती देने वाले छात्र को प्रदान किया जायेगा।</li>
            <li>
            यदि मूल मूल्यांकनकर्ता द्वारा प्रदान किये गए अंको तथा दोनों चैलेंज मूल्यांकनकर्ता द्वारा किये गये अंको के औसत का अन्तर प्रश्नपत्र के अधिकतम प्राप्तांको के 30 तक पाया जायेगा तो मूल मूल्यांकनकर्ता द्वारा प्रदान किए गये अंको में परिवर्तन नही किया जायेगा तथा छात्र द्वारा जमा धनराशि जब्त कर ली जाएगी।
            </li>
            <li>यदि मूल मूल्यांकनकर्ता द्वारा प्रदान किए गये अंको तथा चैलेंज मूल्यांकनकर्ताओं द्वारा दिये गये अंको के औसत का अन्तर प्रश्नपत्र के अधिकतम प्राप्तांको के 30 से अधिक एवं 45 तक पाया जाएगा तो मूल मूल्यांकनकर्ता द्वारा प्रदान किए गए अंको को दोनो चैलेंज मूल्यांकनकर्ताओं द्वारा दिए गय अंको से बदल दिया जाएगा। ऐसी स्थिति में छात्र द्वारा जमा शुल्क रू॰ 250/- की कटौती कर शेष राशि उसे वापस कर दी जाएगी तथा मूल्यांकनकर्ता के खिलाफ महाविद्यालय  द्वारा चेतावनी दी जा सकती है।</li>
            <li>यदि मूल मूल्यांकनकर्ता द्वारा प्रदान किए गए अंको तथा दोनों चैलेंज मूल्यांकनकर्ताओं द्वारा दिये गये अंको के औसत का अन्तर प्रश्नपत्र के अधिकतम प्राप्तांको के 30 से अधिक पाया जाएगा तो ऐसी उत्तर पुस्तिका को माननीय कुलपति जी द्वारा नामित तृतीय चैलेंज मूल्याकंनर्ता से मूल्यांकित कराया जाएगा। मूल मूूल्यांकनकर्ता द्वारा प्रदान किए गए अंको को तीना चैलेंज मूल्यांकनकर्ताओं द्वारा दिए गये अंको के औसत से बदल दिया जायेगा। ऐसी स्थिति में छात्र द्वारा जमा शुल्क से रू॰ 250/- की कटौती कर शेष धनराशि उसे वापस कर दी जायेगी तथा मूल मूल्यांकनकर्ता के खिलाफ महाविद्यालय  द्वारा कठोर कार्यवाही की जा सकती है।</li>
            <li>
            चैलेंज प्रक्रिया में यदि उपरोक्त बिन्दु 5 एवं 6 में परिवर्तन आता है, तो छात्र के परीक्षाफल में तद्नुसार संशोधन करते हुए सम्पूर्ण परीक्षाफल तद्नुसार संशोधन करते हुए सम्पूर्ण परीक्षाफल तद्नुसार घोषित किया जायेगा।
            </li>
        </ol>
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

