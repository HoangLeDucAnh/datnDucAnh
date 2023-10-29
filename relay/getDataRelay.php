<?php
include 'database.php';

//---------------------------------------- Condition to check that POST value is not empty.
if (!empty($_POST)) {
  // keep track post values
  $id = $_POST['id'];

  $myObj = (object) array();

  //........................................ 
  $pdo = Database::connect();
  // This table is used to store DHT11 sensor data updated by ESP32. 
  // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
  // To store data, this table is operated with the "UPDATE" command, so this table contains only one row.
  $sql = 'SELECT * FROM kitchen_relays_update WHERE id="' . $id . '"';

  //iterate one row and get new data to object
  foreach ($pdo->query($sql) as $row) {
    $date = date_create($row['date']);
    $dateFormat = date_format($date, "d-m-Y");

    $myObj->id = $row['id'];

    $myObj->RELAY_01 = $row['RELAY_01'];
    $myObj->RELAY_02 = $row['RELAY_02'];
    $myObj->ls_time = $row['time'];
    $myObj->ls_date = $dateFormat;

    //convert object to json and send to home.php
    $myJSON = json_encode($myObj);
    echo $myJSON;
  }
  Database::disconnect();
  //........................................ 
}
//---------------------------------------- 
?>