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
// echo '<pre>';
// print_r($post);
// echo '</pre>';
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
if($fn == 'Short') {
    echo '<tr>';
    echo '<td class="payslip"></td>';
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
    echo '<td class="payslip"></td>';
    echo '<td class="payslip">ADO Adjustment</td>';
    echo '<td class="payslip">-4</td>';
    $ratex = number_format($payrate,2);
    echo '<td class="payslip dollars">'.$ratex.'</td>';
    $totalx = number_format($ratex*-4,2);
    echo '<td class="payslip dollars">'.$totalx.'</td>';
    echo '</tr>';
    $totalO += $totalx;
}
$units = array_sum($payslip['Ordinary hours']);
echo '<tr>';
echo '<td class="payslip"></td>';
echo '<td class="payslip">Ordinary Hours</td>';
echo '<td class="payslip">'.$units.'</td>';
$ratex = number_format($payrate,2);
echo '<td class="payslip dollars">'.$ratex.'</td>';
$totalx = number_format($ratex*$units,2);
echo '<td class="payslip dollars">'.$totalx.'</td>';
echo '</tr>';
$totalO += $totalx;
$j = 1;
while($j < 15) {
    if($payslip[$k] != 'Ordinary hours') {
        //echo 'True';
    }
    $l = 0;
    $k = 0;
    echo '<tr>';
    echo '<td class="payslip">'.$payslip[$date].'</td>';
    while($k < 14) {
        echo '<td class="payslip">'.$payslip[$k][$l++].'</td>';
        echo '<td class="payslip">'.$payslip[$k][$l++].'</td>';
        $ratex = number_format($payslip[$k][$l]*$payrate,2);
        echo '<td class="payslip dollars">'.$ratex.'</td>';
        $totalx = number_format($ratex*$payslip[$k][--$l],2);
        echo '<td class="payslip dollars">'.$totalx.'</td>';
        echo '</tr>';
        $totalO += $totalx;
        $l += 2;
        $k++;
    }


    // if($payslip[$j][2] != 0 || $payslip[$j][2] != '' || isset($payslip[$j][2])) { // Monday 1
    // echo '<tr>';
    // echo '<td class="payslip">'.$payslip[$j][0].'</td>';
    // echo '<td class="payslip">'.$payslip[$j][1].'</td>';
    // echo '<td class="payslip">'.$payslip[$j][2].'</td>';
    // $ratex = number_format($payslip[$j][3]*$payrate,2);
    // echo '<td class="payslip dollars">'.$ratex.'</td>';
    // $totalx = number_format($ratex*$payslip[$j][2],2);
    // echo '<td class="payslip dollars">'.$totalx.'</td>';
    // echo '</tr>';
    // $totalO += $totalx;
    // }
    // if($payslip[$j][6] != 0) {
    // echo '<tr>';
    // echo '<td class="payslip"></td>';
    // echo '<td class="payslip">'.$payslip[$j][5].'</td>';
    // echo '<td class="payslip">'.$payslip[$j][6].'</td>';
    // $ratex = number_format($payslip[$j][7]*$payrate,2);
    // echo '<td class="payslip dollars">'.$ratex.'</td>';
    // $totalx = number_format($ratex*$payslip[$j][6],2);
    // echo '<td class="payslip dollars">'.$totalx.'</td>';
    // echo '</tr>';
    // $totalO += $totalx;
    // }
    // if($payslip[$j][10] != 0) {
    // echo '<tr>';
    // echo '<td class="payslip"></td>'; //Date
    // echo '<td class="payslip">'.$payslip[$j][9].'</td>'; // Details
    // echo '<td class="payslip">'.$payslip[$j][10].'</td>'; // Units
    // $ratex = number_format($payslip[$j][11]*$payrate,2);
    // echo '<td class="payslip dollars">'.$ratex.'</td>'; // Rate
    // $totalx = number_format($ratex*$payslip[$j][10],2);
    // echo '<td class="payslip dollars">'.$totalx.'</td>'; // Total
    // echo '</tr>';
    // $totalO += $totalx;
    // }
    // if($payslip[$j][14] != 0) {
    // echo '<tr>';
    // echo '<td class="payslip"></td>';
    // echo '<td class="payslip">'.$payslip[$j][13].'</td>';
    // echo '<td class="payslip">'.$payslip[$j][14].'</td>';
    // $ratex = number_format($payslip[$j][15],2);
    // echo '<td class="payslip dollars">'.$ratex.'</td>';
    // $totalx = number_format($ratex*$payslip[$j][14],2);
    // echo '<td class="payslip dollars">'.$totalx.'</td>';
    // echo '</tr>';
    // $totalO += $totalx;
    // }
    // if($payslip[$j][18] != 0) {
    // echo '<tr>';
    // echo '<td class="payslip"></td>';
    // echo '<td class="payslip">'.$payslip[$j][17].'</td>';
    // echo '<td class="payslip">'.$payslip[$j][18].'</td>';
    // $ratex = number_format($payslip[$j][19],2);
    // echo '<td class="payslip dollars">'.$ratex.'</td>';
    // $totalx = number_format($ratex*$payslip[$j][18],2);
    // echo '<td class="payslip dollars">'.$totalx.'</td>';
    // echo '</tr>';
    // $totalO += $totalx;
    // }
    // if($payslip[$j][22] != 0) {
    // echo '<tr>';
    // echo '<td class="payslip"></td>';
    // echo '<td class="payslip">'.$payslip[$j][21].'</td>';
    // echo '<td class="payslip">'.$payslip[$j][22].'</td>';
    // $ratex = number_format($payslip[$j][23],2);
    // echo '<td class="payslip dollars">'.$ratex.'</td>';
    // $totalx = number_format($ratex*$payslip[$j][22],2);
    // echo '<td class="payslip dollars">'.$totalx.'</td>';
    // echo '</tr>';
    // $totalO += $totalx;
    // }
    $j++;
}
echo '<tr><td class="payslip" style="font-weight:bold;">&nbsp;</td><td class="payslip">Total gross</td><td colspan="2" class="payslip">&nbsp;</td><td class="dollars payslip">$'.number_format($totalO,2).'</td></tr>';
echo '</table></body></html>';
?>
