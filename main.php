<?php
spl_autoload_register(function($class) {
    $ds = DIRECTORY_SEPARATOR;
    $file = __DIR__ . $ds . str_replace('\\', $ds, $class) . '.php';
    require $file;
});

$arrays = [];
for ($i = 0; $i < 50; $i++) {
    $arrays['number'][$i] = rand();
}

$arrays['string'] = [];
foreach ($arrays['number'] as $v) {
    $arrays['string'][] = 'this is '.$v;
}

$arr = new ArrayOp($arrays, 'number');

$qsort = new QuickSort($arr);

//var_dump($arr);
echo 'OK.' . PHP_EOL;
