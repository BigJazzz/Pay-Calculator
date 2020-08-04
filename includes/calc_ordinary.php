<?php
if($start < $finish) {
    $ordinary += dayof($start,$finish);
    $ordinary += $lulb;
    $ordinary += $buildup;
    $OTcount++;
    continue;
}
else {
    $results = overnight($start,$finish);
    $ordinary += $results[0];
    $ordinary += $results[1];
    $sOThalf  += $results[2];
    $sOTdouble += $results[3];
    $OTcount++;
    continue;
}
?>
