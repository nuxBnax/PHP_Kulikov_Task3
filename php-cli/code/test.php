<?php

//echo date('d-m') . PHP_EOL;
$str = 'Иван Иванов, 05-06-2004';
$strBlocks = explode(", ", $str);
//echo $strBlocks[0] . PHP_EOL . $strBlocks[1] . PHP_EOL;
$dateBlock = explode('-', $strBlocks[1]);
//echo $dateBlock[0] . PHP_EOL . $dateBlock[1] . PHP_EOL . $dateBlock[2] . PHP_EOL;
$dayMonthString = $dateBlock[0] . '-' . $dateBlock[1];
//echo $dayMonthString;
echo date('d-m') . PHP_EOL;
