<?php
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM customers WHERE id_customer=$id");
header("Location: index.php");
exit();
?>
