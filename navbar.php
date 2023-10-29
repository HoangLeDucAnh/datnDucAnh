<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php"><img src="./img/800px-HCMUT_official_logo.png" alt="logo"
                style="width: 60px" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse gap-5" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-5">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a id="user" class="nav-link" href="<?php if (isset($_SESSION['role'])) {
                        if ($_SESSION['role'] == 'admin') {
                            echo "users.php";
                        }
                    } ?>">Users</a>
                    <?php if (isset($_SESSION['role']))
                        if ($_SESSION['role'] == 'user')
                            echo "<script>document.getElementById('user').addEventListener('click', function(event) {
                                    event.preventDefault();
                                    alert('Must be admin to access Users Page');
                                    })</script>"
                                ?>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                        <li class="nav-item">
                            <span class="nav-link text-primary" href="#">Welcome,
                        <?php echo $_SESSION['name']; ?>
                    </span>
                </li>
                <li>
                    <a class="logOut btn btn-outline-primary" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>