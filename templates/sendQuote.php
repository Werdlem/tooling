<?php
require_once "../DAL/settings.php";
 require_once '../lib/swift_required.php';
require_once ('../DAL/DBConn.php');

 //$EMAIL_QUOTE_PU = 'seanrobins@damasco.co.uk';
 //$EMAIL_QUOTE_TO = 'neilblanchard@postpack.co.uk';

 $toolingDal = new tooling();

$data = json_decode(file_get_contents("php://input"));



 $customer = ucwords($data->customer);
 $sales = $data->sales_man;
 $quote_ref = $data->details[0]->quote_ref;
 $leadTime = $data->leadTime;
$deliveryCharges = $data->deliveryCharges;

$greeting = 'We have the pleasure of quoting for your packaging requirements as follows;';

$disclaimer = 'Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotations are valid for 30 days from above date and are subject to our terms and contions of sale, copies of which are avaliable on request. Additional tooling/plate charges may apply for diecuts and printed products. Stock can be held by us for call off as requested prior agreement.';

$footer = '<p>This message (and any associated files) is intended only for the use of the individual or entity to which it is addressed and may contain information that is confidential, subject to copyright or constitutes a trade secret. If you are not the intended recipient you are hereby notified that any dissemination, copying or distribution of this message, or files associated with this message, is strictly prohibited. If you have received this message in error, please notify us immediately by replying to the message and deleting it from your computer. Messages sent to and from us may be monitored.</p>

<p>Internet communications cannot be guaranteed to be secure or error-free as information could be intercepted, corrupted, lost, destroyed, arrive late or incomplete, or contain viruses. Therefore, we do not accept responsibility for any errors or omissions that are present in this message, or any attachment, that have arisen as a result of e-mail transmission. If verification is required, please request a hard-copy version. Any views or opinions presented are solely those of the author and do not necessarily represent those of the company.</p>';

if(property_exists($data, "comment1")){
	$comment1 = $data->comment1;
}
else{$comment1='';
}

if(property_exists($data, "comment2")){
	$comment2 = $data->comment2;
}
else{$comment2='';
}

if(property_exists($data, "comment3")){
	$comment3 = $data->comment3;
}
else{$comment3='';
}



$EMAIL_QUOTE_TO = strtolower($data->email);
 $EMAIL_QUOTE_FROM = strtolower($data->salesEmail);


 $img = '<img src="../Css/images/emailSig.png">';

 function quoteDetails($data){
 	$output = '';
 	foreach($data->details as $item){
 		$output.='<tr>
 		<td style="border:1px solid black; text-align: center">'. $item->description.'</td>
 		<td style="border:1px solid black; text-align: center">'. $item->ref.'</td>
 		<td style="border:1px solid black; text-align: center">'. $item->size.'</td>
 		<td style="border:1px solid black; text-align: center">'. $item->qty.'</td>
 		<td style="border:1px solid black; text-align: center">£'. $item->unit_price.'</td>
 		</tr>';
 	}
 	return $output;
 }

function quoteComments(){
	$output = '';
	$output.='<p>'.$comment1.'</p>
				<p>'.$comment2.'</p>
				<p>'.$comment3.'</p>';
return $output;
}


 	
	//Create the transport

			$transport = Swift_SmtpTransport::newInstance('mail', 25);
			//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
			//->setUsername($user)->setPassword($pass);			
			$mailer = Swift_Mailer::newInstance($transport);				
			$message = Swift_Message::newInstance('Customer Quotation');
			$message->setSubject('Quote Ref:'.$quote_ref);
			$message->setFrom($EMAIL_QUOTE_FROM);
			$message->setCc($EMAIL_QUOTE_FROM);
			try{
			$message->setTo($EMAIL_QUOTE_TO);
		}
		catch(Swift_RfcComplianceException $e){
			die("EMAIL FAILED!!: " . $e->getMessage());
		}
			//->attach(Swift_Attachment::fromPath('../Css/images/emailSig.png')->setDisposition('inline'))
			
			//Order Body//
			$message->setBody('<html>
				<div ng-controller="customerQuote as c">'.
                '<head>'.
                '<body>
                <style type="text/css">
                body, p {
                	font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
                }

	.headders{background-color: #fd6b6b}
	th,td{border:1px solid black; text-align: center
}
	
</style></head>'.
               '<p>Dear '.$customer.',</p>
<p>'.$greeting.'</p>

		<table ng-model="send_quote" style="margin-bottom: 20px;table-layout:fixed; width: 80%">
			<thead>
			<tr>
				<th colspan="1" scope="colgroup"style="border:1px solid black;border:1px solid black; text-align: center; padding: 8px;">Date: <p>'. date('d/m/Y').'</p></th>
				<th colspan="3" scope="colgroup"style="border:1px solid black;border:1px solid black; text-align: center; padding: 8px;"><h3>Quotation</h3></th>
				<th colspan="1" scope="colgroup"style="border:1px solid black;border:1px solid black; text-align: center; padding: 8px;">Quote Ref: <p>'.$quote_ref.'</p></th>				
			</tr>
			<tr class="headders" style="background-color: #fd6b6b;">
				<th style="border:1px solid black; text-align: center">Product Description</th>
				<th style="border:1px solid black; text-align: center">Product Ref</th>
				<th style="border:1px solid black; text-align: center">Size</th>
				<th style="border:1px solid black; text-align: center">Quantity</th>
				<th style="border:1px solid black; text-align: center">Unit</th>
				</tr>
		</thead>
		<tbody class="quotes" 
    >
			'.quoteDetails($data).'
		<th colspan="6" scope="colgroup"style="border:1px solid black; text-align: center">'.$disclaimer.'</th>
	</tbody>

		</table>
		<p>Delivery lead time for the above: '.$leadTime.'.</p>
		<p>Delivery charges: '.$deliveryCharges.'.</p>
		<p>'.$comment1.'</p>
				<p>'.$comment2.'</p>
				<p>'.$comment3.'</p>
		<p>I look forward to hearing your thoughts and would be delighted to answer any questions you may have.</p>
		<p>Kind Regards,</p>
		<p>'.$sales.'</p>'.
		'</div>'.'
		<p>Tel: 0845 071 0754
<br>Fax: 0845 071 0759
<br>www.postpack.co.uk
 

<br>Registered in England No. 444 6988
<br>VAT Reg No. 796 7468 51
<br>Registered Office: Unit 4, Hollis Road, Grantham, Lincs. NG31 7QH

'.$footer.'
                '.'</body>' .
                '</html>',
                'text/html');
		try{
		$result = $mailer->send($message);
	}
	catch(\Swift_TransportException $te) {
		die("$te->getMessage: ". $te->getMessage());
	}
		$toolingDal->quoteSent($quote_ref);
			

			
