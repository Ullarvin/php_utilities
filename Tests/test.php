<?php
require("../Utilities/DateUtility.inc.class.php");

use php_utilities\Utilities\DateUtility;

$dateUtl = new DateUtility();
echo $dateUtl->format("m-d-Y");