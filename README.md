Project Description: It has been designed to make it safer to automatically pass through the doors with a card system. It is also learned with the aim of learning the environmental conditions.

Embedded Part:
The person who wants to pass through the door will have his card read by the RFID NFC module on the embedded circuit with the card given to him before, and the card information of the person will be received by the ESP32. The received data will be sent to the server with the GET method with ESP32 and will also be shown to the person at the door with the LCD screen. In addition, the data of the pressure sensor that controls the ambient temperature and humidity will be transferred to the server both on the LCD screen and with the ESP32.
ESP32 DEVKITV1, RC522 RFID NFC Module, BMP180 Pressure Sensor and I2C OLED Display are used. RC522 RFID NFC Module is connected with SPI connection, BMP180 Pressure Sensor is connected with I2C connection, I2C OLED Display is connected with I2C (Cables are connected directly to GPIO pins since I2C adapter is not used in the application.) connection.

The pin connection is as follows:

RC522 RFID NFC;
MOSI -> GPIO23
MISO -> GPIO19
SCLK -> GPIO18
CS -> GPIO26
RST -> GPIO25
GND -> GND
VCC -> 3.3V

BMP180;
SCL -> GPIO22
SDA -> GPIO21
GND -> GND
VCC -> 3.3V

I2C OLED;
SCL -> GPIO22
SDA -> GPIO21
GND -> GND
VCC -> 3.3V

Web Part:
Incoming data appears on the main page, and the site is automatically refreshed every ten seconds. In order for the person who has previously logged into the site to be detected, the person must register on the site and fill in their profile information and card number. In this way, the person who read the card will appear on the site and the door will open if the authorized person is. In addition, the temperature and humidity information of the environment is displayed on the site.
to the site
The background of the site is designed with PHP, the front side is designed using Bootstrap, MySQLi is used as the database.
