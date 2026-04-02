<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class GlobalHelper
{
    public static function addOptionToArray($arrayName, $newOption)
    {
        $helpersFile = app_path('helpers.php');

        if (!file_exists($helpersFile)) {
            return null;
        }

        $content = file_get_contents($helpersFile);

        $startPosition = strpos($content, "\$optionArr['$arrayName'] = array(");

        if ($startPosition === false) {
            return null;
        }

        $endPosition = strpos($content, ');', $startPosition);

        if ($endPosition === false) {
            return null;
        }

        $arrayContent = substr($content, $startPosition, $endPosition - $startPosition);

        if (strpos($arrayContent, "'$newOption' => '$newOption'") !== false) {
            return false;
        }

        $updatedArrayContent = substr_replace($arrayContent, "    '$newOption' => '$newOption',\n", $endPosition - $startPosition - 1, 0);

        $newContent = substr_replace($content, $updatedArrayContent, $startPosition, $endPosition - $startPosition);

        if (is_writable($helpersFile)) {
            file_put_contents($helpersFile, $newContent);
            return true;
        } else {
            return null;
        }
    }
}
