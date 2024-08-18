<?php

function readAllFunction(array $config): string
{
    $address = $config['storage']['address'];
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        $contents = '';
        while (!feof($file)) {
            $contents .= fread($file, 100);
        }
        fclose($file);
        return $contents;
    } else {
        return handleError("Файл не существует");
    }
}

// Поиск по дате рождения
function findBirthDateFunction(array $config): string
{
    $address = $config['storage']['address'];
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        $result = '';
        while (!feof($file)) {
            $contents = fgets($file, 100);
            if (str_contains($contents, date('d-m'))) {
                $result .= $contents;
            }
        }
        if ($result != '') {
            return $result;
        }
        fclose($file);
        return "Искомый человек не найден!";
    } else {
        return handleError("Файл не существует");
    }
}


// удаление искомой строки

function deleteLineFunction(array $config): string
{
    $address = $config['storage']['address'];

    $data = readline("Введите имя искомого человека или дату его рождения в формате ДД-ММ-ГГГГ: ");
    $newData = '';
    $flag = false;
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");
        while (!feof($file)) {
            $contents = fgets($file, 100);
            if (str_contains($contents, $data)) {
                $flag = true;
            } else {
                $newData .= $contents;
            }
        }
        if (!$flag && feof($file)) {
            return 'Искомые данные отсутствуют в списке';
        }
        $fileHandler = fopen($address, 'w');
        if (fwrite($fileHandler, $newData)) {
            return "Искомый человек был удален из списка. Файл обновлен!";
        } else {
            return handleError("Произошла ошибка записи. Данные не сохранены");
        }

    } else {
        return handleError("Файл не существует");
    }
}
function addFunction(array $config): string
{
    $address = $config['storage']['address'];

    $name = readline("Введите имя: ");
    $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");

    if (!validateData($date)) {
        return handleError('Неправильный формат даты');
    }

    $data = $name . ", " . $date . "\r\n";

    $fileHandler = fopen($address, 'a');
    if (fwrite($fileHandler, $data)) {
        return "Запись $data добавлена в файл $address";
    } else {
        return handleError("Произошла ошибка записи. Данные не сохранены");
    }
//	fclose($fileHandler);
}

function clearFunction(array $config): string
{
    $address = $config['storage']['address'];
    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "w");
        fwrite($file, '');
        fclose($file);
        return "Файл очищен";
    } else {
        return handleError("Файл не существует");
    }
}

function help(): string
{
    return handleHelp();
}

function readConfig(string $configAddress): array|false
{
    return parse_ini_file($configAddress, true);
}

function readProfilesDirectory(array $config): string
{
    $profilesDirectoryAddress = $config['profiles']['address'];
    if (!is_dir($profilesDirectoryAddress)) {
        mkdir($profilesDirectoryAddress);
    }
    $files = scandir($profilesDirectoryAddress);

    $result = "";
    if (count($files) > 2) {
        foreach ($files as $file) {
            if (in_array($file, ['.', '..']))
                continue;
            $result .= $file . "\r\n";
        }
    } else {
        $result .= "Директория пуста \r\n";
    }
    return $result;
}


function readProfile(array $config): string
{
    $profilesDirectoryAddress = $config['profiles']['address'];
    if (!isset($_SERVER['argv'][2])) {
        return handleError("Не указан файл профиля");
    }

    $profileFileName = $profilesDirectoryAddress . $_SERVER['argv'][2] . ".json";
    if (!file_exists($profileFileName)) {
        return handleError("Файл $profileFileName не существует");
    }

    $contentJson = file_get_contents($profileFileName);
    $contentArray = json_decode($contentJson, true);

    $info = "Имя: " . $contentArray['name'] . "\r\n";
    $info .= "Фамилия: " . $contentArray['lastname'] . "\r\n";
    return $info;

}