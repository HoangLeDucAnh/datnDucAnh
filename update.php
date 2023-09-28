<!-- write 2 queries, first select the data then update -->
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

    include 'db_conn.php';
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM `tb_user` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $confirmpassword = $row['confirmpassword'];
    // check whenever the update button is clicked, the query is executed
    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        if ($password == $confirmpassword) {
            // update query
            $sql = "UPDATE `tb_user` SET name='$name', username = '$username', email='$email', password ='$password' WHERE id='$id'";

            $result = mysqli_query($conn, $sql);
            header("Location: users.php");
        } else {
            echo "<script> alert('Password does not match')</script>";
        }
    }
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <!-- my css -->
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
            <div class="container-fluid gap-5">
                <a class="navbar-brand" href="home.php"><img src="./img/800px-HCMUT_official_logo.png" alt="logo" style="width: 60px" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse gap-5" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-5">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                        <li class="nav-item">
                            <span class="nav-link text-primary" href="#">Welcome, <?php echo $_SESSION['name']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container pt10">
            <h2>UPDATE FORM</h2>
            <!-- set attribute name for each input -->
            <form method="post" autocomplete="off" class="py-2">
                <div class="form-group py-2">
                    <label for="name" class="my-2">Name: </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required value=<?php echo $name ?>>
                </div>
                <div class="form-group py-2">
                    <label for="username" class="my-2">Username: </label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required value=<?php echo $username ?>>
                </div>
                <div class="form-group py-2">
                    <label for="email" class="my-2">Email: </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required value=<?php echo $email ?>>
                </div>
                <div class="form-group py-2">
                    <label for="password" class="my-2">Password: </label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Password" required value=<?php echo $password ?>>
                </div>
                <div class="form-group py-2">
                    <label for="comfirmpassword" class="my-2">Confirm password:</label>
                    <input type="text" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm password" required value=<?php echo $password ?>>
                </div>
                <button type="submit" name="save" class="btn btn-outline-primary py-2 my-5 float-right">Save</button>
            </form>
        </div>



        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: users.php");
    exit();
}
?>