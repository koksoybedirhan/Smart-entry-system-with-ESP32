//libraries
#include <WiFi.h>
#include <Wire.h>
#include <SFE_BMP180.h>

//library definitions
SFE_BMP180 bmp180;

//variables
char bmpDurum;
double T, P; 

//web connection
const char* ssid     = "Fatih-Bedirhan";
const char* password = "Fatbed2020";
const char* host = "192.168.1.109";

void setup() {
  //starting to serial communication
  Serial.begin(115200);
  bmp180.begin();
  WiFi.begin(ssid, password);
}

void loop() {
  bmp();

  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) 
  {
    Serial.println("connection failed");
    return;
  }

  client.print(String("GET http://localhost/esp32/index.php?") + 
                          ("&temp=") + T +
                          ("&hum=") + P +
                          " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 1000) {
            Serial.println(">>> Client Timeout !");
            client.stop();
            return;
        }
    }

    // Read all the lines of the reply from server and print them to Serial
  while(client.available()) 
  {
    String line = client.readStringUntil('\r');
    Serial.print(line);   
  }
  delay(10000);
}

//reading and printing humidity and temperature datas.
void bmp()
{
  bmpDurum = bmp180.startTemperature();
  bmpDurum = bmp180.getTemperature(T);
  bmpDurum = bmp180.startPressure(3);
  bmpDurum = bmp180.getPressure(P, T);
  
  Serial.print("Basınç: ");
  Serial.print(P);
  Serial.print(" hPa, ");
  Serial.print("Sıcaklık: ");
  Serial.print(T);
  Serial.println(" C");
}
