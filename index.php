<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <form action="login.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <div class="userName">
            <label for="">User Name</label>
            <input type="text" name="uname" placeholder="User Name">
        </div>



        <div class="pass">
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password" id="inputPass">

            <span class="eye" onclick=showAndHide()>
                <i class="fa fa-eye" id="show"></i>
                <i class="fa fa-eye-slash" id="hide"></i>
            </span>
        </div>

        <button type="submit">LOGIN</button>

        <div class="option">
            <a href="registration.php">Sign up</a>
            <a href="#">Forgot password</a>
        </div>

    </form>
    <script>
        function showAndHide() {
            let inputPass = document.querySelector("#inputPass")
            let eye = document.querySelector("#show")
            let eyeSlash = document.querySelector("#hide")
            if (inputPass.type === "password") {
                inputPass.type = "text"
                eye.style.display = "block"
                eyeSlash.style.display = "none"
            } else {
                inputPass.type = "password"
                eye.style.display = "none"
                eyeSlash.style.display = "block"
            }
        }
    </script>
</body>

</html>