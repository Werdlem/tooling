 <?php
// require_once "DAL/settings.php";
 require_once 'lib/swift_required.php';

 $EMAIL_ORDERS_PU = 'seanrobins@damasco.co.uk';
 $EMAIL_QUOTE_TO = 'neilblanchard@postpack.co.uk';
     
	//Create the transport
			//$transport = Swift_MailTransport::newInstance(SMTP_HOST, SMTP_PORT);
			$transport = Swift_MailTransport::newInstance('smtp.gmail.com', 465);
			$mailer = Swift_Mailer::newInstance($transport);			
			$message = Swift_Message::newInstance('Please Order')
			->setSubject('Quote Test')
			->setFrom($EMAIL_ORDERS_PU)
			->setCc($EMAIL_ORDERS_PU)
			->setTo($EMAIL_QUOTE_PU)
			
			//Order Body//
			
			->setBody('<html>'.
                '<head>Hello<br /><br /></head>'.
                '<body>'.
                'Please will you kindly order '. $qty . '(qty) <a href="http://postpackstock.web/index.php?action=activity&sku=' .$product.'&sku_id='.$sku_id.
                '">'.$product.'</a><br /><br />Kind Regards<br /><br />'.
                'PostPack'.
                '</body>' .
                '</html>',
                'text/html'
            );
			
			//$numSent = $mailer->send($message);
			//printf("Send %d messages\n", $numSent);
			
			$result = $mailer->send($message);
			if ($result > 0)
			{
				$productDal->sku_order($today, $sku);
				
				echo "<div class='panel panel-success'>
<div class='panel-heading' style='text-align:center;'><h3>Order Success!</h3></div>
<div class='panel-body'>
				Your order of ".$product . " has been successfully sent, have a nice day :-D"
				?>
				
				<button onclick='goBack()'>Go Back</button>

				<script>
						function goBack() {
   						 window.history.back();
				}
						</script>
				</div></div>
			<?php
            }
            else{
				
				echo "<div class='panel panel-danger'>
<div class='panel-heading' style='text-align:center;'><h3>Order Failure</h3></div>
<div class='panel-body'>
				<p>Your order of <strong style='red'><a href='?action=activity&sku=". $product ."&sku_id=".$sku_id."'> ".$product." </strong> was not sent, please call the office with your order.</p>
				</div></div>";
				
				}
 ?>
			
