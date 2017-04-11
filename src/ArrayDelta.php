<?php
declare(strict_types=1);
namespace Inelo\Numco;

class ArrayDelta
{
    public static function getDelta(array $array): array
    {
        sort($array);
        $delta = [];
        for ($i=0, $prev = 0, $count = count($array); $i<$count; $i++) {
            $delta[] = $array[$i] - $prev;
            $prev = $array[$i];
        }
        return $delta;
    }

    public static function getValues(array $delta): array
    {
        $values = [];
        for ($i=0, $head=0, $count=count($delta); $i<$count; $i++) {
            $head = $head + $delta[$i];
            $values[]=$head;
        }
        return $values;
    }
}
