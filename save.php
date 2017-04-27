<?php 
include "config.php";
$id = $_POST["id"]; 
$text = $_POST["text"]; 
$check = $_POST["check"]; 
if($text) {
$success_update = mysql_query("UPDATE todolist SET description='$text' WHERE id='$id' ");
}
if($check) {
$success_update = mysql_query("UPDATE todolist SET check_value='$check' WHERE id='$id' ");
echo $check;
} 
?>

