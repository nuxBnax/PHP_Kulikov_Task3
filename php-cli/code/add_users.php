<?php


// $address = '/code/birthdays.txt';
// $data = "Василий Васильев, 05-06-1992";
// $fileHandler = fopen($address, 'a');
// fwrite($fileHandler, $data);
// fclose($fileHandler);

$address = 'file.txt';
$name = readline("Введите имя: ");
$data = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
$data = $name . ", " . $data . "\r\n";
$fileHandler = fopen($address, 'a');
if(fwrite($fileHandler, $data)){
		echo "Запись $data добавлена в файл $address";
} else {
		echo "Произошла ошибка записи. Данные не сохранены";
}
fclose($fileHandler);