<!-- write 2 queries, first select the data then update -->
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

    include 'db_conn.php';
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM `users` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $role = $row['role'];
    // check whenever the update button is clicked, the query is executed
    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $role = $_POST['role'];

        if ($password == $confirmpassword) {
            // update query
            $sql = "UPDATE `users` SET name='$name', username = '$username', email='$email', password ='$password', role='$role' WHERE id='$id'";

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <!-- my css -->
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <?php include "navbar.php"; ?>

        <div class="container pt10">
            <h2>UPDATE USER FORM</h2>
            <!-- set attribute name for each input -->
            <form method="post" autocomplete="off" class="py-2">
                <div class="form-group py-2">
                    <label for="name" class="my-2">Name: </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required value=<?php echo $name ?>>
                </div>
                <div class="form-group py-2">
                    <label for="username" class="my-2">Username: </label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required
                        value=<?php echo $username ?>>
                </div>
                <div class="form-group py-2">
                    <label for="email" class="my-2">Email: </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required
                        value=<?php echo $email ?>>
                </div>
                <div class="form-group py-2">
                    <label for="password" class="my-2">Password: </label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Password" required
                        value=<?php echo $password ?>>
                </div>
                <div class="form-group py-2">
                    <label for="comfirmpassword" class="my-2">Confirm password:</label>
                    <input type="text" class="form-control" name="confirmpassword" id="confirmpassword"
                        placeholder="Confirm password" required value=<?php echo $password ?>>
                </div>
                <div class="py-2">
                    <label for="role" class="my-2">Role:</label>
                    <select class="form-select" aria-label="Default select example" name="role">
                        <option selected>Choose role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>

                </div>
                <button type="submit" name="save" class="btn btn-outline-primary py-2 my-5 float-right">Save</button>
            </form>
        </div>



        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
            </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
            </script>
    </body>

    </html>
    <?php
} else {
    header("Location: users.php");
    exit();
}
?>