
    <?php
	
        	header( "Content-Type: text/html; charset=utf-8" );
    
    	if (isset($_POST["submit"])) {
    		$name = $_POST["name"];
    		$tel = $_POST["tel"];
    		$email = $_POST["email"];
    		$message = $_POST["message"];
    		$human = intval($_POST["human"]);
			$to = file_get_contents('data/other/easy_contactform/mail.txt', true);
		$fromer = file_get_contents('data/other/easy_contactform/sender.txt',true);
    
    $headers = "From: ".$fromer." \r\n";
    $headers .= "Reply-To: ". strip_tags($_POST["email"]) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    		$subject = file_get_contents('data/other/easy_contactform/subject.txt', true);
			
			$fromLabel = file_get_contents('data/other/easy_contactform/fromlabel.txt', true);
			$fromLabelmail = file_get_contents('data/other/easy_contactform/fromlabelmail.txt', true);
			$fromLabelphone = file_get_contents('data/other/easy_contactform/fromlabelphone.txt', true);
			$fromLabelcontent = file_get_contents('data/other/easy_contactform/fromlabelcontent.txt', true);
			$questionfin = file_get_contents('data/other/easy_contactform/questionanswer.txt', true);



			// Program to display URL of current page. 
  
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
$link = "https"; 
else
$link = "http"; 

// Here append the common URL characters. 
$link .= "://"; 

// Append the host(domain name, ip) to the URL. 
$link .= $_SERVER['HTTP_HOST']; 

// Append the requested resource location to the URL 
$link .= $_SERVER['REQUEST_URI']; 
  

 
			

    		$body ="
    
    <div style='max-width:960px;margin:0 auto;'>
			<div style='width:100%;padding:10px;border-radius:5px;background:#eae7d9;border:solid 1px #442727'>
    		<b>$fromLabel</b>$name
    		</div>
			<br />
						<div style='width:100%;padding:10px;border-radius:5px;background:#eae7d9;border:solid 1px #442727'>

    <b>$fromLabelmail </b> $email
    </div>
	<br />
<div style='width:100%;padding:10px;border-radius:5px;background:#eae7d9;border:solid 1px #442727'>
    <b>$fromLabelphone </b> $tel
    </div>
    <br />
    <div style='width:100%;padding:10px;border-radius:5px;background:#eae7d9;border:solid 1px #442727'>

   <b> $fromLabelcontent </b> $message
	</div>
	

	<br>

	<div style='width:100%;padding:10px;border-radius:5px;background:#eae7d9;border:solid 1px #442727'>

<b>URL</b> $link
	</div>
    
    </div>
    ";

    		//Check if simple anti-bot test is correct
    		if ($human !== '"'+$questionfin+'"') {
				echo'<div class="easyContactSendNot">';echo file_get_contents('data/other/easy_contactform/fail.txt'); echo '</div>';

    	
	} else {
		if (mail ($to, $subject, $body,$headers)){
			echo'<div class="easyContactSend">';echo file_get_contents('data/other/easy_contactform/success.txt') ; echo '</div>';
		};
	};

    };
    ?>
    