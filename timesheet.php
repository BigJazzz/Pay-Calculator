<?php
// if(empty($_POST) || !isset($_POST) || $_POST == '') {
//     header("Location: https://calc.ssby.me");
//     die();
// }
// if(isset($_GET) && $_GET["t"] != 'y') {
//     header("Location: https://calc.ssby.me");
//     die();
// }
ini_set('display_errors', 'Off');
ini_set('session.cookie_lifetime', 60*60*24*365);
ini_set('session.save_path', '/home/bigjazzzss/calc.ssby.me/session');
session_start();
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
    <!-- <script src="includes/js.php?version=<?php echo $css; ?>"></script> -->
    <?php if(!isset($_COOKIE['alert'])) { ?>
    <script>
        alert('If this is your first time using this calculator, please tap the \'i\' button.');
    </script>
    <?php }; ?>
    <?php
        setcookie('alert','seen',time()+(86400 * 30), "/");
    ?>
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
                    <td colspan="7">&nbsp;</td>
                </tr>
            </table>
            <table id="timesheet">
                <thead class="header">
                    <th>Day</th>
                    <th>Date</th>
                    <th>Start</th>
                    <th>Finish</th>
                    <th>LU/LB</th>
                    <th>Build Up</th>
                    <th>Mileage</th>
                    <th>Cab/ETR</th>
                    <th>Security</th>
                    <th>Expenses</th>
                    <th>Call Out</th>
                    <?php //<th>WOBOD</th> ?>
                    <th>Public Holiday</th>
                    <th>HOL N/R</th>
                    <th>Sick</th>
                    <th>Training</th>
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
                            $calloutB = '<input type="hidden" name="callout'.$i.'" value="off" class="disable'.$i.'"></td>';
                        }
                        else {
                            $calloutB = '<input type="checkbox" name="callout'.$i.'" class="disable'.$i.'"></td>';
                        }
                        if($role == 'Driver') {
                            $securityB = '<input type="hidden" name="security'.$i.'" value="off" class="disable'.$i.'">N/A</td>';
                        }
                        else {
                            $securityB = '<input type="checkbox" name="security'.$i.'" class="disable'.$i.'"></td>';
                        }
                        if($day == 'Sun') {
                            $pholB = '<input type="hidden" name="phol'.$i.'" value="off" class="disable'.$i.'"></td>';
                        }
                        else {
                            $pholB = '<input type="checkbox" name="phol'.$i.'" class="disable'.$i.'"></td>';
                        }
                        echo '<tr>'."\n";
                        echo '<td class="border ">'.$day.'<input type="hidden" value="'.$day.$dayi.'" name="dayid'.$i.'"><input type="hidden" value="'.$day.'" name="day'.$i.'"></td>'."\n";
                        echo '<td class="border">'.$shortdate.'<input type="hidden" value="'.$shortdate.'" name="date'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="start'.$i.'" size="4" max="2400" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="finish'.$i.'" size="4" max="2400" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="lulb'.$i.'" size="4" pattern="[0-9]{2}:[0-9]{2}" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="buildup'.$i.'" size="4" pattern="[0-9]{2}:[0-9]{2}" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="text" name="mileage'.$i.'" size="4" pattern="[0-9]{2}:[0-9]{2}" class="time disable'.$i.'"></td>'."\n";
                        echo '<td class="border"><input type="checkbox" name="cabetr'.$i.'" class="disable'.$i.'"></td>'."\n";
                        echo '<td class="border disable'.$i.'">'.$securityB."\n";
                        echo '<td class="border disable'.$i.'"><input type="checkbox" name="expenses'.$i.'" class="disable'.$i.'"></td>'."\n";
                        echo '<td class="border disable'.$i.'">'.$calloutB."\n";
                        //echo '<td class="border disable'.$i.'"><input type="checkbox" name="wobod'.$i.'"></td>'."\n";
                        echo '<td class="border disable'.$i.'">'.$pholB."\n";
                        echo '<td class="border disable'.$i.'"><input type="checkbox" name="holnr'.$i.'" class="disable'.$i.'"></td>'."\n";
                        echo '<td class="border disable'.$i.'"><input type="checkbox" name="sick'.$i.'" class="disable'.$i.'"></td>'."\n";
                        echo '<td class="border disable'.$i.'"><input type="checkbox" name="training'.$i.'" class="disable'.$i.'"></td>'."\n";
                        echo '</tr>'."\n";
                        $startdate = $shortdatex[2].'-'.$shortdatex[1].'-'.$shortdatex[0];
                        $startdate = strtotime('+1 day', strtotime($startdate));
                        $startdate = date('d-m-Y', $startdate);
                        $i++;
                        $ix++;
                    }
                    if($role == 'Guard') {
                        echo '<tr class="noborder">';
                        echo     '<td class="noborder" colspan="3">WOBOD payments</td>';
                        echo     '<td class="noborder"><input type="text" name="wobod" size="4" pattern="[0-9]{2}:[0-9]{2}"></td>';
                        echo     '<td colspan="6" class="noborder">&larr; <span style="text-decoration: underline;">Enter the total time for WOBOD payments from prior fortnight.</span></td>';
                        echo '</tr>';
                    }
                ?>
                <!-- <tr class="noborder">
                    <td class="noborder" colspan="3">Extra payments (dollars)</td>
                    <td class="noborder"><input type="text" name="extrad" size="4"></td>
                    <td colspan="6" class="noborder">&larr; <span style="text-decoration: underline;">Enter the total dollar amount for additional payments, <span style="font-weight: bold;">excluding WOBOD</span>.</span></td>
                </tr>
                <tr class="noborder">
                    <td class="noborder" colspan="3">Extra payments (time)</td>
                    <td class="noborder"><input type="text" name="extrat" size="4" pattern="[0-9]{2}:[0-9]{2}"></td>
                    <td colspan="8" class="noborder">&larr; <span style="text-decoration: underline;">Enter the time for additional hours claimed, <span style="font-weight: bold;">excluding WOBOD</span>, where not accounted for already. (Calculated at standard rates.)</span></td>
                </tr> -->
                <tr class="noborder">
                    <td class="noborder" colspan="3">Pre-tax deductions</td>
                    <td class="noborder"><input type="text" name="pretax" size="4"></td>
                    <td colspan="6" class="noborder">&larr; <span style="text-decoration: underline;">Enter the total pre-tax deductions, such as Maxxia.</span></td>
                </tr>
                <tr class="noborder">
                    <td class="noborder" colspan="3">Post-tax deductions</td>
                    <td class="noborder"><input type="text" name="posttax" size="4"></td>
                    <td colspan="6" class="noborder">&larr; <span style="text-decoration: underline;">Enter the total post-tax deductions, such as journey insurance.</span></td>
                </tr>
                <tr class="noborder"><td colspan="5" class="noborder"><input type="submit" value="Calculate" class="button"></td></tr>
                <input type="hidden" value="<?php echo $rate; ?>" name="rate">
                <input type="hidden" value="<?php echo $role; ?>" name="role">
                <input type="hidden" value="<?php echo $date; ?>" name="date">
                <input type="hidden" value="<?php echo $ls; ?>" name="fn">
                </form>
            </table>
        </div>
        <div id="button">
            <a href="javascript:void(0)" onclick="openNav()"><img src="images/info.png" style="filter: invert(15%) sepia(83%) saturate(2070%) hue-rotate(341deg) brightness(124%) contrast(93%);"></a>
        </div>
        <div id="info">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <h1>Info</h1>
            <br>
            <p>&bull; To report issues, head to the <a href="https://github.com/BigJazzz/Pay-Calculator/issues" target="_blank">issue tracker</a></p>
            <p>&bull; Please enter all start/finish/mileage times in XXXX</p>
            <p>&bull; Please enter all LU/LB/BU and additional payment times in XX:XX</p>
            <p>&bull; This calculator doesn't currently support relinquished shifts, or mid-cycle changes to pay rates and allowances</p>
            <p id="credit">Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></p>
            </div>
        </div>
        <div id="footer">To report issues, head to the <a href="https://github.com/BigJazzz/Pay-Calculator/issues" target="_blank">issue tracker</a></div>
    </div>
    <?php
    $i = 1;
    echo '<script>'."\r\n";
    while($i < 15) {
        echo '$(\'input[name="sick'.$i.'"]\').click(function() {'."\r\n";
        echo    'if ($(this).is(\':checked\')) {'."\r\n";
        echo            '$(".disable'.$i.'").prop("disabled", true);'."\r\n";
        echo            '$(this).prop("disabled", false);'."\r\n";
        echo        '} else {'."\r\n";
        echo            '$(".disable'.$i.'").prop("disabled", false);'."\r\n";
        echo        '}'."\r\n";
        echo '});'."\r\n";
        echo '$(\'input[name="training'.$i.'"]\').click(function() {'."\r\n";
        echo    'if ($(this).is(\':checked\')) {'."\r\n";
        echo            '$(".disable'.$i.'").prop("disabled", true);'."\r\n";
        echo            '$(this).prop("disabled", false);'."\r\n";
        echo        '} else {'."\r\n";
        echo            '$(".disable'.$i.'").prop("disabled", false);'."\r\n";
        echo        '}'."\r\n";
        echo '});'."\r\n";
        echo '$(\'input[name="holnr'.$i.'"]\').click(function() {'."\r\n";
        echo    'if ($(this).is(\':checked\')) {'."\r\n";
        echo            '$(".disable'.$i.'").prop("disabled", true);'."\r\n";
        echo            '$(this).prop("disabled", false);'."\r\n";
        echo        '} else {'."\r\n";
        echo            '$(".disable'.$i.'").prop("disabled", false);'."\r\n";
        echo        '}'."\r\n";
        echo '});'."\r\n";
        $i++;
    }
    echo '</script>'."\r\n";
    ?>
    <script>
        /* Set the width of the side navigation to 250px */
        function openNav() {
          document.getElementById("info").style.width = "300px";
        }

        /* Set the width of the side navigation to 0 */
        function closeNav() {
          document.getElementById("info").style.width = "0";
        }
    </script>
</body>
</html>
