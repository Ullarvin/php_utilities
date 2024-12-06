<?php
require("../Utilities/DateUtility.inc.class.php");

use php_utilities\Utilities\DateUtility;

$dateUtl = new DateUtility(NULL);
echo $dateUtl->format("m-d-Y");
echo "<br>";
echo $dateUtl->diff("2023-12-07");

