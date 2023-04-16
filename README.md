Project; It is designed with the aim of automatically passing through the doors with the card system and learning the ambient conditions.

Within the scope of the project, ESP32 DEVKITV1, RC522 RFID NFC Module, and BMP180 Pressure Sensor are used. RC522 RFID NFC Module is connected with SPI connection, BMP180 Pressure Sensor is connected with I2C connection.

The pin connection is as follows:

RC522 RFID NFC;
MOSI -> GPIO23
MISO -> GPIO19
SCLK -> GPIO18
CS -> GPIO5
RST -> GPIO4
GND -> GND
VCC -> 3.3V

BMP180;
SCL -> GPIO22
SDA -> GPIO21
GND -> GND
VCC -> 3.3V
