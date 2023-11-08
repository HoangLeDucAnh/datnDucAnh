<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    include "db_conn.php";
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM `devices` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: items.php");
    } else {
        die(mysqli_error($conn));
    }
    ?>

    <?php
} else {
    header("Location: index.php");
    exit();
}
?>