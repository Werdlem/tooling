<?php
require_once "../DAL/settings.php";
 require_once '../lib/swift_required.php';

 $EMAIL_QUOTE_PU = 'seanrobins@damasco.co.uk';
 $EMAIL_QUOTE_TO = 'neilblanchard@postpack.co.uk';

 $data = json_decode(file_get_contents("php://input"));

 $customer = $data->details[0]->customer;
 $sales = $data->details[0]->sales;
 $quote_ref = $data->details[0]->quote_ref;

 function quoteDetails($data){
 	$output = '';
 	foreach($data->details as $item){
 		$output.='<tr>
 		<td>'. $item->description.'</td>
 		<td>'. $item->ref.'</td>
 		<td>'. $item->size.'</td>
 		<td>'. $item->qty.'</td>
 		<td>'. $item->unit_price.'</td>
 		<td>'. $item->total_price.'</td>
 		</tr>';
 	}
 	return $output;
 }

	
	//Create the transport
			//$transport = Swift_MailTransport::newInstance(SMTP_HOST, SMTP_PORT);
			$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
			->setUsername('mrwerdlem@gmail.com')->setPassword('HmR2615BgR0484');
			$mailer = Swift_Mailer::newInstance($transport);			
			$message = Swift_Message::newInstance('Customer Quotation')
			->setSubject('Quote Ref:'.$quote_ref)
			->setFrom($EMAIL_QUOTE_PU)
			->setCc($EMAIL_QUOTE_PU)
			->setTo($EMAIL_QUOTE_PU)
			
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

		<p>I look forward to hearing your thoughts and would be delighted to answer any questions you may have.</p>
		<p>Kind regards,</p>
		<p>'.$sales.'</p>'.
		'</div>'.'
                '.'</body>' .
                '</html>',
                'text/html');
		$result = $mailer->send($message);
