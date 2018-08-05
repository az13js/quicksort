<?php
class ArrayVisualization
{
    private $arr = [];
    private $len = 0;

    private $filePath = '';
    private $image = null;
    private $width = 0;
    private $height = 0;

    public function __construct(array $arr, $width, $height, $file)
    {
        $this->arr = $arr;
        $this->len = count($arr, COUNT_NORMAL);
        $this->filePath = $file;
        $this->image = imagecreatetruecolor($width, $height);
        $this->width = $width;
        $this->height = $height;

        imagefilledrectangle(
            $this->image,
            0, 0,
            $width, $height,
            imagecolorallocate($this->image, 255, 255, 255)
        );
        imageantialias($this->image, true);
        imagesetthickness($this->image, 1);
    }

    public function drawArray()
    {
        $max = $this->getArrayMax();
        $blockWidth = $this->width / ($this->len + 2);
        for ($x = 0; $x < $this->len; $x++) {
            $tangleHeight = $this->height * $this->arr[$x] / $max;
            imagefilledrectangle(
                $this->image,
                $blockWidth*(1+$x), $this->height - $tangleHeight,
                $blockWidth*(2+$x), $this->height,
                imagecolorallocate($this->image, 0, 162, 232)
            );
            imagerectangle(
                $this->image,
                $blockWidth*(1+$x), $this->height - $tangleHeight,
                $blockWidth*(2+$x), $this->height,
                imagecolorallocate($this->image, 0, 0, 0)
            );
        }
    }

    public function save()
    {
        return imagepng($this->image, $this->filePath);
    }

    public function freeMemory()
    {
        imagedestroy($this->image);
    }

    public function specialColor($key)
    {
        if (!isset($this->arr[$key])) {
            throw new \Exception("ArrayVisualization can not find key:".$key.", array length:".$this->len);
        }
        $max = $this->getArrayMax();
        $blockWidth = $this->width / ($this->len + 2);
        $x = $key;

        $tangleHeight = $this->height * $this->arr[$x] / $max;
        imagefilledrectangle(
            $this->image,
            $blockWidth*(1+$x), $this->height - $tangleHeight,
            $blockWidth*(2+$x), $this->height,
            imagecolorallocate($this->image, 255, 0, 128)
        );
        imagerectangle(
            $this->image,
            $blockWidth*(1+$x), $this->height - $tangleHeight,
            $blockWidth*(2+$x), $this->height,
            imagecolorallocate($this->image, 0, 0, 0)
        );
    }

    private function getArrayMax()
    {
        $max = $this->arr[0];
        for ($i = 0; $i < $this->len; $i++) {
            if ($this->arr[$i] > $max) {
                $max = $this->arr[$i];
            }
        }
        return $max;
    }

    private function getArrayMin()
    {
        $min = $this->arr[0];
        for ($i = 0; $i < $this->len; $i++) {
            if ($this->arr[$i] < $min) {
                $min = $this->arr[$i];
            }
        }
        return $min;
    }
}

/*
    $a = [];
    for ($i = 0; $i < 100; $i++) {
        $a[] = rand();
    }
    $r = new ArrayVisualization($a, 1920, 1080, 'test.png');
    $r->drawArray();
    $r->specialColor(50);
    $r->save();
    $r->freeMemory();
*/
