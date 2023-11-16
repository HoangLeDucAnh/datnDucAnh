<?php
require 'database.php';

//---------------------------------------- Condition to check that POST value is not empty.
if (!empty($_POST)) {
  //........................................ keep track post values
  $id = $_POST['id'];
  $mode = $_POST['mode'];
  $modestate = $_POST['modestate'];
  $setpoint = $_POST['setpoint'];
  //........................................ 

  //........................................ 
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // This table is used to store DHT11 sensor data updated by ESP32. 
  // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
  // To store data, this table is operated with the "UPDATE" command, so this table contains only one row.
  $sql = "UPDATE livingroom_dht11_fan_update SET " . $mode . " = ?, setpoint = ?  WHERE id = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($modestate, $setpoint, $id));


  Database::disconnect();
  //........................................ 
}
//---------------------------------------- 
?>