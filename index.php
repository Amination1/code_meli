<?php
require 'index.view.php';

function code($cm, $sum = 0, $sum2 = 10)
{
    if (strlen($cm) !== 10) {
        echo 'Invalid code length';
        return;
    }

    if (preg_match('/^(\d)\1*$/', $cm)) {
        echo 'Invalid code: repetitive digits';
        return;
    }

    $numbers = str_split($cm, 1);
    $control = $numbers[9];
    unset($numbers[9]);

    foreach ($numbers as $number) {
        $sum += $number * $sum2;
        $sum2--;
    }

    $cm = $sum % 11;

    if (($cm <= 2 && $cm === (int)$control) || ($cm > 2 && $control == 11 - $cm)) {
        echo 'This code is true';
    } else {
        echo 'This code is false';
    }
}

if (!empty($_POST['code'])) {
    code($_POST['code']);
}

