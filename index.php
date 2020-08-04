<?php
include('includes/header.php');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crew Pay Calculator</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Darker+Grotesque" type="text/css">
    <link rel="stylesheet" href="styles/reset.css" type="text/css">
    <link rel="stylesheet" href="styles/style.css?version=1.16" type="text/css">
</head>
<body>
    <div id="body-outer">
        <div id="body-inner">
            <h1>Crew Pay Calculator</h1>
            <br>
            <form id="prefill" method="post" action="timesheet.php">
                <input type="hidden" name="form" value="prefill">
            <table>
                <tr>
                    <td>Fortnight ending:</td>
                    <td class="empty"></td>
                    <td><input name="date" type="date"></td>
                </tr>
                <tr>
                    <td>Hourly rate:</td>
                    <td class="empty"></td>
                    <td>$<input name="rate" type="text"></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td class="empty"></td>
                    <td><select name="role" form="prefill">
                        <option value="">&nbsp;</option>
                        <option value="Driver">Driver</option>
                        <option value="Guard">Guard</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Long/short:</td>
                    <td class="empty"></td>
                    <td><select name="ls" form="prefill">
                        <option value="">&nbsp;</option>
                        <option value="Long">Long</option>
                        <option value="Short">Short</option>
                    </select></td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" class="centre"><input type="submit" value="Continue"></td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</body>
</html>
