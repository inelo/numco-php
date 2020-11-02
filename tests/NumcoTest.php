<?php
declare(strict_types=1);
use Inelo\Numco\Numco;
use \PHPUnit\Framework\TestCase;

final class NumcoTest extends TestCase {
    private static $testData = [
          1823,1824,1825,16628,16629,16630,16631,16632,16633,16634,16635,16636,
          16637,16638,16639,16640,16641,16642,16643,16644,16645,16646,16647,16648,
          16649,16650,16656,16657,16658,16659,16660,16661,16662,16663,16664,16665,
          16666,16667,16668,16669,16670,16671,16672,16673,16674,16675,16676,16677,
          16678,16679,16680,16681,16682,16683,16684,16685,16686,16687,16688,16689,
          16690,16691,16692,16693,16694,16695,16696,16697,16698,16699,16700,16701,
          16702,16703,16704,16705,16706,16707,16708,16709,16710,16711,16712,16713,
          16714,16715,16716,16717,16718,16719,16720,16721,16722,16723,16724,16725,
          16726,16727,16728,16729,16730,16731,16732,17245,17358,17359,17360,17361,
          17366,17367,17368,17369,17370,17371,17721,17722,17864,17865,17866,17867,
          17868,17869,17870,17871,18183,18184,18185,18186,18187,18188,18189,18190,
          18217,18218,18219,18220,18221,18222,18223,18224,18225,18226,18227,18228,
          18229,18230,18231,18232,18233,18234,18235,18236,18237,18238,18239,18240,
          18241,18242,18243,18244,18245,18246,18247,18248,18249,18250,18251,18252,
          18253,18254,18255,18256,18257,18258,18259,18260,18261,18262,18263,18264,
          18265,18266,18267,18268,18269,20157,20158,20159,20160,20161,20162,20163,
          20164,20165,20166,20167,20565,20566,20567,20568,20569,20570,22500
    ];
    private static $compressedTestData = "eJwztDAy1jEEQRMLAyiLSGhGkmp6QlNDoE8MYb4x"
        ."RZIxNjUA+9UITYexIbqIkTn9HGxhYYFVwtgSRdzS2AAAjgZO9g==";

    private static $compressedEmptyData = "eJwDAAAAAAE=";

    public function testCompression()
    {
        $compressed = Numco::compress(static::$testData);
        $this->assertEquals(strlen($compressed), 92);
        $this->assertEquals($compressed, static::$compressedTestData);
    }

    public function testDecompression()
    {
        $decompressed = Numco::decompress(static::$compressedTestData);
        $this->assertEquals(count($decompressed), count(self::$testData));
        $this->assertEquals(array_diff($decompressed, self::$testData), []);
        $this->assertEquals(array_diff(self::$testData, $decompressed), []);
    }

    public function testCompressionAndDecompressionOfRandomArray()
    {
        $randomArray = [];
        for ($i=0, $max=1000; $i<$max; $i++) {
            $randomArray[] =  rand(0, $max);
        }

        $compressed = Numco::compress($randomArray);
        $decompressed = Numco::decompress($compressed);
        $this->assertEquals(array_diff($decompressed, $randomArray), []);
        $this->assertEquals(array_diff($randomArray, $decompressed), []);

        echo "\n\trandom array raw size :\t\t". mb_strlen(implode(",", $randomArray))." B\n";
        echo "\tcompressed random array size :\t ". mb_strlen($compressed)." B\n";
        echo "\tcompression ratio :\t\t". number_format(mb_strlen($compressed)/mb_strlen(implode(",", $randomArray))*100, 2) ." %\n";
    }

    public function testCompressionOfEmptyArray()
    {
        $compressed = Numco::compress([]);
        $this->assertEquals($compressed, static::$compressedEmptyData);
    }

    public function testDecompressionOfEmptyArray()
    {
        $decompressed = Numco::decompress(static::$compressedEmptyData);
        $this->assertEquals($decompressed, []);
    }
}
