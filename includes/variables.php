<?php
// Start time
$poststart = 'start'.$i;
$start = $_POST[$poststart];
$start = timeconvert($start);
// Finish time
$postfinish = 'finish'.$i;
$finish = $_POST[$postfinish];
$finish = timeconvert($finish);
// Lift up / lay back
$postlulb = 'lulb'.$i;
$lulb = $_POST[$postlulb];
$lulb = timeconvert($lulb);
// Build up
$postbuildup = 'buildup'.$i;
$buildup = $_POST[$postbuildup];
$buildup = timeconvert($buildup);
// Mileage
$postmileage = 'mileage'.$i;
$mileage = $_POST[$postmilage];
$mileage = timeconvert($mileage);
// Cab / ETR
$postcabetr = 'cabetr'.$i;
$cabetr = $_POST[$postcabetr];
// Security
$postsecurity = 'security'.$i;
$security = $_POST[$postsecurity];
// Expenses
$postexpenses = 'expenses'.$i;
$expenses = $_POST[$postexpenses];
// Call out
$postcallout = 'callout'.$i;
$callout = $_POST[$postcallout];
// WOBOD
$postwobod = 'wobod'.$i;
$wobod = $_POST[$postwobod];
// Public holiday worked
$postphol = 'phol'.$i;
$phol = $_POST[$postphol];
// PHOL not required
$postholnr = 'holnr'.$i;
$holnr = $_POST[$postholnr];
// Sick
$postsick = 'sick'.$i;
$sick = $_POST[$postsick];
// Training
$posttraining = 'training'.$i;
$training = $_POST[$posttraining];
// Miscellaneous
$postday = 'day'.$i;
$postdayid = 'dayid'.$i;
$postdate = 'date'.$i;
$postday = $_POST[$postday];
$postdayid = $_POST[$postdayid];
$date = $_POST[$postdate];
$ldate = $_POST['date'];
$startdate = date_create($ldate);
date_sub($startdate, date_interval_create_from_date_string('0 days'));
$ldate = date_format($startdate, 'd-m-Y');
$fn = $_POST['fn'];
$payrate = $_POST['rate'];
$wobod = $_POST['wobod'];
$extra = $_POST['extra'];
$pretax = $_POST['pretax'];
$posttax = $_POST['posttax'];
// Allowance rates
$cabetrrate = 7.4;
$securityrate = 5.75;
$ashiftrate = 4.15;
$nshiftrate = 4.89;
$mshiftrate = 4.15;
$slrate = 4.89;
$expensesrate = 10.5;
?>
