<?php
if($start) {
    ++$OTcount;
}
// if($phol == 'on') {
//     if($OTcount > 9 && $fn == 'Short') {
//         $postday = 'Phol2';
//     }
//     elseif($OTcount > 10 && $fn == 'Long') {
//         $postday = 'Phol2';
//     }
//     elseif($postday == 'Sat') {
//         $postday = 'Phol2';
//     }
//     else {
//         $postday = 'Phol';
//     }
// }
// if($postday == 'Sat') {
//     if($OTcount > 10 && $fn == 'Long') {
//         $postday = 'OT2';
//     }
//     elseif($OTcount > 9 && $fn == 'Short') {
//         $postday = 'OT2';
//     }
// }
// elseif($OTcount > 9 && $OTcount < 12 && $fn == 'Short') {
//     $postday = 'OT';
// }
// elseif($OTcount == 12 && $fn == 'Short') {
//     $postday = 'OT2';
// }
// elseif($OTcount > 10 && $fn == 'Long') {
//     $postday = 'OT';
// }
if($phol == 'on') {
    $detail = 'Public holiday worked';
    $rate = 1;
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $units = $return[0];
        if($OTcount > 9 && $fn == 'Short') {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday @ 100%';
            $units = $return[0];
            $rate = 1;
        }
        elseif($OTcount > 10 && $fn == 'Long') {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday @ 100%';
            $units = $return[0];
            $rate = 1;
        }
        elseif($postday == 'Sat') {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday @ 100%';
            $units = $return[0];
            $rate = 1;
        }
        elseif($callout == 'on') {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday under 24 hours @ 75%';
            $units = $return[0];
            $rate = 0.75;
        }
        else {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday @ 50%';
            $units = $return[0];
            $rate = 0.5;
        }
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = overnight($start,$finish,$lulb,$buildup);
        $units = $return[0];
        if($OTcount > 9 && $fn == 'Short') {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday @ 100%';
            $units = $return[0];
            $rate = 1;
        }
        elseif($OTcount > 10 && $fn == 'Long') {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday @ 100%';
            $units = $return[0];
            $rate = 1;
        }
        elseif($postday == 'Sat') {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday @ 100%';
            $units = $return[0];
            $rate = 1;
        }
        elseif($callout == 'on') {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday under 24 hours @ 75%';
            $units = $return[0];
            $rate = 0.75;
        }
        else {
            $payslip[$detail][] = $date;
            $payslip[$detail][] = $units;
            $payslip[$detail][] = $rate;
            $detail = 'Public holiday @ 50%';
            $units = $return[0];
            $rate = 0.5;
        }
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        if($postday == 'Sat') {
            $payslip['Ordinary hours'][] += $return[1];
            $detail = 'Sunday @ 100%';
            $units = $return[1];
            $rate = 1;
        $payslip[$date][] = $detail;
            $payslip[$date][] = $units;
            $payslip[$date][] = $rate;
            $detail = 'Scheduled OT @ 200%';
            $units = $return[3];
            $rate = 2;
        $payslip[$date][] = $detail;
            $payslip[$date][] = $units;
            $payslip[$date][] = $rate;
        }
        elseif($postday == 'Fri') {
            $payslip['Ordinary hours'][] += $return[1];
            $detail = 'Saturday @ 50%';
            $units = $return[1];
            $rate = 0.5;
        $payslip[$date][] = $detail;
            $payslip[$date][] = $units;
            $payslip[$date][] = $rate;
            $detail = 'Scheduled OT @ 150%';
            $units = $return[2];
            $rate = 1.5;
        $payslip[$date][] = $detail;
            $payslip[$date][] = $units;
            $payslip[$date][] = $rate;
            $detail = 'Scheduled OT @ 200%';
            $units = $return[3];
            $rate = 2;
        $payslip[$date][] = $detail;
            $payslip[$date][] = $units;
            $payslip[$date][] = $rate;
        }
    }
}
elseif($postday == 'Sun') { // Sunday calculations
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $payslip['Ordinary hours'][] += $return[0];
        $detail = 'Sunday @ 100%';
        $units = $return[0];
        $rate = 1;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = overnight($start,$finish,$lulb,$buildup);
        $payslip['Ordinary hours'][] += $return[0]+$return[1];
        $detail = 'Sunday @ 100%';
        $units = $return[0];
        $rate = 1;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[2];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[3];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    if($callout == 'on') {

    }
}
elseif($postday == 'Sat' && $OTcount > 9 && $fn == 'Short') { // Saturday OT on short
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'OT @ 200%';
        $units = $return[0];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'OT @ 200%';
        $units = $return[0];
        $rate = 2;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2]+$return[3];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    if($callout == 'on') {

    }
}
elseif($postday == 'Sat' && $OTcount > 10 && $fn == 'Long') { // Saturday OT on long
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'OT @ 200%';
        $units = $return[0];
        $rate = 2;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'OT @ 200%';
        $units = $return[0];
        $rate = 2;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2]+$return[3];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    if($callout == 'on') {

    }
}
elseif($OTcount > 9 && $OTcount < 12 && $fn == 'Short') { // Short 150% OT shifts
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        if($phol == 'on') {
            $detail = 'Public Holiday @ 200%';
            $units = $return[0];
            $rate = 2;
        }
        else {
            $detail = 'OT @ 150%';
            $units = $return[0];
            $rate = 1.5;
        }
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        if($phol == 'on') {
            $detail = 'Scheduled OT @ 200%';
            $units = $return[1]+$return[2];
            $rate = 2;
        }
        else {
            $detail = 'Scheduled OT @ 150%';
            $units = $return[1];
            $rate = 1.5;
        }
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        if($phol == 'on') {
            $detail = '';
            $units = '';
            $rate = '';
        }
        else {
            $detail = 'Scheduled @ 200%';
            $units = $return[2];
            $rate = 2;
        }
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = overnight($start,$finish,$lulb,$buildup);
        if($phol == 'on') {
            $detail = 'Public Holiday @ 200%';
            $units = $return[0];
            $rate = 2;
        }
        else {
            $detail = 'OT @ 150%';
            $units = $return[0];
            $rate = 1.5;
        }
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        if($phol == 'on') {
            $detail = 'Scheduled OT @ 200%';
            $units = $return[2];
            $rate = 1.5;
        }
        else {
            $detail = 'Scheduled OT @ 150%';
            $units = $return[2];
            $rate = 1.5;
        }
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        if($phol == 'on') {
            $detail = '';
            $units = '';
            $rate = '';
        }
        else {
            $detail = 'Scheduled OT @ 200%';
            $units = $return[3];
            $rate = 2;
        }
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    if($phol != 'on') {

    }
}
elseif($OTcount == 12 && $fn == 'Short') { // Short 200% OT shift
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'OT @ 200%';
        $units = $return[0];
        $rate = 2;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = overnight($start,$finish,$lulb,$buildup);
        $detail = 'OT @ 200%';
        $units = $return[0];
        $rate = 200;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2]+$return[3];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    if($callout == 'on') {

    }
}
elseif($OTcount > 10 && $fn == 'Long') { // Long 150% OT shift
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'OT @ 150%';
        $units = $return[0];
        $rate = 1.5;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[1];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled @ 200%';
        $units = $return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = overnight($start,$finish,$lulb,$buildup);
        $detail = 'OT @ 150%';
        $units = $return[0]+$return[1];
        $rate = 1.5;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[2];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[3];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    if($callout == 'on') {

    }
}
elseif($postday == 'Sat') { // Saturday calculations
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'Saturday @ 150%';
        $units = $return[0];
        $rate = 1.5;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[1]+$return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = overnight($start,$finish,$lulb,$buildup);
        $detail = 'Saturday @ 150%';
        $units = $return[0];
        $rate = 1.5;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Ordinary Hours';
        $units = $return[2];
        $rate = 1;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[3];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[4];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    if($callout == 'on') {

    }
}
elseif($postday == 'Fri') { // Friday calculations
    if($start < $finish) {
        $return = dayof($start,$finish,$lulb,$buildup);
        if($callout == 'on') {
            $detail = 'Call out @ 125%';
            $units = $return[0];
            $rate = 1.25;
        }
        else {
            $detail = 'Ordinary hours';
            $units = $return[0];
            $rate = 1;
        }
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[1];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled @ 200%';
        $units = $return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    elseif($start > $finish) {
        $return = overnight($start,$finish,$lulb,$buildup);
        if($callout == 'on') {
            $detail = 'Call out @ 125%';
            $units = $return[0];
            $rate = 1.25;
        }
        else {
            $detail = 'Ordinary hours';
            $units = $return[0];
            $rate = 1;
        }
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Saturday @ 150%';
        $units = $return[1];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[2]+$return[3];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    if(empty($callout) || $callout == 'off') {
        $all = shiftallowances($start,$finish,$return,$phol);
        $units = 0;
        $detail = $all[0];
        $units = $all[1];
        $rate = $all[2];
        $nsdetail = $all[3];
        $nsunits = $all[4];
        $nsrate = $all[5];
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
            $payslip[$date][] = $nsdetail;
        $payslip[$date][] = $nsunits;
        $payslip[$date][] = $nsrate;
    }
}
elseif($start < $finish) { // Standard hours same day
    if($callout == 'on') {
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'Call out @ 125%';
        $units = $return[0];
        $rate = 1.25;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[1];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled @ 200%';
        $units = $return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    else{
        $return = dayof($start,$finish,$lulb,$buildup);
        $detail = 'Ordinary hours';
        $units = $return[0];
        $rate = 1;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[1];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled @ 200%';
        $units = $return[2];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $all = shiftallowances($start,$finish,$return,$phol);
        $detail = $all[0];
        $units = $all[1];
        $rate = $all[2];
        $nsdetail = $all[3];
        $nsunits = $all[4];
        $nsrate = $all[5];
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
            $payslip[$date][] = $nsdetail;
        $payslip[$date][] = $nsunits;
        $payslip[$date][] = $nsrate;
    }
}
elseif($start > $finish) { // Standard hours overnight
    if($callout == 'on') {
        $return = overnight($start,$finish,$lulb,$buildup);
        $detail = 'Call out @ 125%';
        $units = $return[0];
        $rate = 1.25;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Saturday @ 150%';
        $units = $return[1];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[2]+$return[3];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
    }
    else {
        $return = overnight($start,$finish,$lulb,$buildup);
        $detail = 'Ordinary hours';
        $units = $return[0]+$return[1];
        $rate = 1;
        $payslip[$date][] = $date;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 150%';
        $units = $return[2];
        $rate = 1.5;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $detail = 'Scheduled OT @ 200%';
        $units = $return[3];
        $rate = 2;
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $all = shiftallowances($start,$finish,$return,$phol);
        $detail = $all[0];
        $units = $all[1];
        $rate = $all[2];
        $nsdetail = $all[3];
        $nsunits = $all[4];
        $nsrate = $all[5];
        $payslip[$date][] = $detail;
        $payslip[$date][] = $units;
        $payslip[$date][] = $rate;
        $payslip[$date][] = $nsdetail;
        $payslip[$date][] = $nsunits;
        $payslip[$date][] = $nsrate;
    }
}
?>
