<?php
session_start();
include("../config.php");
include("../admin_protect.php");
?>


<?php

session_start();

session_destroy();
header('Location: login.php');


?>