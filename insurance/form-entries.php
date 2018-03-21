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

	$lh = 5; // line height

	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Times','B',15);

	$pdf->Image(get_template_directory().'/insurance/logo.png',10,6,50); // src, corner-x, corner-y, width
	$pdf->Ln(15);

	$pdf->Cell(0,10,'Excess Liability Quote Proposal',0,0,'C');
	$pdf->Ln(15);

	$pdf->SetFont('Times','',10);
	$pdf->Cell(50,$lh,'Quote Date:	'.date('F j, Y'),0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,$lh,'Proposal For:	',0,1,'L');

	$pdf->Cell(50,$lh,'Risk Name:	',0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,$lh,'Producer:	',0,1,'L');

	$pdf->Cell(50,$lh,'Risk Address:',0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,$lh,'Email:	',0,1,'L');

	$pdf->Cell(50,$lh,$entry[8].' '.$entry[9].' '.$entry[10].' '.$entry[11].' '.$entry[24],0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,$lh,'Prepared By:	OnPoint Underwriting',0,1,'L');

	$pdf->Cell(50,$lh,'Proposed Policy Period:',0,0,'L');
	$pdf->Cell(50);
	$pdf->Cell(0,$lh,'Underwriter:	Richard Poling',0,1,'L');

	$pdf->Cell(0,$lh,'(12:01 a.m. Standard Time)',0,1,'L');
	$pdf->Ln(5);

	$pdf->Cell(0,$lh,'Carrier: Golden Insurance Company, RRG',0,1,'L');

	$pdf->Cell(0,$lh,'AM Best Rating: B',0,1,'L');
	$pdf->Ln(5);

	$pdf->Cell(0,$lh,'Thank you for the opportunity to provide you with a quote. This quote is based on the underwriting and rating',0,1,'L');
	$pdf->Cell(0,$lh,'information provided to date and may be subject to additional rating, pricing or underwriting considerations.',0,1,'L');
	$pdf->Ln(5);

	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'Coverage Information',0,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetFont('Times','',10);
	$pdf->SetTextColor(0,0,0);

	$pdf->Cell(20,$lh,'Excess Liability',0,0,'L');
	$pdf->Cell(12);
	$pdf->Cell(20,$lh,'Limits:',0,0,'L');
	$pdf->Cell(2);
	$pdf->Cell(20,$lh,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,$lh,'General Aggregate Limits (included Within Products-Completed Operations)',0,1,'L');

	$pdf->Cell(54);
	$pdf->Cell(20,$lh,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,$lh,'Products-Completed Operation Aggregate Limit',0,1,'L');

	$pdf->Cell(54);
	$pdf->Cell(20,$lh,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,$lh,'Each Occurrence Limit',0,1,'L');

	$pdf->Cell(54);
	$pdf->Cell(20,$lh,'N/A',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,$lh,'Bodily Injury by Accident',0,1,'L');

	$pdf->Cell(54);
	$pdf->Cell(20,$lh,'N/A',0,0,'L');
	$pdf->Cell(10);
	$pdf->Cell(0,$lh,'Bodily Injury by Disease',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(20,$lh,'EXCESS OF',0,0,'L');
	$pdf->Cell(8);
	$pdf->Cell(20,$lh,'Underlying with',0,1,'L');
	$pdf->Ln(5);

	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'Rating Information',0,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetTextColor(0,0,0);

	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,$lh,'Rating Basis:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(20,$lh,'Underlying Premium',0,1,'L');

	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,$lh,'Coverage Type:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(20,$lh,'Excess Liability',0,0,'L');
	$pdf->Cell(10);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(20,$lh,'Policy Type:',0,0,'L');
	$pdf->Cell(22);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(0,$lh,'Claims Made',0,1,'L');

	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,$lh,'Deductible per occurrence:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(20,$lh,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0,$lh,'Retroactive Date:',0,1,'L');

	$pdf->Cell(30,$lh,'Primary Premium:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(20,$lh,'$',0,0,'L');
	$pdf->Cell(10);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0,$lh,'Pending & Prior Litigation Date:',0,1,'L');

	$pdf->Cell(30,$lh,'Subscription Fee:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(0,$lh,'$',0,1,'L');

	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,$lh,'Total:',0,0,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(24);
	$pdf->Cell(0,$lh,'$',0,1,'L');
	$pdf->Ln(5);
	
	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'Required Information to Bind',0,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetTextColor(0,0,0);

	$pdf->Cell(0,$lh,'The following are due within 30 days of effective date:',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Submission of signed Golden application and signed Subscription Agreement',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Loss Runs/No Loss Letter',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Underlying Dec page form',0,1,'L');
	$pdf->Ln(5);

	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'Payment Terms',0,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetTextColor(0,0,0);

	$pdf->Cell(4);
	$pdf->Cell(0,$lh,iconv('UTF-8', 'windows-1252', '•   PAYMENT OF 50% OF PREMIUM, SUBSCRIPTION FEE, AND TAXES IS DUE IN 30 DAYS'),0,1,'L');

	$pdf->SetFont('Times','',10);
	$pdf->Cell(4);
	$pdf->Cell(0,$lh,iconv('UTF-8', 'windows-1252', '•   The remaining 50% is due in 60 days.'),0,1,'L');

	$pdf->AddPage();

	// PAGE 2

	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'CONDITIONS / EXCLUSIONS',0,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetTextColor(0,0,0);

	$pdf->Cell(0,$lh,'Policy Conditions',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Prior acts/losses are excluded',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Minimum earned Premium 100%',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Quote expires on at 12:01 am Standard Time',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Commission 15%',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Defence Inside',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Auditable',0,1,'L');

	$pdf->Cell(32);
	$pdf->Cell(0,$lh,'Extended Reproting Period:',0,1,'L');

	$pdf->Cell(64);
	$pdf->Cell(0,$lh,'1 Year at 200% annual premium',0,1,'L');
	$pdf->Ln(5);

	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'General Conditions',0,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetFont('Times','',9);
	$pdf->SetTextColor(0,0,0);

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,iconv('UTF-8', 'windows-1252', '•   This is a proposal for insurance. It is not an insurance policy. Only the policy itself provides coverage. If bound, the policy will be an'),0,1,'L');

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,'     occurrence form policy.',0,1,'L');

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,iconv('UTF-8', 'windows-1252', '•   All coverage’s are subject to the terms, conditions and exclusion of the policy. Policy forms are avalible upon request.'),0,1,'L');

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,iconv('UTF-8', 'windows-1252', '•   It is incumbent upon you to ascertain the accuracy of the quote, and to review with the insured the terms and conditions of the quote'),0,1,'L');

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,'     carefully, as the coverage, terms and conditions may be different than requested.',0,1,'L');

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,iconv('UTF-8', 'windows-1252', '•   No backdating of coverage is allowed. If the request to bind coverage is not received on or before at 12:01 a.m. Standard'),0,1,'L');

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,'     Time, this quote will be considered expired.',0,1,'L');

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,iconv('UTF-8', 'windows-1252', '•   A risk retention group may not be subject to all the insurance laws and regulations of your State. Under Federal Law state insurance'),0,1,'L');

	$pdf->Cell(4);
	$pdf->Cell(0,$lh - 1,'     guaranty funding cannot be used for the risk retention group.',0,1,'L');
	$pdf->Ln(5);

	$pdf->SetFont('Times','B',10);
	$pdf->SetFillColor(218,166,0);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(0,7,'Forms/Endorsement Schedule',0,1,'L',true);
	$pdf->Ln(5);
	$pdf->SetFont('Times','',9);
	$pdf->SetTextColor(0,0,0);






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