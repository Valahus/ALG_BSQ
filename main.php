<?php
$params = $argv;
array_shift($params);
//map params
$x = $params[1];
$y = $params[2];
$density = $params[3];
//perl array map
$perl_map = array();
exec("perl map.PL $x $y $density", $perl_map);
function main($perl_map)
{
    $tmp = array();
    $row = 1;
    $val = 0;
    $tab = array();
    while (isset($perl_map[$row])) {
        $column = 0;
        while (isset($perl_map[$row][$column])) {
            if ($perl_map[$row][$column] === 'o') {
                $tmp[$column] = 0;
            } else if ($perl_map[$row][$column] === '.') {
                if ($column === 0) {
                    $tmp[$row][$column] = 1;
                } else {
                    $val = $tmp[$row][$column - 1];
                }
                // $tab[$row][$column] = $val + 1;
            }
            $column++;
            $tmp[$row] = $tab;
        }
        $row++;
    }
    print_r($tmp);
    print_r($perl_map);
    return $tmp;
}

if (verifyData($x, $y, $density) === 0) {
    main($perl_map);
}
function bar($y)
{
    for ($i = 0; $i < 4 * $y; $i++) {
        print ('_');
    }
}

function verifyData($x, $y, $density)
{
    if (!isset($x) || !isset($y) || !isset($density) || !is_numeric($x) || !is_numeric($y) || !is_numeric($density)) {
        print('Please insert only integers!');
        exit();
    }
    return 0;
}
