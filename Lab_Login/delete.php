<?php

if (!isset($_GET["id"])) {
    die("id not found");
}
$id = $_GET["id"];
if (!is_numeric($id))
    die("id not a number.");

$sql = <<<multi
  delete from user where id = $id
multi;
require("config.php");
mysqli_query($link, $sql);

header("location: login.php");
