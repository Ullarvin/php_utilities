<?php
require("../Utilities/DateUtility.php");

use php_utilities\Utilities\DateUtility;

$dateUtl = new DateUtility("2024-12-25");
echo $dateUtl->format("m-d-Y");
echo "<br>";
echo $dateUtl->diff("2023-12-07");
echo "<br>";
var_dump($dateUtl->is_holiday());
echo "<br>";
var_dump($dateUtl->get_holiday_name(TRUE));
echo "<br>";
var_dump($dateUtl->is_weekend());
echo "<br>";
var_dump($dateUtl->is_weekday());
echo "<br>";

