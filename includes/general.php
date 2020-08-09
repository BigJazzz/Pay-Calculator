<?php
    $days = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
    // Initialise variables
    (float)$i = 1;
    (float)$sicktime = 0;
    (float)$sickcount = 0;
    (float)$ordinary = 0; // 100%
    (float)$OTcallout = 0; // Call out - 125%
    (float)$sat = 0; // 150%
    (float)$sun = 0; // 200%
    (float)$sOThalf = 0; // Shift over 8 hours M-F
    (float)$sOTdouble = 0; // Shift over 11 hours M-F / Shift over 8 hours Sa
    (float)$OThalf = 0; // Excess shift 150% - up to 11 hours
    (float)$OTdouble = 0; // Excess shift 200% - incl over 11 hours on 150% OThalf
    (float)$OTcount = 0; // Count for excess shift calculation
    (float)$h = 0; // Hours
    (float)$m = 0; // Minutes
    if(!basename($_SERVER['PHP_SELF'])) {
        $fn = $_POST['fn']; // Short / long fortnight
    }
    $taxarray = array( // Upper threshold, a, b
        array(354,0,0),
        array(421,0.1900,67.4635),
        array(527,0.2900,109.7327),
        array(710,0.2100,67.4635),
        array(1283,0.3477,165.4423),
        array(1729,0.3450,161.9808),
        array(3460,0.3900,239.8654),
        array(3461,0.4700,516.7885)
    ); // a*(earnings/2)-b=witholding*2 = witholding amount
    $daydetails = array(
            'Sun' => array('Sunday @ 200%', 2, 'Scheduled OT @ 200%', 2, 'Scheduled OT @ 200%', 2),
            'Mon' => array('Ordinary hours', 1, 'Scheduled OT @ 150%', 1.5, 'Scheduled OT @ 200%', 2),
            'Tue' => array('Ordinary hours', 1, 'Scheduled OT @ 150%', 1.5, 'Scheduled OT @ 200%', 2),
            'Wed' => array('Ordinary hours', 1, 'Scheduled OT @ 150%', 1.5, 'Scheduled OT @ 200%', 2),
            'Thu' => array('Ordinary hours', 1, 'Scheduled OT @ 150%', 1.5, 'Scheduled OT @ 200%', 2),
            'Fri' => array('Ordinary hours', 1, 'Scheduled OT @ 150%', 1.5, 'Scheduled OT @ 200%', 2),
            'Sat' => array('Saturday @ 150%', 1.5, 'Scheduled OT @ 200%', 2, 'Scheduled OT @ 200%', 2),
            'OT' => array('OT @ 150%', 1.5, 'Scheduled OT @ 200%', 2, 'Scheduled OT @ 200%', 2),
            'OT2' => array('OT @ 200%', 2, 'Scheduled OT @ 200%', 2, 'Scheduled OT @ 200%', 2),
            'Phol' => array('Public holiday @ 150%', 1.5, 'Scheduled OT @ 200%', 2, 'Scheduled OT @ 200%', 2),
            'Phol2' => array('Public holiday @ 200%', 200, 'Scheduled OT @ 200%', 2, 'Scheduled OT @ 200%', 2),
            'CO' => array('Under 24 hours @ 125%', 1.25, 'Scheduled OT @ 150%', 1.5, 'Scheduled OT @ 200%', 2)
    );
?>
