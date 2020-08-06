<?php
// if(!isset($_POST)) {
//     header("Location: https://calc.ssby.me");
//     die();
// }
// if(isset($_GET) && $_GET["t"] != 'y') {
//     header("Location: https://calc.ssby.me");
//     die();
// }
ini_set('display_errors', 'Off');
include('includes/header.php');
include('includes/general.php');
$t = '';
$t = $_GET['t'];
if($t == 'y') {
    $date = '2019-07-20';
    $shortdate = '20/07';
    $rate = '31.20';
    $role = 'Guard';
    $ls = 'Short';
    $form = '';
    $post = '';
}
else {
    $post = $_POST;
    $form = $post["form"];
    if(!$form) {
        $form = '';
    }
    $date = $post['date'];
    $rate = $post['rate'];
    $role = $post['role'];
    $ls = $post['ls'];
}
$datex = explode('-', $date);
$dateOG = $datex[2].'-'.$datex[1].'-'.$datex[0];
$startdate = date_create($date);
date_sub($startdate, date_interval_create_from_date_string('13 days'));
$startdate = date_format($startdate, 'd-m-Y');
$css = md5(date("H:i:s"));
?>
<!DOCTYPE html>
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
    <script>
    function msg() {
        alert("Please enter all start/finish/mileage times in XXXX.\nPlease enter all LU/LB/BU and additional payment times in XX:XX.\nThis calculator doesn't currently support relinquished shifts.")
    }
    </script>
