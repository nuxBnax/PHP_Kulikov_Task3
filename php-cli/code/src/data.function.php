<?php
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