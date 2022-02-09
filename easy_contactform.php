<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
	$thisfile, //Plugin id
	'Easy_ContactForm', 	//Plugin name
	'3.0', 		//Plugin version
	'Mateusz Skrzypczak',  //Plugin author
	'https://multicolor.stargard.pl/', //author website
	'Easy Contact form for your page', //Plugin description
	'pages', //page type - on which admin tab to display
	'contactFormSettings'  //main function (administration)
);
 
# activate filter 


add_action('theme-header','contactPHP'); 


register_script('contactFormJS', $SITEURL.'plugins/easy_contactform/js/scriptcontactform.js', '2.0', TRUE);
queue_script('contactFormJS',GSBACK); 

register_style('contactFormStyle', $SITEURL.'plugins/easy_contactform/css/stylecontactform.css', '2.0', 'screen');
queue_style('contactFormStyle',GSBOTH); 

# add a link in the admin tab 'theme'
add_action('pages-sidebar','createSideMenu',array($thisfile,'Easy_contactForm settings'));
 
# functions

function contactPHP(){
    include('easy_contactform/form.php');
}

function TurnOnContact(){

}




 
function contactFormSettings() {



	echo '<form action="#" method="POST">

	<label for="sender">email sender</label><br>
<input type="mail" style="width:100%;padding:10px;box-sizing:border-box;" name ="sender" value="';
	echo @file_get_contents( '../data/other/easy_contactform/sender.txt');
	echo '">
	
	<label for="easyFormMail" style="margin-top:20px">to what mail to deliver the message? (example@mail.com, example2@mail.com) </label><br>
<input type="mail" style="width:100%;padding:10px;box-sizing:border-box;" name ="easyFormMail" value="';
	echo @file_get_contents('../data/other/easy_contactform/mail.txt');
	echo '">
	<label for="easyFormSubject" style="margin-top:20px">Subject message from website</label><br>
	<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name ="easyFormSubject" value="';	
	echo @file_get_contents('../data/other/easy_contactform/subject.txt'); echo '">
	<label for="sentmessageinfo" style="margin-top:20px">text when for message send success</label><br>
	<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name ="sentmessageinfo" value="';	
	echo @file_get_contents('../data/other/easy_contactform/success.txt'); echo '">

	<label for="failmessageinfo" style="margin-top:20px">text when for message not send success</label><br>
	<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name ="failmessageinfo" value="';	
	echo @file_get_contents('../data/other/easy_contactform/fail.txt'); echo '">
<br><br>
	<label for="questionanswer"> Question answer </label>
	<br>
	<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name="questionanswer" value="'; echo @file_get_contents('../data/other/easy_contactform/questionanswer.txt'); echo '">

	<br>	<br>
	<h3>label inside email </h3>

	<label for="fromlabel">from label</label>
	<br>
	<input type="text" name="fromlabel" style="width:100%;padding:10px;box-sizing:border-box;" value="'; echo @file_get_contents('../data/other/easy_contactform/fromlabel.txt'); echo '">
	<br><br>
	<label for="fromlabelmail">mail label</label>
	<br>
	<input type="text" name="fromlabelmail" style="width:100%;padding:10px;box-sizing:border-box;" value="'; echo @file_get_contents('../data/other/easy_contactform/fromlabelmail.txt'); echo '">

	<br><br>

	<label for="fromlabelphone">phone label</label>
	<br>
	<input type="text" name="fromlabelphone" style="width:100%;padding:10px;box-sizing:border-box;" value="'; echo @file_get_contents('../data/other/easy_contactform/fromlabelphone.txt'); echo '">

	<br><br>

	<label for="fromlabelcontent">content label</label>
	<br>
	<input type="text" name="fromlabelcontent" style="width:100%;padding:10px;box-sizing:border-box;" value="'; echo @file_get_contents('../data/other/easy_contactform/fromlabelcontent.txt'); echo '">




	<input type="submit" name="submit" style="padding:10px 15px;margin-top:10px;background:#000;color:#fff;border:none;" value="save settings">
	</form>
	
	
<p style="margin:0;margin-top:20px;">    Created by <a href="mail:skrzypczak.design@gmail.com">Multic0lor</a> Thanks for 
</p>
    <hr style="margin-top:10px;border:none;border-bottom:solid 1px rgba(0,0,0,0.3)">

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:flex; width:100%;align-items:center;justify-content:space-between;">
        <p style="margin:0;padding:0;">If you want support my work  via paypal :) Thanks!</p>
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        <img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
        </form>
	';


	// Set up the data

// Set up the folder name and its permissions
// Note the constant GSDATAOTHERPATH, which points to /path/to/gsetsimple/data/other/
$EasyContactFormFolder        = GSDATAOTHERPATH . '/easy_contactform/';
$mailname      = $EasyContactFormFolder   . 'mail.txt';
$subject      = $EasyContactFormFolder   . 'subject.txt';
$successfile      = $EasyContactFormFolder   . 'success.txt';
$failfile      = $EasyContactFormFolder   . 'fail.txt';
$senderfile     = $EasyContactFormFolder   . 'sender.txt';
$questionanswerfile     = $EasyContactFormFolder   . 'questionanswer.txt';

$fromLabelfile = $EasyContactFormFolder . 'fromlabel.txt';
$fromLabelmailfile = $EasyContactFormFolder . 'fromlabelmail.txt';
$fromLabelphonefile = $EasyContactFormFolder . 'fromlabelphone.txt';
$fromLabelcontentfile = $EasyContactFormFolder . 'fromlabelcontent.txt';

$chmod_mode    = 0755;
$folder_exists = file_exists($EasyContactFormFolder) || mkdir($EasyContactFormFolder,$chmod_mode);
 
// Save the file (assuming that the folder indeed exists);
if( isset($_POST["submit"]) ){

$maildata = $_POST["easyFormMail"];
$sentmessageinfo = $_POST["sentmessageinfo"];
$failmessageinfo = $_POST["failmessageinfo"];
$easyFormSubject = $_POST["easyFormSubject"];
$sender = $_POST["sender"];
$questionanswer = $_POST["questionanswer"];
$fromlabel = $_POST["fromlabel"];
$fromlabelmail = $_POST["fromlabelmail"];
$fromlabelphone = $_POST["fromlabelphone"];
$fromlabelcontent = $_POST["fromlabelcontent"];

if ($folder_exists) {
  file_put_contents($mailname, $maildata);
  file_put_contents($subject , $easyFormSubject);
  file_put_contents($successfile , $sentmessageinfo);
  file_put_contents($failfile , $failmessageinfo);
  file_put_contents($senderfile , $sender);
  file_put_contents($fromLabelfile,$fromlabel);
  file_put_contents($fromLabelmailfile,$fromlabelmail);
  file_put_contents($fromLabelphonefile,$fromlabelphone);
  file_put_contents($fromLabelcontentfile,$fromlabelcontent);
  file_put_contents($questionanswerfile,$questionanswer);
  echo "<meta http-equiv='refresh' content='0'>";

};
};

}
?>