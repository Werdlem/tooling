 <?php
require_once "../DAL/settings.php";
 require_once '../lib/swift_required.php';

 $EMAIL_QUOTE_PU = 'seanrobins@damasco.co.uk';
 $EMAIL_QUOTE_TO = 'neilblanchard@postpack.co.uk';
     
	//Create the transport
			$transport = Swift_MailTransport::newInstance(SMTP_HOST, SMTP_PORT);
			//$transport = Swift_MailTransport::newInstance('smtp.gmail.com', 465);
			$mailer = Swift_Mailer::newInstance($transport);			
			$message = Swift_Message::newInstance('Please Order')
			->setSubject('Quote Test')
			->setFrom($EMAIL_QUOTE_PU)
			->setCc($EMAIL_QUOTE_PU)
			->setTo($EMAIL_QUOTE_PU)
			
			//Order Body//
			
			->setBody('test mail sent'
            );
		
			
			$result = $mailer->send($message);
