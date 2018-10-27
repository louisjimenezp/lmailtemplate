<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use LMailTemplate\LMailLayout;

$mail = new LMailLayout();
$mail->setContent('{i18n-hello} <strong style="color: #ccc;">{i18n-world}</strong>!!!');
$mail->addBinds([
    'i18n-hello' => 'Hello',
    'i18n-world' => 'World'
]);
$mail->print();