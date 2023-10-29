<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />

    <!-- my css -->
    <link rel="stylesheet" href="./css/index.css">
  </head>

  <body>
    <header>
      <?php include "navbar.php"; ?>
      <script>
        const allNavLink = document.querySelectorAll('.nav-link');
        allNavLink.forEach(navLink => {
          document.querySelector('.nav-link.active')?.classList.remove('active');
        })
        allNavLink[3].classList.add('active');
      </script>
    </header>
    <main>
      <div class="container my-5 text-center pt10">
        <h1 class="text-primary">This project is developed by me</h1>
        <h3>My student information is shown below</h3>
        <p class="display-5">
          Student name: Hoàng Lê Đức Anh<br />
          Student ID: 1910748<br />
          Email: anh.hoangjunne@hcmut.edu.vn<br />
          Class: DD19TD01<br />
          Semester: 231<br />
        </p>
      </div>
    </main>
    <footer>
      <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
      crossorigin="anonymous"></script>
  </body>

  </html>
  <?php
} else {
  header("Location: index.php");
  exit();
}
?>