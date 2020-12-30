#include <Adafruit_NeoPixel.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#define PIN            14
#define NUMPIXELS      42

Adafruit_NeoPixel pixels = Adafruit_NeoPixel(
                             NUMPIXELS, PIN, NEO_GRB + NEO_KHZ800);
                             
const char* ssid = ""; // wifi name
const char* password = ""; // wifi PW
const String id = ""; // admin ID
int xml_loading_time = 5000; // update time

const String endpoint = "http://flowxlab.net/test/arduinos/"+id+".php";
String line = "";
int r = 0;
int g = 0;
int b = 0;
int brightness_100 = 0;
int brightness = 0;
int num = 1;

void setup() {
  Serial.begin(115200);

  pixels.begin();

  for (int i = 0; i < NUMPIXELS; i++) {
    pixels.setPixelColor(i, pixels.Color(0, 0, 0));
  }
  pixels.show();

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("Connected to the WiFi network");

}

void get_data() {
  if ((WiFi.status() == WL_CONNECTED)) { //Check the current connection status
    Serial.println("Starting connection to server...");
    HTTPClient http;
    http.begin(endpoint);       //Specify the URL
    int httpCode = http.GET();  //Make the request
    if (httpCode > 0) {         //Check for the returning code
      line = http.getString();
    }
    else {
      Serial.println("Error on HTTP request");
    }

    r = parsing("r");
    g = parsing("g");
    b = parsing("b");
    brightness_100 = parsing("brightness");
    num = parsing("num");
    
    if (brightness_100 >= 100) {
      brightness_100 = 100;
    }
    
    brightness = map(brightness_100, 0, 100, 0, 255);

    Serial.println(r);
    Serial.println(g);
    Serial.println(b);

    http.end(); //Free the resources
  }
}

int parsing(String tagName) {
  int rgb_start = line.indexOf("<" + tagName + ">");
  int rgb_end = line.indexOf("</" + tagName + ">");
  String color = line.substring(rgb_start + tagName.length() + 2, rgb_end);
  return color.toInt();
}

void loop() {
  get_data();

  pixels.setBrightness(brightness);

  if (0 < num && num < NUMPIXELS) {
    for (int i = 0; i < num; i++) {
      pixels.setPixelColor(i, pixels.Color(r, g, b));
    }
    for (int i = num; i < NUMPIXELS; i++) {
      pixels.setPixelColor(i, pixels.Color(0, 0, 0));
    }
    pixels.show();
  }

  if (num >= NUMPIXELS) {
    for (int i = 0; i < NUMPIXELS; i++) {
      pixels.setPixelColor(i, pixels.Color(r, g, b));
    }
    pixels.show();
  }

  if (num == 0) {
    for (int i = 0; i < NUMPIXELS; i++) {
      pixels.setPixelColor(i, pixels.Color(0, 0, 0));
    }
    pixels.show();
  }

  delay(xml_loading_time);
}
