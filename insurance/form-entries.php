<?php
// Create PDF and CSV after submit form
require_once(get_template_directory().'/insurance/fpdf/fpdf.php');
class PDF extends FPDF{
	// Page footer
	function Footer(){
	    // Position at 1.5 cm from bottom
	    $this->SetY(-25);
	    $this->SetFont('Times','',10);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
	    $this->Cell(0,5,'OnPoint Underwriting',0,1,'C');
	    $this->Cell(0,5,'8390 E. Crescent Parkway, Suite 200 * Greenwood Village, CO 80111',0,1,'C');
	    $this->Cell(0,5,'Phone: (866) 831-5464 * Fax: (303) 388-5585',0,1,'C');
	}
}

$form_id = 3; // change to new form ID
add_action('gform_after_submission_'.$form_id, 'gform_create_csv', 10, 2);
function gform_create_csv($entry, $form){

	$underlying_limits = round(intval($entry[16]), 2);

	$underlying_total_premium = round(intval($entry[23]), 2);

	$excess_limits_1 = round(($underlying_total_premium * 0.3), 2);
	if ($excess_limits_1 < 2000) {
		$excess_limits_1 = 2000.00;
	}

	$excess_limits_2 = 0;
	$premium_total = $underlying_total_premium;
	if ($entry[22] == '$2 million/$2 million') {
		#(Underlying Premium total) * (.225)
		$excess_limits_2 = round(($underlying_total_premium * 0.225), 2);
		$premium_total = $excess_limits_1 + $underlying_total_premium;
	}

	$subscription_fee = round(($premium_total * 0.05), 2);

	$policy_total = $premium_total + $subscription_fee;

	$calculated_values = array(
		'underlying_limits' => number_format($underlying_limits, 2),
		'underlying_total_premium' => number_format($underlying_total_premium, 2),
		'excess_limits_1' => number_format($excess_limits_1, 2),
		'excess_limits_2' => number_format($excess_limits_2, 2),
		'premium_total' => number_format($premium_total, 2),
		'subscription_fee' => number_format($subscription_fee, 2),
		'policy_total' => number_format($policy_total, 2),
	);

	$csv = ',,,,'.PHP_EOL
			.',Golden Excess WorkSheet,,,'.PHP_EOL
			.',,,,'.PHP_EOL
			.',,,,'.PHP_EOL
			.',,,,'.PHP_EOL
			.'Broker Name,'.$entry[1].',,,'.PHP_EOL
			.'Broker Phone,'.$entry[2].',,,'.PHP_EOL
			.'Broker Email,'.$entry[3].',,,'.PHP_EOL
			.'Brokerage Company,'.$entry[4].',,,'.PHP_EOL
			.'Name of Insured:,Insert Name Here,'.$entry[5].',,'.PHP_EOL
			.'Type of Company:,'.$entry[6].',,,'.PHP_EOL
			.'Address,'.$entry[8].' '.$entry[9].' '.$entry[10].' '.$entry[24].',,,'.PHP_EOL
			.'State (more than 1 State is underwriting referral),'.$entry[11].',,,'.PHP_EOL
			.'Desired Effective Date: ,'.$entry[12].',,,'.PHP_EOL
			.'Underlying policy term,'.$entry[13].'-'.$entry[14].',,,'.PHP_EOL
			.'"Expiration Date (1 year or exp date of underlying, whichever is earlier:",'.$entry[15].',,,'.PHP_EOL
			.'Underlying limits - must be at least $1mm," $	'.$calculated_values['underlying_limits'].' ",,,'.PHP_EOL
			.'New or Renewal?,'.$entry[17].',,,'.PHP_EOL
			.'Insured\'s web site:,'.$entry[19].',,,'.PHP_EOL
			.'Limits desired:,'.$entry[22].',,,'.PHP_EOL
			.',,,,'.PHP_EOL
			.'Primary Operations:,'.$entry[20].',,,'.PHP_EOL
			.'Other Operations:,'.$entry[21].',,,'.PHP_EOL
			.'Other Operations:,,,,'.PHP_EOL
			.',,,,'.PHP_EOL
			.'Type of Policy:,Claims Made,,,'.PHP_EOL
			.'Retroactive Date:,At Inception,,,'.PHP_EOL
			.',,,,'.PHP_EOL
			.'Underlying total premium:,"$'.$calculated_values['underlying_total_premium'].'",,,'.PHP_EOL
			.',,,,'.PHP_EOL
			.'Excess limits:  $1mm/$1mm excess of underlying ,,0.3," $	'.$calculated_values['excess_limits_1'].' ",'.PHP_EOL           // floor is $2k, can't be less than that.  Otherwise, (Underlying total premium)* (.3)
			.'Excess limits $2mm/$2mm excess of underlying,,0.225," $	'.$calculated_values['excess_limits_2'].' ","Only calculate this IF they want $2mm/$2mm quote, otherwise zero"'.PHP_EOL                                     // (only calculate this if they chose $2mm/$2mm for 14 aka "Limits Desired") Excess limits : (Underlying Premium total) * (.225)
			.',,,,'.PHP_EOL
			.'Premium Total:,,," $	'.$calculated_values['premium_total'].' ",'.PHP_EOL                   // sum of 20+21, only calculate 21 if it's $2mm/$2mm for limits desired
			.'Subscription Fee:,,5%, $	'.$calculated_values['subscription_fee'].' ,'.PHP_EOL                 // (Premium Total)* (.05)
			.',,,,'.PHP_EOL
			.'Policy Total,,," $	'.$calculated_values['policy_total'].' ",';                        // (Premium Total + Subscription Fee)

	$filename = get_template_directory().'/insurance/csvs/insurance-'.$entry['id'].'.csv';
	$fp = fopen($filename, 'w');
	fwrite($fp, $csv);
	fclose($fp);
	gform_create_pdf($entry, $calculated_values);
}

