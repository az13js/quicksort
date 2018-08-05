<?php
class QuickSort
{
    private $arr = [];

    public function __construct(ArrayData $arr)
    {
        $this->arr = $arr;

        $this->quick_sort($this->arr);
    }

    private function quicksort(&$A, $lo, $hi) {
        if ($lo < $hi) {
            $p = $this->partition($A, $lo, $hi);
            $this->quicksort($A, $lo, $p - 1);
            $this->quicksort($A, $p + 1, $hi);
        }
    }

    private function partition(&$A, $lo, $hi) {
        $pivot = $A->getElement($hi);
        $i = $lo - 1;
        for ($j = $lo; $j <= $hi - 1; $j++) {
            if ($A->getElement($j) < $pivot) {
                $i = $i + 1;
                $A->swap($i, $j);
            }
        }
        $A->swap($i + 1, $hi);
        return $i + 1;
    }

    private function quick_sort(&$arr) {
        $left = 0;
        $right = $arr->getArrayLength() - 1;
        $this->quicksort($arr, $left, $right);
    }
}
