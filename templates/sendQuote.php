 <?php
require_once "../DAL/settings.php";
 require_once '../lib/swift_required.php';

 $EMAIL_QUOTE_PU = 'seanrobins@damasco.co.uk';
 $EMAIL_QUOTE_TO = 'neilblanchard@postpack.co.uk';

$data = json_decode(file_get_contents("php://input"));
$customer = $data[0]->customer;
$quote_ref = $data[0]->quote_ref;
$sales = $data[0]->sales;

echo '
<style type="text/css">
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
	
</style>';





     
	//Create the transport
			$transport = Swift_MailTransport::newInstance(SMTP_HOST, SMTP_PORT);
			//$transport = Swift_MailTransport::newInstance('smtp.gmail.com', 465);
			$mailer = Swift_Mailer::newInstance($transport);			
			$message = Swift_Message::newInstance('Please Order')
			->setSubject('Quote Test')
			->setFrom($EMAIL_QUOTE_PU)
			->setCc($EMAIL_QUOTE_PU)
			->setTo($EMAIL_QUOTE_TO)
			
			Order Body//
			->setBody(

				echo '<p>Dear '. $customer .' </p>
<p>Please find below the quotation for the packaging we discussed:</p>

		<table class="table">
			<thead>
			<tr>
				<th colspan="1" scope="colgroup"style="border:1px solid black">Date: <p>' .date('d/m/Y').'</p></th>
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
		<tbody class="quotes">';
		foreach ($data as $results) { 
			echo '
			<tr>
			<td>'.$results->description .'</td>
			<td>'.$results->ref .'</td>
			<td>'.$results->size .'</td>
			<td>'.$results->qty .'</td>
			<td>'.$results->unit_price .'</td>
			<td>'.$results->total_price .'</td>
			
		</tr>'
	;}
	
		echo '<th colspan="6" scope="colgroup"style="border:1px solid black">Please note: All prices are shown excluding VAT. Quantities are subject to +/- 10% tolerance on bespoke items. Quotation valid for 30 days from above date. Additional tooling charges may apply for die cut and printed products. Stock can be held for call off as required.</th>
	</tbody>
	
		</table>';

		echo'

		<p>I look forward to hearing your thoughts and would be delighted to answer any questions you may have.</p>
		<p>Kind regards,</p>
		<p>'.$sales.'</p>
		';

		$result = $mailer->send($message);

        
		
			
	
