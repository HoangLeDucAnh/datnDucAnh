<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
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
        <!-- dataTables css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a id="user" class="nav-link" href="<?php if (isset($_SESSION['role'])) {
                                                                    if ($_SESSION['role'] == 'admin') {
                                                                        echo "users.php";
                                                                    }
                                                                }  ?>">Users</a>
                            <?php if (isset($_SESSION['role']))
                                if ($_SESSION['role'] == 'user')
                                    echo "<script>document.getElementById('user').addEventListener('click', function(event) {
                event.preventDefault();
                alert('Must be admin to access User page');
              })</script>"


                            ?>

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
                        <li>
                            <a class="logOut btn btn-outline-primary" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


    </body>

    </html>


<?php
} else {
    header("Location: index.php");
    exit();
}
?>