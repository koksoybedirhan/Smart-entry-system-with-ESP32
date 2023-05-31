//library part
#include <Wire.h>             
#include "SSD1306Wire.h"      
#include <SFE_BMP180.h>
#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>

//define part
#define SS_PIN  26  /*Slave Select Pin*/
#define RST_PIN 25  /*Reset Pin for RC522*/
#define LED_G   12   /*Pin 8 for LED*/
#define DEMO_DURATION 3000

//library variables part
MFRC522 mfrc522(SS_PIN, RST_PIN);   /*Create MFRC522 initialized*/
SFE_BMP180 bmp180;
SSD1306Wire display(0x3c, SDA, SCL);  

//variables part
String deneme;
int demoMode = 0;
int counter = 1;
double T, P;  // Sıcaklık ve basınç değişkenleri
typedef void (*Demo)(void);
String rfCode;

//web connection
const char* ssid     = "Fatih-Bedirhan";
const char* password = "Fatbed2020";
const char* host = "192.168.1.106";

void setup() {
  //starting serial communication
  Serial.begin(115200);

  //starting rf id
  SPI.begin();          
  mfrc522.PCD_Init();   
  bmp180.begin();
  WiFi.begin(ssid, password);

  //starting screen
  display.init();
  display.flipScreenVertically();
  display.setFont(ArialMT_Plain_10);
}

void loop() {
  //looping all the function
  bmp();
  ekranYazma();
  rf();
  delay(200);
  
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) 
  {
    Serial.println("connection failed");
    return;
  }

  client.print(String("GET http://localhost/esp32/index.php?") + 
                          ("temp=") + T +
                          ("&hum=") + P +
                          ("rfCode=") + rfCode +
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

//rf id part
void rf()
{
  //checking the card; if card is new, then going to first loop, else going second loop.
  if ( ! mfrc522.PICC_IsNewCardPresent())
  {
    return;
  }
  if ( ! mfrc522.PICC_ReadCardSerial())
  {
    return;
  }

  //printing bytes of card to string and after printing string to screen.
  String content = "";
  byte letter;
  for (byte i = 0; i < mfrc522.uid.size; i++)
  {
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  Serial.println(content.substring(1));
  rfCode = content.substring(1);
  delay(100);
}

//bmp180 part
void bmp()
{
  //starting temperature and after getting temperature data.
  bmp180.startTemperature();
  delay(10);
  bmp180.getTemperature(T);
  delay(10);
  
  //starting pressure and after getting pressure data with temperature data.
  bmp180.startPressure(3);
  delay(10);
  bmp180.getPressure(P, T);

  //printing computer and screen 
  Serial.print("Basınç: ");
  Serial.print(P);
  Serial.println(" hPa");
  Serial.print("Sıcaklık: ");
  Serial.print(T);
  Serial.println(" C");
  display.setTextAlignment(TEXT_ALIGN_CENTER);
  display.drawString(64, 23, "Sıcaklık: " + String(T));
  display.drawString(64, 33, "Basınç: " + String(P));
  delay(500);
}

//selecting texts to print screen 
Demo demos[] = {bmp};
int demoLength = (sizeof(demos) / sizeof(Demo));
long timeSinceLastModeSwitch = 0;

//printing screen
void ekranYazma()
{
  display.clear();
  demos[demoMode]();
  display.display();
  delay(500);
}