</head>
<body>
    <div id="body-outer">
        <div id="body">
            <h1>Crew Pay Calculator</h1>
            <br>
            <table id="data">
                <tr>
                    <td class="label">Fortnight ending:</td>
                    <td class="blank">&nbsp;</td>
                    <td><?php echo $dateOG; ?></td>
                    <td class="blank">&nbsp;</td>
                    <td class="label">Long/short:</td>
                    <td class="blank">&nbsp;</td>
                    <td><?php echo $ls; ?></td>
                </tr>
                <tr>
                    <td class="label">Role:</td>
                    <td class="blank">&nbsp;</td>
                    <td><?php echo $role; ?></td>
                    <td class="blank">&nbsp;</td>
                    <td class="label">Rate:</td>
                    <td class="blank">&nbsp;</td>
                    <td>$<?php echo $rate; ?></td>
                </tr>
                <tr>
                    <td colspan="7" style="padding-top: 5px; padding-bottom: 5px;"><input type="button" onclick="msg()" value="Important Information" class="button" style="background-color: red;"></td>
                </tr>
            </table>
            <table id="timesheet">
                <tr class="header">
                    <td>Day</td>
                    <td>Date</td>
                    <td>Start</td>
                    <td>Finish</td>
                    <td>LU/LB</td>
                    <td>Build Up</td>
                    <td>Mileage</td>
                    <td>Cab/ETR</td>
                    <td>Security</td>
                    <td>Expenses</td>
                    <td>Call Out</td>
                    <?php //<td>WOBOD</td> ?>
                    <td>Public Holiday</td>
                    <td>HOL N/R</td>
                    <td>Sick</td>
                    <td>Training</td>
                </tr>
                <form id="timesheet" action="calculate.php" method="post">
                <?php
                    $i = 1;
                    $ix = 0;
                    foreach($days as $day) {
                        $dayi = str_pad($i,2,"0",STR_PAD_LEFT);
                        $shortdatex = explode('-', $startdate);
                        $shortdate = $shortdatex[0].'-'.$shortdatex[1];
                        if($day == 'Sun' || $day == 'Sat') {
                            $calloutB = '<input type="hidden" name="callout'.$i.'" value="off"></td>';
                        }
                        else {
                            $calloutB = '<input type="checkbox" name="callout'.$i.'"></td>';
                        }
                        if($role == 'Driver') {
                            $securityB = '<input type="hidden" name="security'.$i.'" value="off">N/A</td>';
                        }
                        else {
                            $securityB = '<input type="checkbox" name="security'.$i.'"></td>';
                        }
                        if($day == 'Sun') {
                            $pholB = '<input type="hidden" name="phol'.$i.'" value="off"></td>';
                        }
                        else {
                            $pholB = '<input type="checkbox" name="phol'.$i.'"></td>';
                        }
                        echo '<tr>'."\n";
                        echo '<td class="border ">'.$day.'<input type="hidden" value="'.$day.$dayi.'" name="dayid'.$i.'"><input type="hidden" value="'.$day.'" name="day'.$i.'"></td>'."\n";
                        echo '<td class="border">'.$shortdate.'<input type="hidden" value="'.$shortdate.'" name="date'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="start'.$i.'" maxlength="4" size="4" max="9999" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="finish'.$i.'" maxlength="4" size="4" max="9999" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="lulb'.$i.'" maxlength="4" size="4" max="9999" pattern="[0-9]{2}:[0-9]{2}" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="buildup'.$i.'" maxlength="4" size="4" max="9999" pattern="[0-9]{2}:[0-9]{2}" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="mileage'.$i.'" maxlength="4" size="4" max="9999" class="time disable'.$i.'" pattern="[0-9]{2}:[0-9]{2}"></td>'."\n";
                        echo '<td class="border disable'.$i.'"><input type="checkbox" name="cabetr'.$i.'"></td>'."\n";
                        echo '<td class="border disable'.$i.'">'.$securityB."\n";
                        echo '<td class="border disable'.$i.'"><input type="checkbox" name="expenses'.$i.'"></td>'."\n";
                        echo '<td class="border disable'.$i.'">'.$calloutB."\n";
                        //echo '<td class="border disable'.$i.'"><input type="checkbox" name="wobod'.$i.'"></td>'."\n";
                        echo '<td class="border disable'.$i.'">'.$pholB."\n";
                        echo '<td class="border disable'.$i.'"><input type="checkbox" name="holnr'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="checkbox" name="sick'.$i.'" onclick="disableInput()"></td>'."\n";
                        echo '<td class="border disable'.$i.'"><input type="checkbox" name="training'.$i.'"></td>'."\n";
                        echo '</tr>'."\n";
                        $startdate = $shortdatex[2].'-'.$shortdatex[1].'-'.$shortdatex[0];
                        $startdate = strtotime('+1 day', strtotime($startdate));
                        $startdate = date('d-m-Y', $startdate);
                        $i++;
                        $ix++;
                    }

                ?>
                <tr class="noborder">
                    <td class="noborder" colspan="3">WOBOD payments</td>
                    <td class="noborder"><input type="text" name="wobod" size="4" pattern="[0-9]{2}:[0-9]{2}"></td>
                    <td colspan="6" class="noborder">&larr;<span style="text-decoration: underline;"> Enter the total time for additional payments due, such as WOBOD.</span></td>
                </tr>
                <tr class="noborder">
                    <td class="noborder" colspan="3">Extra payments</td>
                    <td class="noborder"><input type="text" name="extra" size="4"></td>
                    <td colspan="6" class="noborder">&larr;<span style="text-decoration: underline;"> Enter the total dollar amount for additional payments, <span style="font-weight: bold;">excluding WOBOD</span>.</span></td>
                </tr>
                <tr class="noborder">
                    <td class="noborder" colspan="3">Pre-tax deductions</td>
                    <td class="noborder"><input type="text" name="pretax" size="4"></td>
                    <td colspan="6" class="noborder">&larr;<span style="text-decoration: underline;"> Enter the total pre-tax deductions, such as Maxxia.</span></td>
                </tr>
                <tr class="noborder">
                    <td class="noborder" colspan="3">Post-tax deductions</td>
                    <td class="noborder"><input type="text" name="posttax" size="4"></td>
                    <td colspan="6" class="noborder">&larr;<span style="text-decoration: underline;"> Enter the total post-tax deductions, such as journey insurance.</span></td>
                </tr>
                <tr class="noborder"><td colspan="5" class="noborder"><input type="submit" value="Calculate" class="button"></td></tr>
                <input type="hidden" value="<?php echo $rate; ?>" name="rate">
                <input type="hidden" value="<?php echo $role; ?>" name="role">
                <input type="hidden" value="<?php echo $date; ?>" name="date">
                <input type="hidden" value="<?php echo $ls; ?>" name="fn">
                </form>
            </table>
        </div>
    </div>
    <script>
    function disableInput() {
            if ($(this).is(':checked')) {
                $(this).parent().siblings().children().attr("disabled", true);
            } else {
                $(this).parent().siblings().children().attr("disabled", false);
            }
        };
    </script>
</body>
</html>
