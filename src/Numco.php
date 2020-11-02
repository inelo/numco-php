<?php
declare(strict_types=1);
namespace Inelo\Numco;
use Inelo\Numco\ArrayDelta;

class Numco {
    public static function compress (array $array): string {
        $arrayDelta = ArrayDelta::getDelta($array);
        $deflated = gzcompress(implode(',', $arrayDelta));
        return base64_encode($deflated);
    }

    public static function decompress (string $data): array {
        $inflatedData =  gzuncompress(base64_decode($data));
        $arrayDelta = [];
        if (strlen($inflatedData) > 0) {
            $arrayDelta = explode(',', $inflatedData);
        }
        return ArrayDelta::getValues($arrayDelta);
    }
}
