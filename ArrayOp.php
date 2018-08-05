<?php
class ArrayOp extends ArrayData
{
    private $imageNumber = 0;

    public function __construct(array $arr, $key = null)
    {
        parent::__construct($arr, $key);
    }

    public function swap($key1, $key2)
    {
        $this->draw();
        $this->draw([$key1, $key2]);
        parent::swap($key1, $key2);
        $this->draw([$key1, $key2]);
        $this->draw();
    }

    private function draw(array $special = [])
    {
        if (null === $this->keyName) {
            $image = new ArrayVisualization($this->arr, 1024, 576, 'images'.DIRECTORY_SEPARATOR.($this->imageNumber++).'.png');
        } else {
            $image = new ArrayVisualization($this->arr[$this->keyName], 1024, 576, 'images'.DIRECTORY_SEPARATOR.($this->imageNumber++).'.png');
        }
        $image->drawArray();
        foreach ($special as $v) {
            $image->specialColor($v);
        }
        $image->save();
        $image->freeMemory();
    }
}
