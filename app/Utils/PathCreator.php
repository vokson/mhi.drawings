<?php

namespace App\Utils;


class PathCreator
{
    public function makePathForUnfProject($project, $drawing) {
        //собираем директорию в хранилище
        $symbol = $drawing[0];
        //Обрезаем букву у номера чертежа C320-02300 -> 320-02300
        $number_without_symbol = substr($drawing, 1);
        //Разбиваем номер на 2 части 320-02300 -> 320; 02300
        $parts = explode('-', $number_without_symbol);
        //обрезаем вторую часть до 2-х символов
        $parts[count($parts) - 1] = substr($parts[count($parts) - 1], 0, 2);
        //формируем путь
        $path = $project . DIRECTORY_SEPARATOR . $symbol . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $parts);
//        echo $path."</br>";
        return $path;
    }
}