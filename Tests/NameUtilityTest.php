<?php

require("../Utilities/NameUtility.php");

use php_utilities\Utilities\NameUtility;

$prefix = "Mr.";
$first = "John";
$middle = "Jane";
$last = "Doe";
$suffix = "Jr.";


$name = ['first' => $first, 'middle' => $middle, 'last' => $last, 'prefix' => $prefix, 'suffix' => $suffix];
$format1 = "p f m l s";
$format2 = "l, f m";
$format3 = "l f";

$nameUtl = new NameUtility($name);

echo $nameUtl->format($format1);
echo "<br>";
echo $nameUtl->format($format2);
echo "<br>";
echo $nameUtl->format($format3);
echo "<br>";

echo $nameUtl->get_prefix() . "<br>";
echo $nameUtl->get_first() . "<br>";
echo $nameUtl->get_middle() . "<br>";
echo $nameUtl->get_last() . "<br>";
echo $nameUtl->get_suffix() . "<br>";
echo "<pre>";
var_dump($nameUtl->get_name_codes());
echo "</pre>";