<?php
    // Converts time to decimal
    function timeconvert($time) {
        $h = 0;
        $m = 0;
        if(strlen($time) < 4) {
            $time = '0'.$time;
        }
        if($time > 0) {
            $h = substr($time,0,2);
            $m = substr($time,2);
            $h = floatval($h);
            $m = floatval($m);
            $m = $m/60;
        }
        $time = $h+$m;
        $time = round($time, 2);
        return($time);
    }
    // in_array() for multidimensional arrays
    function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }
    // Calculates work when starting/finishing on the same day
    function dayof($start, $finish, $lulb, $buildup) {
        $total = $finish-$start+$lulb+$buildup;
        $base = 0;
        $OThalf = 0;
        $OTdouble = 0;
        if($total <= 8) {
            $base = $total;
        }
        elseif($total > 8 && $total <= 11) {
            $base = 8;
            $OThalf = $total-$base;
        }
        else {
            $base = 8;
            $OThalf = 3;
            $OTdouble = $total-11;
        }
        $return = array($base,$OThalf,$OTdouble);
        return($return);
    }
    // Calculates work when starting before and finishing after midnight
    function overnight($start, $finish, $lulb, $buildup) {
        $day1 = 24-$start;
        $day2 = $finish;
        $total = $day1+$day2+$lulb+$buildup;
        // 150% overnight; 8 hours before midnight
        if($day1 > 8 && $day1 <= 11) {
            $base1 = 8;
            $sOThalf = $total-8;
        }
        // 200% overnight; 11 hours before midnight
        elseif($day1 > 11) {
            $base1 = 8;
            $sOThalf = 3;
            $sOTdouble = $day1-$sOThalf-$base1+$day2;
        }
        // Standard hours over midnight; no OT
        elseif($total <= 8) {
            $base1 = $day1;
            $base2 = $day2;
        }
        // 150% overnight; 8 hours after midnight
        elseif($total > 8 && $total <= 11) {
            $base1 = $day1;
            $base2 = 8-($day1);
            $OThalf = $total-8;
        }
        // 200% overnight; 8 hours after midnight
        else {
            $base1 = $day1;
            $base2 = 8-($day1);
            $OThalf = 3;
            $OTdouble = $total-11;
        }
        $return = array($base1,$base2,$OThalf,$OTdouble);
        return($return);
    }
    // Calculates overtime on hours claimable, including LU/LB
    function overtime($time) {
        if($time > 8 && $time <= 11) {
            $base = 8;
            $OThalf = $time-8;
        }
        else {
            $base = 8;
            $OThalf = 3;
            $OTdouble = $time-11;
        }
        $return = array($base,$OThalf,$OTdouble);
        return($return);
    }
    // Shift allowances
    function shiftallowances($start,$finish,$calc,$phol) {
        if($day != 'Sun' && $day != 'Sat' && $phol != 'on' && !empty($start)) {
            global $ashiftrate, $nshiftrate, $mshiftrate, $slrate, $day;
            if($start < $finish) {
                $units = round($calc[0]);
            }
            else {
                $return2[] = $calc[0];
                $return2[] = $calc[1];
                if($day == 'Fri') {
                    $units = round($return2[0]);
                }
                else {
                    $round = $return2[0]+$return2[1];
                    $units = round($round);
                }
            }
            if($units > 8) {
                $units = 8;
            }
            if($start < 18 && $finish > 18) {
                $detail = 'Afternoon shift';
                $rate = $ashiftrate;
            }
            elseif($start < 18 && $finish < 8) {
                $detail = 'Afternoon shift';
                $rate = $ashiftrate;
            }
            if($start >= 18 || $start <= 3.98) {
                $detail = 'Night shift';
                $rate = $nshiftrate;
            }
            if($start >= 4 && $start <= 5.5) {
                $detail = 'Morning shift';
                $rate = $mshiftrate;
            }
            if(empty($phol)) {
                if($start >= 1.02 && $start <= 3.98) {
                    $nsdetail = 'Special loading';
                    $nsunits = 1;
                    $nsrate = $slrate;
                }
                elseif($finish >= 1.02 && $finish <= 3.98) {
                    $nsdetail = 'Special loading';
                    $nsunits = 1;
                    $nsrate = $slrate;
                }
            }
        }
        $return = array($detail,$units,$rate,$nsdetail,$nsunits,$nsrate);
        unset($start,$finish,$day,$calc);
        return($return);
    }
    // Allowances
    function allowances($cab,$sec,$exp) {
        global $cabetrrate,$securityrate,$expensesrate,$date;
        if($cab == 'on') {
            $detail = 'Cab/ETR';
            $units = 1;
            $rate = $cabetrrate;
            $e[] = $detail;
            $e[] = $units;
            $e[] = $rate;
        }
        if($sec == 'on' && $role != 'Driver') {
            $detail = 'Security';
            $units = 1;
            $rate = $securityrate;
            $e[] = $detail;
            $e[] = $units;
            $e[] = $rate;
        }
        if($exp == 'on') {
            $detail = 'Expenses > 10 hours';
            $units = 1;
            $rate = $expensesrate;
            $e[] = $detail;
            $e[] = $units;
            $e[] = $rate;
        }
        return($e);
    }
    // Calculates witholding
    function taxwitholding($gross,$taxarray) {
        // Code
    }
?>
