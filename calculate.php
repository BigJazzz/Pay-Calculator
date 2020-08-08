<?php
// if(!isset($_POST)) {
//     header("Location: https://calc.ssby.me");
//     die();
// }
ini_set('display_errors', 'Off');
include('includes/header.php');
include('includes/functions.php');
include('includes/general.php');
$post = $_POST;
echo '<pre>';
print_r($post);
echo '</pre>';
$cabetr = 0;
$security = 0;
$i = 0;
$ix = 1;
while($i < 14) {
    $i++;
    include('includes/variables.php');
    $day = $postdayid;
    if($sick == 'on') { // Sick hours
        // General
        $detail = 'Sick'; // Friendly name
        $units = 8; // Hours and minutes in decimal
        $rate = 1; // Total hourly rate
        // Specific
        --$OTcount;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($holnr == 'on') { // Public holiday not required
        // General
        $detail = 'Public holiday not required'; // Friendly name
        $units = 8; // Hours and minutes in decimal
        $rate = 1;
        // Specific
        ++$OTcount;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($training == 'on') { // Training hours
        // General
        $detail = 'Ordinary hours'; // Friendly name
        $units = 8; // Hours and minutes in decimal
        if($day == 'Sat') {
            $rate = 1.5;
        }
        elseif($day == 'Sun') {
            $rate = 2;
        }
        else {
            $rate = 1;
        }
        // Specific
        ++$OTcount;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    else {
        include('includes/calculations.php');
    }
    if(isset($extrad)) {
        $payslip['Extra payments'][] = $extrad;
    }
    if(isset($extrat)) {
        $time = $extrat;
        $h = substr($time,0,2);
        $m = substr($time,2);
        $m = str_replace(':','',$m);
        $h = floatval($h);
        $m = floatval($m);
        $m = $m/60;
        $time = $h+$m;
        $time = round($time, 2);
        $payslip['Extra payments'][] = $time*$payrate;
    }
    if(isset($wobod)) {
        $time = $wobod;
        $h = substr($time,0,2);
        $m = substr($time,2);
        $m = str_replace(':','',$m);
        $h = floatval($h);
        $m = floatval($m);
        $m = $m/60;
        $time = $h+$m;
        $time = round($time, 2);
        $payslip['WOBOD'] = $time;
    }
    $allowances = allowances($cabetr,$security,$expenses);
    $a = 0;
    while($a < 9) {
        $payslip[$date][] = $allowances[$a];
        $a++;
    }
    $ix++;
}
echo '<pre>';
print_r($payslip);
echo '</pre>';
$css = md5(date("H:i:s"));
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crew Pay Calculator</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Darker+Grotesque" type="text/css">
    <link rel="stylesheet" href="styles/reset.css" type="text/css">
    <link rel="stylesheet" href="styles/style.css?version=<?php echo $css; ?>" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="includes/js.php"></script> -->
    <script src="includes/js.php?version=<?php echo $css; ?>"></script>
</head>
<body>
<?php
echo '<table style="width:100%; font-size:20px;" id="payslip">';
echo '<tr><td colspan="5" class="payslip"><h1>Payslip for fortnight ending '.$ldate.'</h1><br></td></tr>';
echo '<tr style="background:black;color:white;text-align:center;">';
echo '<td style="width:15%;" class="payslip">Date</td>';
echo '<td style="width:40%;" class="payslip">Details</td>';
echo '<td style="width:15%;" class="payslip">Units';
echo '<td style="width:15%;" class="payslip">Rate</td>';
echo '<td style="width:15%;" class="payslip">Total</td>';
echo '</tr>';
// Displays ADO adjustment
if($fn == 'Short') {
    echo '<tr>';
    echo '<td></td>';
    echo '<td class="payslip">ADO Adjustment</td>';
    echo '<td class="payslip">4</td>';
    $ratex = number_format($payrate,2);
    echo '<td class="payslip dollars">'.$ratex.'</td>';
    $totalx = number_format($ratex*4,2);
    echo '<td class="payslip dollars">'.$totalx.'</td>';
    echo '</tr>';
    $totalO += $totalx;
}
else {
    echo '<tr>';
    echo '<td></td>';
    echo '<td class="payslip">ADO Adjustment</td>';
    echo '<td class="payslip">-4</td>';
    $ratex = number_format($payrate,2);
    echo '<td class="payslip dollars">'.$ratex.'</td>';
    $totalx = number_format($ratex*-4,2);
    echo '<td class="payslip dollars">'.$totalx.'</td>';
    echo '</tr>';
    $totalO += $totalx;
}
// Displays total Ordinary Hours
$units = array_sum($payslip['Ordinary hours']);
echo '<tr>';
echo '<td></td>';
echo '<td class="payslip">Ordinary Hours</td>';
echo '<td class="payslip">'.$units.'</td>';
$ratex = number_format($payrate,2);
echo '<td class="payslip dollars">'.$ratex.'</td>';
$totalx = number_format($ratex*$units,2);
echo '<td class="payslip dollars">'.$totalx.'</td>';
echo '</tr>';
$totalx = str_replace(',','',$totalx);
$totalO += $totalx;
// Shows WOBOD hours
echo '<tr>';
echo '<td></td>';
echo '<td class="payslip">WOBOD</td>';
echo '<td class="payslip">'.$payslip['WOBOD'].'</td>';
$ratex = number_format($payrate*0.48,2);
echo '<td class="payslip dollars">'.$ratex.'</td>';
$totalx = number_format($ratex*$payslip['WOBOD'],2);
echo '<td class="payslip dollars">'.$totalx.'</td>';
echo '</tr>';
$totalx = str_replace(',','',$totalx);
$totalO += $totalx;
// Shows extra amounts
echo '<tr>';
echo '<td></td>';
echo '<td class="payslip">Extra payments</td>';
echo '<td class="payslip">1</td>';
$totalx = number_format($payslip['Extra payments'],2);
echo '<td class="payslip dollars">'.$totalx.'</td>';
echo '<td class="payslip dollars">'.$totalx.'</td>';
echo '</tr>';
$totalx = str_replace(',','',$totalx);
$totalO += $totalx;
foreach($payslip as $key => $value) {
    if($key == 'Ordinary hours') {
        unset($payslip['Ordinary hours']);
    }
    if($key == 'WOBOD') {
        unset($payslip['WOBOD']);
    }
    if($key == 'Extra payments') {
        unset($payslip['Extra payments']);
    }
}
$date = array_keys($payslip);
$countp = count($payslip);
// Displays the poyslip tables
for($i = 0; $i < $countp; $i++) {
    if($payslip[$date[$i]][1] != 0 && !empty($payslip[$date[$i]][1])) {
        echo '<tr>';
        echo '<td class="payslip">'.$date[$i].'</td>'; // Date - run once per top level array
        echo '<td colspan="4">&nbsp;</td>';
        echo '</tr>';
        $countd = count($payslip[$date[$i]]);
        $k = 1;
        for($j = 0; $j < $countd; $j++) {
            if(!empty($payslip[$date[$i]][$k]) && $payslip[$date[$i]][$k] != 0) {
                // $j = 0
                $detailO = $payslip[$date[$i]][$j];
                ++$j; // 1
                $unitsO = $payslip[$date[$i]][$j];
                ++$j; // 2
                $rateO = $payslip[$date[$i]][$j];
                if($detailO == 'Night shift' || $detailO == 'Morning shift' || $detailO == 'Afternoon shift' || $detailO == 'Cab/ETR' || $detailO == 'Security' || $detailO == 'Expenses > 10 hours') {
                    $ratex = number_format($rateO,2); // Rate for allowances
                }
                else {
                    $ratex = number_format($rateO*$payrate,2); // Adjusted rate times payrate set by user
                }
                $totalx = number_format($ratex*$unitsO,2); // Total: adjusted rate times units
                echo '<tr>';
                echo '<td>&nbsp;</td>';
                echo '<td class="payslip">'.$detailO.'</td>'; // Detail
                echo '<td class="payslip">'.$unitsO.'</td>'; // Units
                echo '<td class="payslip dollars">'.$ratex.'</td>'; // Rate
                echo '<td class="payslip dollars">'.$totalx.'</td>'; // Total
                echo '</tr>';
                $totalx = str_replace(',','',$totalx);
                $totalO += $totalx;
                $k += 3;
            }
            else {
                $j += 2;
                $k += 3;
            }
        }
        echo '</tr>';
    }
}
echo '<tr><td class="payslip" style="font-weight:bold;">&nbsp;</td><td class="payslip">Total gross</td><td colspan="2" class="payslip">&nbsp;</td><td class="dollars payslip">$'.number_format($totalO,2).'</td></tr>';
echo '</table></body></html>';
?>
