<?php

$fileContents = file_get_contents('file.txt');
echo $fileContents;
print_r($_SERVER['argv']);