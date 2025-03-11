<?php
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM sepeda WHERE id_sepeda=$id");
header("Location: sepeda_index.php");
exit();
?>
