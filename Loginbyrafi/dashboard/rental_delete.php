<?php
include 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM rental WHERE id_rental=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: rental_index.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
