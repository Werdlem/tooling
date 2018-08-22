<?php
require_once "../DAL/settings.php";
 require_once '../lib/swift_required.php';
require_once ('../DAL/DBConn.php');

 $EMAIL_QUOTE_PU = 'seanrobins@damasco.co.uk';
 $EMAIL_QUOTE_TO = 'neilblanchard@postpack.co.uk';

 $toolingDal = new tooling();

$data = json_decode(file_get_contents("php://input"));



 $customer = ucwords($data->details[0]->customer);
 $sales = $data->details[0]->sales;
 $quote_ref = $data->details[0]->quote_ref;
 $leadTime = $data->leadTime;
 //$EMAIL_QUOTE_TO = strtolower($data->details[0]->email);

 function quoteDetails($data){
 	$output = '';
 	foreach($data->details as $item){
 		$output.='<tr>
 		<td>'. $item->description.'</td>
 		<td>'. $item->ref.'</td>
 		<td>'. $item->size.'</td>
 		<td>'. $item->qty.'</td>
 		<td>£'. $item->unit_price.'</td>
 		<td>£'. $item->total_price.'</td>
 		</tr>';
 	}
 	return $output;
 }

 	
	//Create the transport
			$transport = Swift_SmtpTransport::newInstance('mail', 25);
			//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
			//->setUsername('mrwerdlem@gmail.com')->setPassword('');
			$mailer = Swift_Mailer::newInstance($transport);			
			$message = Swift_Message::newInstance('Customer Quotation')
			->setSubject('Quote Ref:'.$quote_ref)
			->setFrom($EMAIL_QUOTE_PU)
			->setCc($EMAIL_QUOTE_PU)
			->setTo($EMAIL_QUOTE_TO)
			
			//Order Body//
			->setBody('<html>
				<div ng-controller="customerQuote as c">'.
                '<head>'.
                '<body><style type="text/css">
}
.quotes input{
	width: 100%;
    box-sizing: border-box;
    padding: 2px 5px;
    height: 25px;
    border: none;
    text-align: center;
}
	.headders{background-color: #fd6b6b}
	th,td{border:1px solid black; text-align: center}
	
</style></head>'.
               '<p>Dear '.$customer.'</p>
<p>Please find below the quotation for the packaging we discussed:</p>

		<table class="table" ng-model="send_quote">
			<thead>
			<tr>
				<th colspan="1" scope="colgroup"style="border:1px solid black">Date: <p>'. date('d/m/Y').'</p></th>
				<th colspan="3" scope="colgroup"style="border:1px solid black"><h3>Quotation</h3></th>
				<th colspan="2" scope="colgroup"style="border:1px solid black">Quote Ref: <p>'.$quote_ref.'</p></th>				
			</tr>
			<tr class="headders">
				<th>Product Description</th>
				<th>Product Ref</th>
				<th>Size</th>
				<th>Quantity</th>
				<th>Unit</th>
				<th>Price</th>
			</tr>
		</thead>
		<tbody class="quotes">
			'.quoteDetails($data).'
		<th colspan="6" scope="colgroup"style="border:1px solid black">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotation valid for 30 days from above date. Additional tooling charges may apply for die cut and printed products. Stock can be held for call off as required.</th>
	</tbody>

		</table>
		<p>Delivery lead time for the above: '.$leadTime.'.</p>

		<p>I look forward to hearing your thoughts and would be delighted to answer any questions you may have.</p>
		<p>Kind Regards,</p>
		<p>'.$sales.'</p>'.
		'</div>'.'
		<p>Tel: 0845 071 0754<p>
<p>Fax: 0845 071 0759</p>
<p>www.postpack.co.uk<p>
 

<p>Registered in England No. 444 6988</p>
<p>VAT Reg No. 796 7468 51</p>
<p>Registered Office: Unit 4, Hollis Road, Grantham, Lincs. NG31 7QH</p>

<p>This message (and any associated files) is intended only for the use of the individual or entity to which it is addressed and may contain information that is confidential, subject to copyright or constitutes a trade secret. If you are not the intended recipient you are hereby notified that any dissemination, copying or distribution of this message, or files associated with this message, is strictly prohibited. If you have received this message in error, please notify us immediately by replying to the message and deleting it from your computer. Messages sent to and from us may be monitored.</p>

<p>Internet communications cannot be guaranteed to be secure or error-free as information could be intercepted, corrupted, lost, destroyed, arrive late or incomplete, or contain viruses. Therefore, we do not accept responsibility for any errors or omissions that are present in this message, or any attachment, that have arisen as a result of e-mail transmission. If verification is required, please request a hard-copy version. Any views or opinions presented are solely those of the author and do not necessarily represent those of the company.</p>
'.'
                '.'</body>' .
                '</html>',
                'text/html');
		$result = $mailer->send($message);
			if ($result > 0)
			{
				$toolingDal->quoteSent($quote_ref);
			}

