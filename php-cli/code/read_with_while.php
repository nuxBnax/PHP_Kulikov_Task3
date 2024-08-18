<?php

$file = fopen("file.txt", "rb");
if ($file === false) {
	echo("Файл невозможно открыть или он не существует");
} else {
	$contents = '';
	while (!feof($file)) { // функция которая проверяет что мы ждошли до конца файла
		$contents .= fread($file, 100);
	} fclose($file);
		echo $contents;
}


//- улучшеный код
$address = "/code/example1.txt";
if (file_exists($address) && is_readable($address)) { // если файл существует и доступен для чтения
		$file = fopen($address, "rb");
		$contents = '';
		while (!feof($file)) {
			$contents .= fread($file, 100);
		}
		fclose($file);
		echo $contents;
} else {
echo("Файл не существует или недоступен для чтения");
}