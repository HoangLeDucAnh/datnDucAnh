<!-- write 2 queries, first select the data then update -->
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

    include 'db_conn.php';
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM `devices` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $devices = $row['devices'];
    $locations = $row['locations'];
    $status = $row['status'];

    // check whenever the update button is clicked, the query is executed
    if (isset($_POST['save'])) {
        $devices = $_POST['devices'];
        $locations = $_POST['locations'];
        $status = $_POST['status'];



        // update query
        $sql = "UPDATE `devices` SET devices='$devices', locations = '$locations', status='$status' WHERE id='$id'";

        $result = mysqli_query($conn, $sql);
        header("Location: items.php");

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
            <h2>UPDATE DEVICE FORM</h2>
            <!-- set attribute name for each input -->
            <form method="post" autocomplete="off" class="py-2">
                <div class="form-group py-2">
                    <label for="devices" class="my-2">Device: </label>
                    <input type="text" name="devices" id="device" class="form-control" placeholder="Device" required
                        value=<?php echo $devices ?>>
                </div>
                <div class="form-group py-2">
                    <label for="locations" class="my-2">Location: </label>
                    <input type="text" name="locations" id="locations" class="form-control" placeholder="Location" required
                        value=<?php echo $locations ?>>
                </div>
                <div class="form-group py-2">
                    <label for="status" class="my-2">Status: </label>
                    <input type="text" class="form-control" name="status" id="status" placeholder="Status" required
                        value=<?php echo $status ?>>
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
    header("Location: items.php");
    exit();
}
?>