<?php
session_start();
// connect db in this file
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data); //remove white space at the lead and trail
        $data = stripslashes($data); // remove / (slashes)
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM tb_user WHERE username='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect User name or Password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect User name or Password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
