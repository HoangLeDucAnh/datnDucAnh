<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    ?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>Items</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <!-- dataTables css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <!-- dataTables responsive -->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.css">
        <!-- my css -->
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <?php include "navbar.php"; ?>

        <script>
            const allNavLink = document.querySelectorAll('.nav-link');
            allNavLink.forEach(navLink => {
                document.querySelector('.nav-link.active')?.classList.remove('active');
            })
            allNavLink[2].classList.add('active');
        </script>




        <!-- render by DataTables -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
            </script>
        <div class="container pt10">
            <table id="myTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Devices</th>
                        <th>Locations</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($conn->connect_error) {
                        die("connection failed:" . $conn->connect_error);
                    }
                    // select query
                    $sql = "SELECT * FROM devices";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        // mysqli_fetch_assoc() function fetches a result row as an associative array.
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["devices"] . "</td><td>" . $row["locations"] . "</td><td>" . $row["status"] . "</td>
                            <td>
                            <a href='updateDevice.php?updateid=" . $row["id"] . "' class='btn btn-primary'>Update</a>
                            <a href='deleteDevice.php?deleteid=" . $row["id"] . "' class='btn btn-danger'>Delete</a>
                            </td></tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "0 result";
                    }
                    $conn->close();
                    ?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add new device
                    </button>

                    <!-- Modal -->
                    <?php
                    require "db_conn.php";
                    // if btn submit is clicked, make query to insert data to database
                    if (isset($_POST["submit"])) {
                        $devices = $_POST["devices"];
                        $locations = $_POST["locations"];
                        $status = $_POST["status"];



                        // insert query
                        $query = "INSERT INTO devices(devices, locations, status) VALUES ('$devices', '$locations', '$status')";
                        mysqli_query($conn, $query);
                        echo "<meta http-equiv='refresh' content='0'>";
                    }


                    ?>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">New device</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="post" autocomplete="off" class="py-2">
                                    <div class="modal-body">
                                        <div class="form-group py-2">
                                            <label for="devices">Device: </label>
                                            <input type="text" name="devices" id="devices" class="form-control"
                                                placeholder="Device" required>
                                        </div>
                                        <div class="form-group py-2">
                                            <label for="locations">Location: </label>
                                            <input type="text" name="locations" id="locations" class="form-control"
                                                placeholder="Location" required>
                                        </div>
                                        <div class="form-group py-2">
                                            <label for="status">Status: </label>
                                            <input type="text" class="form-control" name="status" id="status"
                                                placeholder="Status" required>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary" id="save">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>


                    <!-- jquery cdn -->
                    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                    <!-- dataTables cdn -->
                    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
                    <!-- Bootstrap JavaScript Libraries -->
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
                        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
                        crossorigin="anonymous">
                        </script>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
                        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
                        crossorigin="anonymous">
                        </script>
                    <!-- dataTables responsive -->
                    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>
                    <!-- dataTables js -->
                    <script>
                        $(document).ready(function () {
                            $('#myTable').DataTable({
                                responsive: true,

                            }
                            );
                        });
                    </script>
                    <script>
                        $('#save').click(function () {
                            $('#exampleModal').modal('hide');
                        });
                    </script>
    </body>

    </html>


    <?php
} else {
    header("Location: index.php");
    exit();
}
?>