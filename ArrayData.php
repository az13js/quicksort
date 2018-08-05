<?php
class ArrayData
{
    protected $arr = [];
    protected $keyName = null;
    private $len = 0;

    public function __construct(array $arr, $key = null)
    {
        $this->arr = $arr;
        $this->keyName = $key;
        if (!is_null($this->keyName)) {
            $this->len = count($this->arr[$this->keyName], COUNT_NORMAL);
        } else {
            $this->len = count($arr, COUNT_NORMAL);
        }
    }

    public function getArrayLength()
    {
        return $this->len;
    }

    public function getElement($key)
    {
        if (!is_null($this->keyName)) {
            if (isset($this->arr[$this->keyName][$key])) {
                return $this->arr[$this->keyName][$key];
            } else {
                throw new \Exception("ArrayData can not find key:".$key.", array length:".$this->len);
            }
        }

        if (isset($this->arr[$key])) {
            return $this->arr[$key];
        } else {
            throw new \Exception("ArrayData can not find key:".$key.", array length:".$this->len);
        }
    }

    public function swap($key1, $key2)
    {
        if (!is_null($this->keyName)) {
            if (isset($this->arr[$this->keyName][$key1]) && isset($this->arr[$this->keyName][$key2])) {
                foreach ($this->arr as $k => $v) {
                    $tmp = $this->arr[$k][$key1];
                    $this->arr[$k][$key1] = $this->arr[$k][$key2];
                    $this->arr[$k][$key2] = $tmp;
                }
            } else {
                throw new \Exception(<<<ERROR_INFO
ArrayData can not find:
$key1, $key2
length {$this->len}
ERROR_INFO
                );
            }
        } else {
            if (isset($this->arr[$key1]) && isset($this->arr[$key2])) {
                $tmp = $this->arr[$key1];
                $this->arr[$key1] = $this->arr[$key2];
                $this->arr[$key2] = $tmp;
            } else {
                throw new \Exception(<<<ERROR_INFO
ArrayData can not find:
$key1, $key2
length {$this->len}
ERROR_INFO
                );
            }
        }
    }
}
