#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h>

// Defines the Digital Pin of the "On Board LED".
#define ON_Board_LED 2 

// Defines GPIO 13 as RELAY_1.
#define RELAY_01 25

// Defines GPIO 12 as RELAY_2.
#define RELAY_02 26 


const char* ssid = "DUC ANH";
const char* password = "123456789";

//======================================== Variables for HTTP POST request data.
String postData = ""; //--> Variables sent for HTTP POST request data.
String payload = "";  //--> Variable for receiving response from HTTP POST.

void control_RELAYs() {
  Serial.println();
  Serial.println("---------------control_RELAYs()");
  JSONVar myObject = JSON.parse(payload);

  // JSON.typeof(jsonVar) can be used to get the type of the var
  if (JSON.typeof(myObject) == "undefined") {
    Serial.println("Parsing input failed!");
    Serial.println("---------------");
    return;
  }

  if (myObject.hasOwnProperty("RELAY_01")) {
    Serial.print("myObject[\"RELAY_01\"] = ");
    Serial.println(myObject["RELAY_01"]);
  }

  if (myObject.hasOwnProperty("RELAY_02")) {
    Serial.print("myObject[\"RELAY_02\"] = ");
    Serial.println(myObject["RELAY_02"]);
  }

  if(strcmp(myObject["RELAY_01"], "ON") == 0)   {digitalWrite(RELAY_01, HIGH);  Serial.println("RELAY 01 ON"); }
  if(strcmp(myObject["RELAY_01"], "OFF") == 0)  {digitalWrite(RELAY_01, LOW);   Serial.println("RELAY 01 OFF");}
  if(strcmp(myObject["RELAY_02"], "ON") == 0)   {digitalWrite(RELAY_02, HIGH);  Serial.println("RELAY 02 ON"); }
  if(strcmp(myObject["RELAY_02"], "OFF") == 0)  {digitalWrite(RELAY_02, LOW);   Serial.println("RELAY 02 OFF");}

  Serial.println("---------------");
}

void setup() {
  // put your setup code here, to run once:
  
  Serial.begin(115200); //--> Initialize serial communications with the PC.

  pinMode(ON_Board_LED,OUTPUT); //--> On Board LED port Direction output.
  pinMode(RELAY_01,OUTPUT); //--> LED_01 port Direction output.
  pinMode(RELAY_02,OUTPUT); //--> LED_02 port Direction output.
  
  digitalWrite(ON_Board_LED, HIGH); //--> Turn on Led On Board.
  

  delay(2000);

  digitalWrite(ON_Board_LED, LOW); //--> Turn off Led On Board.
  

  //---------------------------------------- Make WiFi on ESP32 in "STA/Station" mode and start connecting to WiFi Router/Hotspot.
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  //---------------------------------------- 
  
  Serial.println();
  Serial.println("-------------");
  Serial.print("Connecting");

  //---------------------------------------- The process of connecting the WiFi on the ESP32 to the WiFi Router/Hotspot.
  // The process timeout of connecting ESP32 with WiFi Hotspot / WiFi Router is 20 seconds.
  // If within 20 seconds the ESP32 has not been successfully connected to WiFi, the ESP32 will restart.
  // I made this condition because on my ESP32, there are times when it seems like it can't connect to WiFi, so it needs to be restarted to be able to connect to WiFi.

  int connecting_process_timed_out = 20; //--> 20 = 20 seconds.
  connecting_process_timed_out = connecting_process_timed_out * 2;
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    //........................................ Make the On Board Flashing LED on the process of connecting to the wifi router.
    digitalWrite(ON_Board_LED, HIGH);
    delay(250);
    digitalWrite(ON_Board_LED, LOW);
    delay(250);
    //........................................ 

    //........................................ Countdown "connecting_process_timed_out".
    if(connecting_process_timed_out > 0) connecting_process_timed_out--;
    if(connecting_process_timed_out == 0) {
      delay(1000);
      ESP.restart();
    }
    //........................................ 
  }
  //---------------------------------------- 
  
  digitalWrite(ON_Board_LED, LOW); //--> Turn off the On Board LED when it is connected to the wifi router.
  
  //---------------------------------------- If successfully connected to the wifi router, the IP Address that will be visited is displayed in the serial monitor
  Serial.println();
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  //Serial.print("IP address: ");
  //Serial.println(WiFi.localIP());
  Serial.println("-------------");
  delay(2000);
}


void loop() {
  // put your main code here, to run repeatedly

  //---------------------------------------- Check WiFi connection status.
  if(WiFi.status()== WL_CONNECTED) {
    HTTPClient http;  //--> Declare object of class HTTPClient.
    int httpCode;     //--> Variables for HTTP return code.
    
    //........................................ Process to get RELAYs data from database to control RELAYs.
    postData = "id=esp32_02";
    payload = "";
  
    digitalWrite(ON_Board_LED, HIGH);
    Serial.println();
    Serial.println("---------------getDataRelay.php");
    
    http.begin("http://192.168.1.9/loginSystem/relay/getDataRelay.php");  //--> Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");        //--> Specify content-type header
   
    httpCode = http.POST(postData); //--> Send the request
    payload = http.getString();     //--> Get the response payload
  
    Serial.print("httpCode : ");
    Serial.println(httpCode); //--> Print HTTP return code
    Serial.print("payload  : ");
    Serial.println(payload);  //--> Print request response payload
    
    http.end();  //--> Close connection
    Serial.println("---------------");
    digitalWrite(ON_Board_LED, LOW);
    //........................................ 

    // Calls the control_LEDs() subroutine.
    control_RELAYs();
    
    delay(1000);


  
    //........................................ The process of sending the state of the RELAYs to the database.
    String RELAY_01_State = "";
    String RELAY_02_State = "";

    if (digitalRead(RELAY_01) == 1) RELAY_01_State = "ON";
    if (digitalRead(RELAY_01) == 0) RELAY_01_State = "OFF";
    if (digitalRead(RELAY_02) == 1) RELAY_02_State = "ON";
    if (digitalRead(RELAY_02) == 0) RELAY_02_State = "OFF";
    
    postData = "id=esp32_02";
    postData += "&relay_01=" + RELAY_01_State;
    postData += "&relay_02=" + RELAY_02_State;
    payload = "";
  
    digitalWrite(ON_Board_LED, HIGH);
    Serial.println();
    Serial.println("---------------updateRELAYSdata_and_recordtable.php");
    // Example : http.begin("http://192.168.0.0/ESP32_MySQL_Database/Final/updateDHT11data_and_recordtable.php");
    http.begin("http://192.168.1.9/loginSystem/relay/updateRELAYSdata_and_recordtable.php");  //--> Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  //--> Specify content-type header
   
    httpCode = http.POST(postData); //--> Send the request
    payload = http.getString();  //--> Get the response payload
  
    Serial.print("httpCode : ");
    Serial.println(httpCode); //--> Print HTTP return code
    Serial.print("payload  : ");
    Serial.println(payload);  //--> Print request response payload
    
    http.end();  //Close connection
    Serial.println("---------------");
    digitalWrite(ON_Board_LED, LOW);
    //........................................ 
    
    delay(4000);
  }

}