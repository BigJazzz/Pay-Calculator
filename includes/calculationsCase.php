<?php
if($start) {
    ++$OTcount;
}
if($start < $finish) {
    $return = dayof($start,$finish,$lulb,$buildup);
}
elseif($start > $finish) {
    $return = overnight($start,$finish,$lulb,$buildup);
}
if($phol == 'on') {
    if($OTcount > 9 && $fn == 'Short') {
        $postday = 'Phol2';
    }
    elseif($OTcount > 10 && $fn == 'Long') {
        $postday = 'Phol2';
    }
    elseif($postday == 'Sat') {
        $postday = 'Phol2';
    }
    else {
        $postday = 'Phol';
    }
}
elseif($postday == 'Sat') {
    if($OTcount > 10 && $fn == 'Long') {
        $postday = 'OT2';
    }
    elseif($OTcount > 9 && $fn == 'Short') {
        $postday = 'OT2';
    }
}
elseif($OTcount > 9 && $OTcount < 12 && $fn == 'Short') {
    $postday = 'OT';
}
elseif($OTcount == 12 && $fn == 'Short') {
    $postday = 'OT2';
}
elseif($OTcount > 10 && $fn == 'Long') {
    $postday = 'OT';
}
elseif($callout == 'on') {
    $postday = 'Callout';
}
switch ($postday) {
    case 'Sun':
        if($start < $finish) {
            $detail = 'Sunday @ 200%';
            $units = $return[0];
            $rate = 2;
            $payslip[$i][] = $date;
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Scheduled OT @ 200%';
            $units = $return[1]+$return[2];
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
        }
        elseif($start > $finish) {
            $detail = 'Sunday @ 200%';
            $units = $return[0];
            $rate = 2;
            $payslip[$i][] = $date;
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Ordinary hours';
            $units = $return[1];
            $rate = 1;
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Scheduled OT @ 150%';
            $units = $return[2];
            $rate = 1.5;
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Scheduled OT @ 200%';
            $units = $return[3];
            $rate = 2;
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
        }
        include('includes/allowances.php');
        break;
    case 'Sat':
        if($start < $finish) {
            $return = dayof($start,$finish,$lulb,$buildup);
            $detail = 'Saturday @ 150%';
            $units = $return[0];
            $rate = 1.5;
            $payslip[$i][] = $date;
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Scheduled OT @ 200%';
            $units = $return[1]+$return[2];
            $rate = 2;
            $payslhip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
        }
        elseif($start > $finish) {
            $return = overnight($start,$finish,$lulb,$buildup);
            $detail = 'Saturday @ 150%';
            $units = $return[0];
            $rate = 1.5;
            $payslip[$i][] = $date;
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Sunday @ 200%';
            $units = $return[1];
            $rate = 2;
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Scheduled OT @ 200%';
            $units = $return[2]+$return[3];
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
        }
        include('includes/allowances.php');
        break;
    case 'Phol':
        if($start < $finish) {
            $return = dayof($start,$finish,$lulb,$buildup);
            $detail = 'Public Holiday @ 150%';
            $units = $return[0];
            $rate = 1.5;
            $payslip[$i][] = $date;
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Scheduled OT @ 200%';
            $units = $return[1]+$return[2];
            $rate = 2;
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
        }
        elseif($start > $finish) {
            $return = overnight($start,$finish,$lulb,$buildup);
            $detail = 'Public Holiday @ 150%';
            $units = $return[0];
            $rate = 1.5;
            $payslip[$i][] = $date;
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            if
            $detail = 'Ordinary hours';
            $units = $return[1];
            $rate = 1;
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
            $detail = 'Scheduled OT @ 200%';
            $units = $return[2]+$return[3];
            $payslip[$i][] = '';
            $payslip[$i][] = $detail;
            $payslip[$i][] = $units;
            $payslip[$i][] = $rate;
        }
        include('includes/allowances.php');
        break;
    default:
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'Ordinary hours';
        $units = $return[0];
        $rate = 1;
        $payslip[$i][] = $date;
        $payslip[$i][] = $detail;
        $payslip[$i][] = $units;
        $payslip[$i][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[1];
        $rate = 1.5;
        $payslip[$i][] = '';
        $payslip[$i][] = $detail;
        $payslip[$i][] = $units;
        $payslip[$i][] = $rate;
        $detail = 'Scheduled @ 200%';
        $units = $return[2];
        $rate = 2;
        $payslip[$i][] = '';
        $payslip[$i][] = $detail;
        $payslip[$i][] = $units;
        $payslip[$i][] = $rate;
        include('includes/allowances.php');
        break;
}
//
// elseif($day == 'Sat14' && $OTcount > 9 && $fn == 'Short') { // Saturday OT on short
//     if($start < $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         $detail = 'OT @ 200%';
//         $units = $return[0];
//         $rate = 2;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[1]+$return[2];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     elseif($start > $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         $detail = 'OT @ 200%';
//         $units = $return[0];
//         $rate = 2;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[1]+$return[2]+$return[3];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($cabetr == 'on') {
//         $detail = 'Cab/ETR';
//         $units = 1;
//         $rate = $cabetrrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($security == 'on' && $role != 'Driver') {
//         $detail = 'Security';
//         $units = 1;
//         $rate = $securityrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($expenses == 'on') {
//         $detail = 'Expenses > 10 hours';
//         $units = 1;
//         $rate = $expensesrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($callout == 'on') {
//
//     }
// }
// elseif($day == 'Sat14' && $OTcount > 10 && $fn == 'Long') { // Saturday OT on long
//     if($start < $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         $detail = 'OT @ 200%';
//         $units = $return[0];
//         $rate = 2;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[1]+$return[2];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     elseif($start > $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         $detail = 'OT @ 200%';
//         $units = $return[0];
//         $rate = 2;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[1]+$return[2]+$return[3];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($cabetr == 'on') {
//         $detail = 'Cab/ETR';
//         $units = 1;
//         $rate = $cabetrrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($security == 'on' && $role != 'Driver') {
//         $detail = 'Security';
//         $units = 1;
//         $rate = $securityrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($expenses == 'on') {
//         $detail = 'Expenses > 10 hours';
//         $units = 1;
//         $rate = $expensesrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($callout == 'on') {
//
//     }
// }
// elseif($OTcount > 9 && $OTcount < 12 && $fn == 'Short') { // Short 150% OT shifts
//     if($start < $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         if($phol == 'on') {
//             $detail = 'Public Holiday @ 200%';
//             $units = $return[0];
//             $rate = 2;
//         }
//         else {
//             $detail = 'OT @ 150%';
//             $units = $return[0];
//             $rate = 1.5;
//         }
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         if($phol == 'on') {
//             $detail = 'Scheduled OT @ 200%';
//             $units = $return[1]+$return[2];
//             $rate = 2;
//         }
//         else {
//             $detail = 'Scheduled OT @ 150%';
//             $units = $return[1];
//             $rate = 1.5;
//         }
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         if($phol == 'on') {
//             $detail = '';
//             $units = '';
//             $rate = '';
//         }
//         else {
//             $detail = 'Scheduled @ 200%';
//             $units = $return[2];
//             $rate = 2;
//         }
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     elseif($start > $finish) {
//         $return = overnight($start,$finish,$lulb,$buildup);
//         if($phol == 'on') {
//             $detail = 'Public Holiday @ 200%';
//             $units = $return[0];
//             $rate = 2;
//         }
//         else {
//             $detail = 'OT @ 150%';
//             $units = $return[0];
//             $rate = 1.5;
//         }
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         if($phol == 'on') {
//             $detail = 'Scheduled OT @ 200%';
//             $units = $return[2];
//             $rate = 1.5;
//         }
//         else {
//             $detail = 'Scheduled OT @ 150%';
//             $units = $return[2];
//             $rate = 1.5;
//         }
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         if($phol == 'on') {
//             $detail = '';
//             $units = '';
//             $rate = '';
//         }
//         else {
//             $detail = 'Scheduled OT @ 200%';
//             $units = $return[3];
//             $rate = 2;
//         }
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($cabetr == 'on') {
//         $detail = 'Cab/ETR';
//         $units = 1;
//         $rate = $cabetrrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($security == 'on' && $role != 'Driver') {
//         $detail = 'Security';
//         $units = 1;
//         $rate = $securityrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($expenses == 'on') {
//         $detail = 'Expenses > 10 hours';
//         $units = 1;
//         $rate = $expensesrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($callout == 'on') {
//         continue;
//     }
// }
// elseif($OTcount == 12 && $fn == 'Short') { // Short 200% OT shift
//     if($start < $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         $detail = 'OT @ 200%';
//         $units = $return[0];
//         $rate = 2;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[1]+$return[2];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     elseif($start > $finish) {
//         $return = overnight($start,$finish,$lulb,$buildup);
//         $detail = 'OT @ 200%';
//         $units = $return[0];
//         $rate = 200;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[1]+$return[2]+$return[3];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($cabetr == 'on') {
//         $detail = 'Cab/ETR';
//         $units = 1;
//         $rate = $cabetrrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($security == 'on' && $role != 'Driver') {
//         $detail = 'Security';
//         $units = 1;
//         $rate = $securityrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($expenses == 'on') {
//         $detail = 'Expenses > 10 hours';
//         $units = 1;
//         $rate = $expensesrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($callout == 'on') {
//
//     }
// }
// elseif($OTcount > 10 && $fn == 'Long') { // Long 150% OT shift
//     if($start < $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         $detail = 'OT @ 150%';
//         $units = $return[0];
//         $rate = 1.5;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 150%';
//         $units = $return[1];
//         $rate = 1.5;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled @ 200%';
//         $units = $return[2];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     elseif($start > $finish) {
//         $return = overnight($start,$finish,$lulb,$buildup);
//         $detail = 'OT @ 150%';
//         $units = $return[0]+$return[1];
//         $rate = 1.5;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 150%';
//         $units = $return[2];
//         $rate = 1.5;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[3];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($cabetr == 'on') {
//         $detail = 'Cab/ETR';
//         $units = 1;
//         $rate = $cabetrrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($security == 'on' && $role != 'Driver') {
//         $detail = 'Security';
//         $units = 1;
//         $rate = $securityrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($expenses == 'on') {
//         $detail = 'Expenses > 10 hours';
//         $units = 1;
//         $rate = $expensesrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($callout == 'on') {
//
//     }
// }
// elseif($day == 'Sat07' || $day == 'Sat14') { // Saturday calculations
//     if($start < $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         $detail = 'Saturday @ 150%';
//         $units = $return[0];
//         $rate = 1.5;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[1]+$return[2];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     elseif($start > $finish) {
//         $return = overnight($start,$finish,$lulb,$buildup);
//         $detail = 'Saturday @ 150%';
//         $units = $return[0];
//         $rate = 1.5;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Ordinary Hours';
//         $units = $return[2];
//         $rate = 1;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 150%';
//         $units = $return[3];
//         $rate = 1.5;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[4];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($cabetr == 'on') {
//         $detail = 'Cab/ETR';
//         $units = 1;
//         $rate = $cabetrrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($security == 'on' && $role != 'Driver') {
//         $detail = 'Security';
//         $units = 1;
//         $rate = $securityrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($expenses == 'on') {
//         $detail = 'Expenses > 10 hours';
//         $units = 1;
//         $rate = $expensesrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($callout == 'on') {
//
//     }
// }
// elseif($day == 'Fri06' || $day == 'Fri13') { // Friday calculations
//     if($callout == 'on') {
//         if($start < $finish) {
//             $return = dayof($start,$finish,$lulb,$buildup);
//             $detail = 'Call out @ 125%';
//             $units = $return[0];
//             $rate = 1.25;
//             $payslip[$i][] = $date;
//             $payslip[$i][] = $detail;
//             $payslip[$i][] = $units;
//             $payslip[$i][] = $rate;
//             $detail = 'Scheduled OT @ 150%';
//             $units = $return[1];
//             $rate = 1.5;
//             $payslip[$i][] = '';
//             $payslip[$i][] = $detail;
//             $payslip[$i][] = $units;
//             $payslip[$i][] = $rate;
//             $detail = 'Scheduled @ 200%';
//             $units = $return[2];
//             $rate = 2;
//             $payslip[$i][] = '';
//             $payslip[$i][] = $detail;
//             $payslip[$i][] = $units;
//             $payslip[$i][] = $rate;
//         }
//         elseif($start > $finish) {
//             $return = overnight($start,$finish,$lulb,$buildup);
//             $detail = 'Call out @ 125%';
//             $units = $return[0];
//             $rate = 1.25;
//             $payslip[$i][] = $date;
//             $payslip[$i][] = $detail;
//             $payslip[$i][] = $units;
//             $payslip[$i][] = $rate;
//             $detail = 'Saturday @ 150%';
//             $units = $return[1];
//             $rate = 1.5;
//             $payslip[$i][] = '';
//             $payslip[$i][] = $detail;
//             $payslip[$i][] = $units;
//             $payslip[$i][] = $rate;
//             $detail = 'Scheduled OT @ 200%';
//             $units = $return[2]+$return[3];
//             $rate = 2;
//             $payslip[$i][] = '';
//             $payslip[$i][] = $detail;
//             $payslip[$i][] = $units;
//             $payslip[$i][] = $rate;
//         }
//     }
//     elseif($start < $finish) {
//         $return = dayof($start,$finish,$lulb,$buildup);
//         $detail = 'Ordinary hours';
//         $units = $return[0];
//         $rate = 1;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 150%';
//         $units = $return[1];
//         $rate = 1.5;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled @ 200%';
//         $units = $return[2];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     elseif($start > $finish) {
//         $return = overnight($start,$finish,$lulb,$buildup);
//         $detail = 'Ordinary hours';
//         $units = $return[0];
//         $rate = 1;
//         $payslip[$i][] = $date;
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Saturday @ 150%';
//         $units = $return[1];
//         $rate = 1.5;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//         $detail = 'Scheduled OT @ 200%';
//         $units = $return[2]+$return[3];
//         $rate = 2;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($cabetr == 'on') {
//         $detail = 'Cab/ETR';
//         $units = 1;
//         $rate = $cabetrrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($security == 'on' && $role != 'Driver') {
//         $detail = 'Security';
//         $units = 1;
//         $rate = $securityrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
//     if($expenses == 'on') {
//         $detail = 'Expenses > 10 hours';
//         $units = 1;
//         $rate = $expensesrate;
//         $payslip[$i][] = '';
//         $payslip[$i][] = $detail;
//         $payslip[$i][] = $units;
//         $payslip[$i][] = $rate;
//     }
// }
elseif($start < $finish) { // Standard hours same day
    $return = dayof($start,$finish,$lulb,$buildup);
    $detail = 'Ordinary hours';
    $units = $return[0];
    $rate = 1;
    $payslip[$i][] = $date;
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
    $detail = 'Scheduled OT @ 150%';
    $units = $return[1];
    $rate = 1.5;
    $payslip[$i][] = '';
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
    $detail = 'Scheduled @ 200%';
    $units = $return[2];
    $rate = 2;
    $payslip[$i][] = '';
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
    }
}
elseif($start > $finish) { // Standard hours overnight
    $return = overnight($start,$finish,$lulb,$buildup);
    $detail = 'Ordinary hours';
    $units = $return[0]+$return[1];
    $rate = 1;
    $payslip[$i][] = $date;
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
    $detail = 'Scheduled OT @ 150%';
    $units = $return[2];
    $rate = 1.5;
    $payslip[$i][] = '';
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
    $detail = 'Scheduled OT @ 200%';
    $units = $return[3];
    $rate = 2;
    $payslip[$i][] = '';
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
}
?>
