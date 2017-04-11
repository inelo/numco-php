NUMCO - NUMber COmpressor
=========

A small compression/decompression library for numerical arrays.
Its best suited for large data sets of integers.
## How it works
Internally this lib creates a delta encoded array and then deflates it using zlib.

Delta encoding is one of the most powerfull numeric compression methods out there.
Its a simple algorithm that converts values in given array so that each represents a difference from the previous value.

Delta encoding example:

```
[100, 101, 102, 103, 104, 105] converts to [100, 1, 1, 1, 1, 1]
```

## Charts

(the more sequential data the better compression ratio)

![charts](/numco_charts.png)

## Mini DOC
Compression
```
Numco::compress(array) : string
    expects array of numbers as argument and returns compressed base64 encoded string
```
Decompression
```
Numco::decompress(string) : array
    expects compressed base64 encoded string and returns decompressed array of numbers
```

## Example usage
```
use Inelo\Numco\Numco;

$numArray = [ 100, 101, 102, ... ];

$compressed = Numco::compress($numArray);
$decompressed = Numco::decompress($compressed);

echo "compressed base64 encoded string : " . $compressed . "\n";
echo "decompressed array : " . var_export($decompressed, true) . "\n";
```

## Running tests

vendor/bin/phpunit tests  

## Release History

* 0.1.0 Initial release
