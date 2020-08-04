<?php
// if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
//     $location = 'https://' . $_SERVER['HTTP_HOST'] . ':443' . $_SERVER['REQUEST_URI'];
//     header('HTTP/1.1 301 Moved Permanently');
//     header('Location: ' . $location);
//     exit;
// }
// set_error_handler('errorHandler'); // this line of code sets an error handler custom function to handle any php error. And here we pass our custom function that name “errorHandler”
//
// function createTable($array){
//     if(is_array($array) && count($array)>0){
//         $errorContent = "<table border = 1><tr><td>";
//         foreach ($array as $key => $val) {
//             $errorContent .= $key . "</td><td>";
//             if(is_array($val) && count($val)>0){
//                 $errorContent .= createTable(json_decode(json_encode($val),true)) ;
//             }else{
//                 $errorContent .= print_r($val, true) ;
//             }
//         }
//         $errorContent .= "</td></tr></table>";
//         return $errorContent;
//     }
//     return '';
// }
//
// /**
//  *
//  * @param type $errorNumber        // This parameter returns error number.
//  * @param type $errorString           // This parameter returns error string.
//  * @param type $errorFile               // This parameter returns path of file in which error found.
//  * @param type $errorLine              // This parameter returns line number of file in which you get an error.
//  * @param type $errorContext         // This parameter return error context.
//  */
// function errorHandler($errorNumber, $errorString, $errorFile, $errorLine, $errorContext) {
//     $emailAddress = 'j@rryd.xyz';
//     $emailSubject = '[Crew Calc] Error';
//     $emailMessage = 'Error Reporting on :- [' . date("Y-m-d h:i:s", time()) . ']\n';
//     $emailMessage .= "Error Number :- ".print_r($errorNumber, true).'\n';
//     $emailMessage .= "Error String :- ".print_r($errorString, true).'\n';
//     $emailMessage .= "Error File :- ".print_r($errorFile, true).'\n';
//     $emailMessage .= "Error Line :- ".print_r($errorLine, true).'\n';
//     $emailMessage .= "Error Context :- ".createTable($errorContext);
//     $headers = "MIME-Version: 1.0" . "rn";
//     $headers .= "Content-type:text/html;charset=UTF-8" . "rn";
//     mail($emailAddress, $emailSubject, $emailMessage, $headers); // you may use SMTP, default php mail service OR other email sending process
// }
?>