function gform_create_pdf($entry, $calculated_values){

	// Cell() Parameters:

	// w: Cell width. If 0, the cell extends up to the right margin.
	// h: Cell height. Default value: 0.
	// txt: String to print. Default value: empty string.
	// border: Indicates if borders must be drawn around the cell. (0 no border, 1 frame, L left, T top, R right, B bottom)
	// ln: Indicates where the current position should go after the call. (0 to the right, 1 to the beginning of the next line Ln(), 2 below)
	// align: Allows to center or align the text. (L left align, C center, R right align)
	// fill: Indicates if the cell background must be painted (true) or transparent (false).
	// link: URL or identifier returned by AddLink().

	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Times','B',15);

	$pdf->Image(get_template_directory().'/insurance/logo.png',10,6,50); // src, corner-x, corner-y, width
	$pdf->Ln(13);

	$pdf->Cell(0,10,'Excess Liability Quote Proposal',0,0,'C');
	$pdf->Ln(10);

	$pdf->SetFont('Times','',10);
	$pdf->Cell(50,5,'Quote Date:	'.date('F j, Y'),0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,5,'Proposal For:	',0,1,'L');

	$pdf->Cell(50,5,'Risk Name:	',0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,5,'Producer:	',0,1,'L');

	$pdf->Cell(50,5,'Risk Address:',0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,5,'Email:	',0,1,'L');

	$pdf->Cell(50,5,$entry[8].' '.$entry[9].' '.$entry[10].' '.$entry[11].' '.$entry[24],0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,5,'Prepared By:	OnPoint Underwriting',0,1,'L');

	$pdf->Cell(50,5,'Proposed Policy Period:',0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,5,'Underwriter:	Richard Poling',0,1,'L');

	$pdf->Cell(0,5,'(12:01 a.m. Standard Time)',0,1,'L');
	$pdf->Ln(3);

	$pdf->Cell(0,5,'Carrier: Golden Insurance Company, RRG',0,1,'L');

	$pdf->Cell(0,5,'AM Best Rating: B',0,1,'L');
	$pdf->Ln(3);

	$pdf->Cell(0,5,'Thank you for the opportunity to provide you with a quote. This quote is based on the underwriting and rating',0,1,'L');
	$pdf->Cell(0,5,'information provided to date and may be subject to additional rating, pricing or underwriting considerations.',0,1,'L');
	$pdf->Ln(3);

	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'Coverage Information',0,1,'L',true);
	$pdf->Ln(3);
	$pdf->SetFont('Times','',10);
	$pdf->SetTextColor(0,0,0);

	$pdf->Cell(20,5,'Excess Liability',0,0,'L');
	$pdf->Cell(12);
	$pdf->Cell(20,5,'Limits:',0,0,'L');
	$pdf->Cell(2);
	$pdf->Cell(20,5,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,5,'General Aggregate Limits (included Within Products-Completed Operations)',0,1,'L');

	$pdf->Cell(54);
	$pdf->Cell(20,5,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,5,'Products-Completed Operation Aggregate Limit',0,1,'L');

	$pdf->Cell(54);
	$pdf->Cell(20,5,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,5,'Each Occurrence Limit',0,1,'L');

	$pdf->Cell(54);
	$pdf->Cell(20,5,'N/A',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,5,'Bodily Injury by Accident',0,1,'L');

	$pdf->Cell(54);
	$pdf->Cell(20,5,'N/A',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,5,'Bodily Injury by Disease',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(20,5,'EXCESS OF',0,0,'L');
	$pdf->Cell(8);
	$pdf->Cell(20,5,'Underlying with',0,1,'L');
	$pdf->Ln(3);

	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'Rating Information',0,1,'L',true);
	$pdf->Ln(3);
	$pdf->SetFont('Times','',10);
	$pdf->SetTextColor(0,0,0);

	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,5,'Rating Basis:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(20,5,'Underlying Premium',0,1,'L');

	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,5,'Coverage Type:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(20,5,'Excess Liability',0,0,'L');
	$pdf->Cell(10);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(20,5,'Policy Type:',0,0,'L');
	$pdf->Cell(22);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(0,5,'Claims Made',0,1,'L');

	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,5,'Deductible per occurrence:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(20,5,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0,5,'Retroactive Date:',0,1,'L');


	$pdf->Output('F', get_template_directory().'/insurance/pdfs/insurance-'.$entry['id'].'.pdf');
}

// add_filter( 'gform_notification_'.$form_id, 'add_attachments', 10, 3 );
// function add_attachments( $notification, $form, $entry ) {
//     if( $notification['name'] != 'User Notification' ) {
//         $attachment = get_template_directory().'/insurance/csv/insurance-'.$entry['id'].'.csv';
 
//         GFCommon::log_debug( __METHOD__ . '(): file to be attached: ' . $attachment );
 
//         if (file_exists($attachment)) {
//             $notification['attachments'] = rgar( $notification, 'attachments', array() );
//             $notification['attachments'][] = $attachment;
//             GFCommon::log_debug( __METHOD__ . '(): file added to attachments list: ' . print_r( $notification['attachments'], 1 ) );
//         } else {
//             GFCommon::log_debug( __METHOD__ . '(): not attaching; file does not exist.' );
//         }
//     }
//     else{

//     }
//     // remove temp file
//     // array_map('unlink', glob(get_template_directory().'/pdf-forms/flat/*'));
//     return $notification;
// }
?>