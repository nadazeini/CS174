<?php

function roman($number)
{
    $values = array(
        1 => "I",
        4 => "IV",
        5 => "V",
        9 => "IX",
        10 => "X",
        40 => "XL",
        50 => "L",
        90 => "XC",
        100 => "C",
        400 => "CD",
        500 => "D",
        900 => "CM",
        1000 => "M"
       
    );
    $finalRoman = array();
    $keys = array_keys($values);
    for ($j = 0; $number >= 1; $j ++) {

        for ($i = 0; $i <= sizeof($keys); $i ++) {
            if($i == sizeof($keys)){
                array_push($finalRoman, $values[$keys[$i - 1]]);
                $toSubtract = $keys[$i - 1];
                $number = $number - $toSubtract;
                break;
            }
         if ($keys[$i] > $number) {
                array_push($finalRoman, $values[$keys[$i - 1]]);
                $toSubtract = $keys[$i - 1];
                $number = $number - $toSubtract;
                break;
            }
        }
    }


for ($k = 0; $k < sizeof($finalRoman); $k ++) {
    echo "$finalRoman[$k]";
}

// $number-=$keys[$keyIndex];
// print_r($finalRoman);
echo "</br>";
}

$no = 20;
roman($no);

$no = 14;
roman($no);
$no = 100;
roman($no);
$no = 4996;
roman($no);
?>