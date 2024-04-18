#include <ArduinoJson.h>  // Install ArduinoJson library from Library Manager

#include <ESP8266WiFi.h> // Include the Wi-Fi library

const char* ssid     = "vivo 2007"; // SSID of your Wi-Fi network
const char* password = "12345678"; // Password of your Wi-Fi network
const char* host = "192.168.228.112"; // IP address of your Laravel server
const int port = 8000; // Port number where Laravel is running
const String url = "/send-pakan"; // Route for accessing JSON data

void setup() {
  Serial.begin(115200); // Start serial communication
  delay(100);

  // Connect to Wi-Fi
  Serial.println();
  Serial.println("Connecting to Wi-Fi...");
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("Connected to Wi-Fi");
}

void loop() {
  // Create client object
  WiFiClient client;

  // Connect to server
  Serial.print("Connecting to server: ");
  Serial.println(host);
  if (!client.connect(host, port)) {
    Serial.println("Connection failed");
    return;
  }

  // Send HTTP request
  Serial.println("Sending HTTP request");
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");

  // Wait for response
  while (!client.available()) {
    delay(100);
  }

  // Read response
  Serial.println("Response received:");
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.println(line);
  }

  Serial.println("Closing connection");
  client.stop();

  // Wait for some time before making the next request
  delay(5000);
}
