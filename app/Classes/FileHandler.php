<?php
namespace App\Classes;

trait FileHandler {
    protected function readFromFile($filename) {
        if (file_exists($filename)) {
            $data = file_get_contents($filename);
            return json_decode($data, true);
        }
        return [];
    }

    protected function writeToFile($filename, $data) {
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
    }
}
?>