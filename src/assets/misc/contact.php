<?php
$c = true;

$project_name = "CryptInvest.biz";
$admin_email  = "crypto@mobiagency.ru";
$form_subject = "Новая заявка с сайта";

$reply_to = $admin_email;

foreach ( $_POST as $key => $value ) {
    if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
        $message .= "
        " . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
            <td width='50px' style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
            <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
        </tr>
        ";
    }
}

$message = "<table cellspacing='0' style='width: 100%;'>$message</table>";

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name).' <'.$reply_to.'>' . PHP_EOL .
'Reply-To: ' . $reply_to . PHP_EOL;


mail($admin_email, adopt($form_subject), $message, $headers);
