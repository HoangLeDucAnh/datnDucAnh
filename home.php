<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    ?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>My SmartHome</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="icon" href="data:,">

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <!-- dataTables css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <!-- my css -->
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/dashBoard.css">
    </head>

    <body>
        <?php include "navbar.php"; ?>
        <div class="pt10">
            <br>

            <div class="content">
                <div class="cards">

                    <!-- == Entrance ======================================================================================== -->
                    <div class="card1">
                        <div class="card1 header">
                            <h3 style="font-size: 1rem;">ENTRANCE (NODE 1)</h3>
                        </div>
                        <div class="card-body1">
                            <a class="btn btn-primary" href="../rfidattendance/login.php" target="_blank">Entrance
                                Supervisor</a>
                            <p id="date"></p>
                            <p id="time"></p>


                        </div>
                    </div>
                    <!-- ======================================================================================================= -->



                    <!-- == CONTROLLING ======================================================================================== -->
                    <div class="card1">
                        <div class="card1 header">
                            <h3 style="font-size: 1rem;">KITCHEN (NODE 3)</h3>
                        </div>

                        <div class="card-body1">
                            <h4 class="LEDColor"><i class="fa fa-bolt"></i> Relay 1</h4>
                            <label class="switch1">
                                <input type="checkbox" id="ESP32_02_TogRELAY_01"
                                    onclick="GetTogBtnRELAYState('ESP32_02_TogRELAY_01')">

                                <div class="sliderTS"></div>
                            </label>
                            <h4 class="LEDColor"><i class="fa fa-bolt"></i> Relay 2</h4>
                            <label class="switch1">
                                <input type="checkbox" id="ESP32_02_TogRELAY_02"
                                    onclick="GetTogBtnRELAYState('ESP32_02_TogRELAY_02')">
                                <div class="sliderTS"></div>
                            </label>
                        </div>


                    </div>
                    <!-- ======================================================================================================= -->

                    <!-- == MONITORING ======================================================================================== -->
                    <div class="card1">
                        <div class="card1 header">
                            <h3 style="font-size: 1rem;">MONITORING (NODE 2)</h3>
                        </div>

                        <!-- Displays the humidity and temperature values received from ESP32. *** -->
                        <div class="card-body1">
                            <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE</h4>
                            <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp"></span> &deg;C</span>
                            </p>
                            <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMIDITY</h4>
                            <p class="humidityColor"><span class="reading"><span id="ESP32_01_Humd"></span> &percnt;</span>
                            </p>
                            <!-- *********************************************************************** -->

                            <p class="statusreadColor"><span>Status Read Sensor DHT11 : </span><span
                                    id="ESP32_01_Status_Read_DHT11"></span></p>
                        </div>


                    </div>
                    <!-- ======================================================================================================= -->

                    <!-- == CONTROLLING ======================================================================================== -->
                    <div class="card1">
                        <div class="card1 header">
                            <h3 style="font-size: 1rem;">LIVING ROOM (NODE 2)</h3>
                        </div>

                        <!-- Buttons for controlling the LEDs on Slave 2. ************************** -->
                        <div class="card-body1">
                            <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> Manual mode</h4>
                            <label class="switch1">
                                <input type="checkbox" id="ESP32_01_TogManual"
                                    onclick="GetTogBtnModeState('ESP32_01_TogManual')">
                                <div class="sliderTS"></div>
                            </label>
                            <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> Auto mode</h4>


                            <label class="switch1">
                                <input type="checkbox" id="ESP32_01_TogAuto"
                                    onclick="GetTogBtnModeState('ESP32_01_TogAuto')">
                                <div class="sliderTS"></div>
                            </label>
                            <br>
                            <label for="">
                                Set temperature:
                                <input type="text" style="width: 50px" id='setPoint'>
                            </label>


                        </div>

                        <!-- *********************************************************************** -->
                    </div>
                    <!-- ======================================================================================================= -->

                </div>
            </div>

            <br>

            <div class="content">
                <div class="cards">
                    <div class="card1 header" style="border-radius: 15px;">
                        <h3 style="font-size: 0.7rem;">LAST TIME RECEIVED DATA FROM ESP32 [ <span id="ESP32_01_LTRD"></span>
                            ]
                        </h3>
                        <div class="row my-3">
                            <div class="col-md-6"><button onclick="window.open('dht11_fan/recordtable.php', '_blank');"
                                    class="btn1 ">Open Record
                                    Data Of Living Room</button></div>
                            <div class="col-md-6"><button onclick="window.open('relay/recordtable.php', '_blank');"
                                    class="btn1 ">Open Record
                                    Data Of Kitchen</button></div>
                        </div>

                    </div>
                </div>
            </div>

            <br>

            <!-- ___________________________________________________________________________________________________________________________________ -->

            <script>
                //------------------------------------------------------------
                document.getElementById("ESP32_01_Temp").innerHTML = "NN";
                document.getElementById("ESP32_01_Humd").innerHTML = "NN";
                document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = "NN";
                document.getElementById("ESP32_01_LTRD").innerHTML = "NN";
                //------------------------------------------------------------

                //execute function "Get_Data" every 5 seconds get data from database with id: esp32_01
                Get_Data("esp32_01");
                Get_Data1("esp32_02");

                setInterval(myTimer, 5000);

                //------------------------------------------------------------
                function myTimer() {
                    Get_Data("esp32_01");
                    Get_Data1("esp32_02");

                }
                //------------------------------------------------------------

                //------------------------------------------------------------
                function Get_Data(id) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    //getdata.php sent respone to this page (this is myJSON)
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            //convert myJSON to object
                            const myObj = JSON.parse(this.responseText);
                            if (myObj.id == "esp32_01") {
                                document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
                                document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
                                document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
                                // document.getElementById("setPoint").value = myObj.setPoint;
                                document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";

                                if (myObj.Manual == "ON") {
                                    document.getElementById("ESP32_01_TogManual").checked = true;
                                } else if (myObj.Manual == "OFF") {
                                    document.getElementById("ESP32_01_TogManual").checked = false;
                                }
                                if (myObj.Auto == "ON") {
                                    document.getElementById("ESP32_01_TogAuto").checked = true;
                                } else if (myObj.Auto == "OFF") {
                                    document.getElementById("ESP32_01_TogAuto").checked = false;
                                }
                            }
                        }
                    };
                    // prepares and sends a POST request to the server at the "getdata.php" URL with the data "id" in the request body.
                    // (send id="esp32_01" to getdata.php)
                    xmlhttp.open("POST", "dht11_fan/getdata.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id=" + id);
                }
                //------------------------------------------------------------

                //------------------------------------------------------------
                function GetTogBtnModeState(togbtnid) {
                    if (togbtnid == "ESP32_01_TogManual") {
                        var togbtnchecked = document.getElementById(togbtnid).checked;
                        var togbtncheckedsend = "";
                        if (togbtnchecked == true) togbtncheckedsend = "ON";
                        if (togbtnchecked == false) togbtncheckedsend = "OFF";
                        Update_LEDs("esp32_01", "Manual", togbtncheckedsend);
                    }
                    if (togbtnid == "ESP32_01_TogAuto") {
                        var togbtnchecked = document.getElementById(togbtnid).checked;
                        var togbtncheckedsend = "";
                        if (togbtnchecked == true) togbtncheckedsend = "ON"
                        if (togbtnchecked == false) togbtncheckedsend = "OFF";
                        updateLed_SetPoint("esp32_01", "Auto", togbtncheckedsend, document.getElementById("setPoint").value);

                    }
                }
                //------------------------------------------------------------
                function updateLed_SetPoint(id, mode, modestate, setpoint) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            //document.getElementById("demo").innerHTML = this.responseText;
                        }
                    }
                    xmlhttp.open("POST", "dht11_fan/updateLEDs.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id=" + id + "&mode=" + mode + "&modestate=" + modestate + "&setpoint=" + setpoint);
                }
                //------------------------------------------------------------
                function Update_LEDs(id, mode, modestate) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            //document.getElementById("demo").innerHTML = this.responseText;
                        }
                    }
                    xmlhttp.open("POST", "dht11_fan/updateLEDs.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id=" + id + "&mode=" + mode + "&modestate=" + modestate);
                }
                //------------------------------------------------------------
                function Get_Data1(id) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    //getDataRelay.php sent respone to this page (this is myJSON)
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            //convert myJSON to object
                            const myObj = JSON.parse(this.responseText);
                            if (myObj.id == "esp32_02") {

                                if (myObj.RELAY_01 == "ON") {
                                    document.getElementById("ESP32_02_TogRELAY_01").checked = true;
                                } else if (myObj.RELAY_01 == "OFF") {
                                    document.getElementById("ESP32_02_TogRELAY_01").checked = false;
                                }
                                if (myObj.RELAY_02 == "ON") {
                                    document.getElementById("ESP32_02_TogRELAY_02").checked = true;
                                } else if (myObj.LED_02 == "OFF") {
                                    document.getElementById("ESP32_02_TogRELAY_02").checked = false;
                                }
                            }
                        }
                    };
                    // prepares and sends a POST request to the server at the "getDataRelay.php" URL with the data "id" in the request body.
                    // (send id="esp32_02" to getDataRelay.php)
                    xmlhttp.open("POST", "relay/getDataRelay.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id=" + id);
                }

                //------------------------------------------------------------
                function GetTogBtnRELAYState(togbtnid) {
                    if (togbtnid == "ESP32_02_TogRELAY_01") {
                        var togbtnchecked = document.getElementById(togbtnid).checked;
                        var togbtncheckedsend = "";
                        if (togbtnchecked == true) togbtncheckedsend = "ON";
                        if (togbtnchecked == false) togbtncheckedsend = "OFF";
                        Update_RELAYs("esp32_02", "RELAY_01", togbtncheckedsend);
                    }
                    if (togbtnid == "ESP32_02_TogRELAY_02") {
                        var togbtnchecked = document.getElementById(togbtnid).checked;
                        var togbtncheckedsend = "";
                        if (togbtnchecked == true) togbtncheckedsend = "ON";
                        if (togbtnchecked == false) togbtncheckedsend = "OFF";
                        Update_RELAYs("esp32_02", "RELAY_02", togbtncheckedsend);
                    }
                }
                //------------------------------------------------------------

                //------------------------------------------------------------
                function Update_RELAYs(id, relaynum, relaystate) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            //document.getElementById("demo").innerHTML = this.responseText;
                        }
                    }
                    xmlhttp.open("POST", "relay/updateRELAYs.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id=" + id + "&relaynum=" + relaynum + "&relaystate=" + relaystate);
                }
                //------------------------------------------------------------

                setInterval(updateTime, 1000)

                function updateTime() {
                    let date = new Date()
                    let year = date.getFullYear()
                    let month = date.getMonth() + 1
                    let day = date.getDate()
                    let hours = date.getHours()
                    let minutes = date.getMinutes()
                    let seconds = date.getSeconds()
                    document.getElementById("date").innerHTML = `${day} - ${month} - ${year}`
                    document.getElementById("time").innerHTML = `${hours}:${minutes}:${seconds}`
                }

            </script>
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
    header("Location: index.php");
    exit();
}
?>