<?php
require 'database.php';

//---------------------------------------- Condition to check that POST value is not empty.
if (!empty($_POST)) {
  //........................................ keep track POST values
  $id = $_POST['id'];

  $relay_01 = $_POST['relay_01'];
  $relay_02 = $_POST['relay_02'];
  //........................................

  //........................................ Get the time and date.
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $tm = date("H:i:s");
  $dt = date("Y-m-d");
  //........................................

  //........................................ Updating the data in the table.
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // This table is used to store DHT11 sensor data updated by ESP32. 
  // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
  // This table is operated with the "UPDATE" command, so this table will only contain one row.
  $sql = "UPDATE kitchen_relays_update SET time = ?, date = ? WHERE id = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($tm, $dt, $id));
  Database::disconnect();
  //........................................ 

  //........................................ Entering data into a table.
  $id_key;
  $board = $_POST['id'];
  $found_empty = false;

  $pdo = Database::connect();

  //:::::::: Generate random id and Process to check if "id" is already in use.
  while ($found_empty == false) {
    $id_key = generate_string_id(10);
    // This table is used to store and record DHT11 sensor data updated by ESP32. 
    // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // This table is operated with the "INSERT" command, so this table will contain many rows.
    // Before saving and recording data in this table, the "id" will be checked first, to ensure that the "id" that has been created has not been used in the table.
    $sql = 'SELECT * FROM kitchen_relays_record WHERE id="' . $id_key . '"';
    $q = $pdo->prepare($sql);
    $q->execute();

    if (!$data = $q->fetch()) {
      $found_empty = true;
    }
  }
  //::::::::

  //:::::::: The process of entering data into a table.
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // This table is used to store and record DHT11 sensor data updated by ESP32. 
  // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
  // This table is operated with the "INSERT" command, so this table will contain many rows.
  $sql = "INSERT INTO kitchen_relays_record (id,board,RELAY_01,RELAY_02,time,date) values(?, ?, ?, ?, ?, ?)";
  $q = $pdo->prepare($sql);
  $q->execute(array($id_key, $board, $relay_01, $relay_02, $tm, $dt));
  //::::::::

  Database::disconnect();
  //........................................ 
}
//---------------------------------------- 

//---------------------------------------- Function to create "id" based on numbers and characters.
function generate_string_id($strength = 16)
{
  $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $input_length = strlen($permitted_chars);
  $random_string = '';
  for ($i = 0; $i < $strength; $i++) {
    $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
    $random_string .= $random_character;
  }
  return $random_string;
}
//---------------------------------------- 
?>