<?php
require 'database.php';

//---------------------------------------- Condition to check that POST value is not empty.
if (!empty($_POST)) {
  //........................................ keep track post values
  $id = $_POST['id'];
  $relaynum = $_POST['relaynum'];
  $relaystate = $_POST['relaystate'];
  //........................................ 

  //........................................ 
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // This table is used to store DHT11 sensor data updated by ESP32. 
  // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
  // To store data, this table is operated with the "UPDATE" command, so this table contains only one row.
  $sql = "UPDATE kitchen_relays_update SET " . $relaynum . " = ? WHERE id = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($relaystate, $id));
  Database::disconnect();
  //........................................ 
}
//---------------------------------------- 
?>