<?php
$i = 1;
while($i <= 14) {
    echo '<script>
    $("input[name=\'sick'.<?php echo $i; ?>.'\']").click(function () {
        if ($(this).is(\':checked\')) {
            $(\'input.disable'.<?php echo $i; ?>.':text\').val(\'\');
            $(\'input.disable'.<?php echo $i; ?>.':text\').attr("disabled", true);
        } else if ($(this).not(\':checked\')) {
            $(\'input.disable'.<?php echo $i; ?>.':text\').attr("disabled", false);
        }
    });
    </script>';
$i++;
}
?>
