<?php

$address = '/code/birthdays.txt';

$name = readline("Введите имя: ");
$date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");

if (validate($date)) {
	$data = $name . ", " . $date . PHP_EOL;
	$fileHandler = fopen($address, 'a');

	if (fwrite($fileHandler, $data)) {
		echo "Запись $data добавлена в файл $address";
	} else {
		echo "Произошла ошибка записи. Данные не сохранены";
	}

	fclose($fileHandler);
}
else {
	echo "Введена некорректная информация";
}

function validateData(string $date): bool
{
	$dateBlocks = explode("-", $date);

	if (count($dateBlocks) < 3) {
		return false;
	}

	if (isset($dataBlocks[0]) && $dateBlocks[0] > 31) {
		return false;
	}
	if (isset($dataBlocks[1]) && $dateBlocks[0] > 12) {
		return false;
	}
	if (isset($dataBlocks[2]) && $dateBlocks[2] > date('Y')) {
		return false;
	}
	return true;
}