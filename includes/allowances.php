<?php
if($cabetr == 'on') {
    $detail = 'Cab/ETR';
    $units = 1;
    $rate = $cabetrrate;
    $payslip[$i][] = '';
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
}
if($security == 'on' && $role != 'Driver') {
    $detail = 'Security';
    $units = 1;
    $rate = $securityrate;
    $payslip[$i][] = '';
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
}
if($expenses == 'on') {
    $detail = 'Expenses > 10 hours';
    $units = 1;
    $rate = $expensesrate;
    $payslip[$i][] = '';
    $payslip[$i][] = $detail;
    $payslip[$i][] = $units;
    $payslip[$i][] = $rate;
}
?>
