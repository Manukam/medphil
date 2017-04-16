#include <Arduino.h>

/*
  Simple Web Data Client

  This sketch connects to a website using an Arduino Wiznet Ethernet shield,
  downloads a simple dataset, and does some LED fades based on the data.

  Circuit:
   Ethernet shield attached to pins 10, 11, 12, 13

  created december 2014
  by Nathan Yau, based on work by David A. Mellis, Tom Igoe, and Adrian McEwen

  This example code is in the public domain.
*/

#include <SPI.h>
#include <Ethernet.h>

// RGB LED
int redPin = 6;
int greenPin = 5;
int bluePin = 4;

// dosage gap
int delayMins = 0;
int notifyTime = 2000; // time taken for a single notification
int notifyIterations = 4; // number of times notified with the single pattern 2
long delayTime = 0;
//delayTime = dosageGap - (notifyTime * notifyIterations);

// user related variables
String patientUserName;
String medicineName;
String dosageStatus = "NOT_TAKEN";

// bottle values
String bottleId = "1"; // this is uniqe for each bottle
String username = "";
String medicine = "";
// change to 10000
long dosageGap = 10000;
long notifyDuration = 0;
// changed from 0
long fillupDosage = 5;

// n-th dosage
long dosage = 1;

long dosageIteration = 1; // each dosage will have iterations within that
long dosageIterationMax = dosageGap; // iterations within dosage is upto dosageGap

// button states
int btnLastState = 0;
int btnCurrentState = 0;

// status of writability to the database
boolean dbWritable = true;

// Enter a MAC address for your controller below.
// Newer Ethernet shields have a MAC address printed on a sticker on the shield
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

// Enter the IP address for Arduino, as mentioned we will use 192.168.0.16
// Be careful to use , insetead of . when you enter the address here
IPAddress ip(192, 168, 8, 16); ///////// MIGHT GO WRONG HERE

// if you don't want to use DNS (and reduce your sketch size)
// use the numeric IP instead of the name for the server:
//char server[] = "projects.flowingdata.com";
//char server[] = "medphil.000webhostapp.com";
char server[] = "192.168.8.100";

// txt file's available location
String dataLocation = "/MedPhil/userConfig.txt HTTP/1.1";
//String dataLocation = "/test/users.txt HTTP/1.1";

// Initialize the Ethernet client library
// with the IP address and port of the server
// that you want to connect to (port 80 is default for HTTP):
EthernetClient client;


String currentLine = "";            // string for incoming serial data
String currentData = "";
boolean readingRates = false;       // is reading?
const int requestInterval = 600000; // milliseconds delay between requests

boolean requested;                  // whether you've made a request since connecting
long lastAttemptTime = 0;           // last time you connected to the server, in milliseconds


// assigned during reading
String justRates;
int firstSpaceIndex;
String subString2;
int secondSpaceIndex;
String subString3;
int thirdSpaceIndex;
String dosage_gap;
String subString4;
int fourthSpaceIndex;
String notify_duration;
String fillup_dosage;

int switchValue;


void setup() {

  // switch
  pinMode(2, INPUT);

  // set initial state
  // read switch value
  switchValue = digitalRead(2);
  if ( switchValue == 1) {
    btnLastState = 1;
    btnCurrentState = 1;
  } else {
    btnLastState = 0;
    btnCurrentState = 0;
  }

  // Open serial communications and wait for port to open:
  Serial.begin(9600);

  // start the Ethernet connection
  Ethernet.begin(mac, ip); ////// CAN GO WRONG HERE

  // hi message
  Serial.println("---------------------------");
  Serial.println("MedPhil : Smart Pill Holder");
  Serial.println("---------------------------");

  // connect to server

  Serial.println("connecting to server...");

  if (client.connect(server, 80)) {
    Serial.println("making HTTP request...");

    // make HTTP GET request to dataLocation:
    client.println("GET " + dataLocation);
    client.println("Host: 192.168.8.100");
    client.println();

  }

}


void loop() {

  // read data ********************************************************************************

  // Checking for new data
  if (client.connected()) {
    if (client.available()) {
      // read incoming bytes:
      char inChar = client.read();

      // add incoming byte to end of line:
      currentLine += inChar;

      // if you get a newline, clear the line:
      if (inChar == '\n') {
        currentLine = "";
      }

      // get length of bottle id (may be in two or more digits)
      int bottleIdLength = bottleId.length();

      // finding the appropriate line with bottle's details
      if (currentLine.endsWith("<" + bottleId + ">")) {
        readingRates = true; // set readable to true
      } else if (readingRates) {
        if (!currentLine.endsWith("</" + bottleId + ">")) { //'>' is the ending character
          currentData += inChar;
        } else {
          readingRates = false;

          // line with values is read
          justRates = currentData.substring(0, currentData.length() - (bottleIdLength + 3));

          // elements are split and assigned
          int firstSpaceIndex = justRates.indexOf(" ");
          username = justRates.substring(0, firstSpaceIndex); // assigning user name

          subString2 = justRates.substring(firstSpaceIndex + 1);
          secondSpaceIndex = subString2.indexOf(" ");
          medicine = subString2.substring(0, secondSpaceIndex); // assigning medicine name

          subString3 = subString2.substring(secondSpaceIndex + 1);
          thirdSpaceIndex = subString3.indexOf(" ");
          dosage_gap = subString3.substring(0, thirdSpaceIndex);
          dosageGap = dosage_gap.toInt(); // assigning dosageGap
          dosageIterationMax = dosageGap; // assigning maximum iterations within a dosage

          subString4 = subString3.substring(thirdSpaceIndex + 1);
          fourthSpaceIndex = subString4.indexOf(" ");
          notify_duration = subString4.substring(0, fourthSpaceIndex);
          notifyDuration = notify_duration.toInt(); // assigning notify duration

          fillup_dosage = subString4.substring(fourthSpaceIndex + 1);
          fillupDosage = fillup_dosage.toInt(); // assigning fill up dosage

          // assign to variables that are going to be used when writing
          patientUserName = username;
          medicineName = medicine;
          notifyIterations = notifyDuration;

          delayTime = dosageGap - (notifyTime * notifyIterations);

          client.stop(); // reading over


          // Reset for next reading
          currentData = "";

          Serial.println(">>> Reading Successful");

        }
      }
    }


  }


  // ******************************************************************************************

  // check iteration no within dosage
  if (dosageIteration == 1) {

    Serial.print("Dosage : ");
    Serial.println(dosage);

    // first ever iteration within dosage
    /*
       reset dbWritable to true
       set initial switch value within dosage
       read medicine details
       notification will be given
       at the end of notification
       check for button toggle

    */

    // writable to the database at the beginning of each iteration
    dbWritable = true;

    // set initial switch value within dosage
    switchValue = digitalRead(2);
    if ( switchValue == 1) {
      btnCurrentState = 1;
      btnLastState = 1;
    } else {
      btnCurrentState = 0;
      btnLastState = 0;
    }

    // read medicine details ////////////////////////////////////////////////////////////////////////




    // end of read medicine details /////////////////////////////////////////////////////////////

    // give notifications
    for (int i = 0; i < notifyIterations ; i++) {
      notify(fillupDosage);
    }
    Serial.print("\n");

    // check for button toggle (* dbWritable is true anyhow)
    // read switch state
    switchValue = digitalRead(2);
    if ( switchValue == 1) {
      btnCurrentState = 1;
    } else {
      btnCurrentState = 0;
    }

    // check for toggle
    if (btnCurrentState != btnLastState) {
      // switch is toggled
      dbWritable = false;
      dosageStatus = "TAKEN";

      // Connect to the server (your computer or web page)
      if (client.connect(server, 80)) {
        client.print("GET /MedPhil/write_data.php?"); // This
        client.print("patientUserName="); // This
        client.print(patientUserName); // And this is what we did in the testing section above. We are making a GET request just like we would from our browser but now with live data from the sensor
        client.print("&medicineName="); // This
        client.print(medicineName);
        client.print("&dosageStatus="); // This
        client.print(dosageStatus);
        client.println(" HTTP/1.1"); // Part of the GET request
        client.println("Host: 192.168.8.100"); // IMPORTANT: If you are using XAMPP you will have to find out the IP address of your computer and put it here (it is explained in previous article). If you have a web page, enter its address (ie.Host: "www.yourwebpage.com")
        client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
        client.println(); // Empty line
        client.println(); // Empty line
        client.stop();    // Closing connection to server after writing
        Serial.println("TAKEN Detected- Successfully Uploaded");

      }
      else {
        // If Arduino can't connect to the server (your computer or web page)
        Serial.println("--> TAKEN Detected- connection failed\n");
      }

      //Serial.println("TAKEN");
    }


    // ready for next iteration within dosage
    dosageIteration += (notifyTime * notifyIterations);

  } else if (dosageIteration == dosageIterationMax) {
    // last ever iteration within dosage
    /*
       the last millisecond of dosage
       no need to check for button toggle
       if dbWritable==true
       no button toggle has occured
       upload status "Not Taken"
       reset dosageIteration to 1 (ready for next dosage)
    */

    if (dbWritable) {
      // no button toggle has occured
      dosageStatus = "NOT_TAKEN";

      // Connect to the server (your computer or web page)
      if (client.connect(server, 80)) {
        client.print("GET /MedPhil/write_data.php?"); // This
        client.print("patientUserName="); // This
        client.print(patientUserName); // And this is what we did in the testing section above. We are making a GET request just like we would from our browser but now with live data from the sensor
        client.print("&medicineName="); // This
        client.print(medicineName);
        client.print("&dosageStatus="); // This
        client.print(dosageStatus);
        client.println(" HTTP/1.1"); // Part of the GET request
        client.println("Host: 192.168.8.100"); // IMPORTANT: If you are using XAMPP you will have to find out the IP address of your computer and put it here (it is explained in previous article). If you have a web page, enter its address (ie.Host: "www.yourwebpage.com")
        client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
        client.println(); // Empty line
        client.println(); // Empty line
        client.stop();    // Closing connection to server after writing
        Serial.println("NOT TAKEN - Successfully Uploaded");

      }
      else {
        // If Arduino can't connect to the server (your computer or web page)
        Serial.println("--> NOT TAKEN - connection failed\n");
      }

      //Serial.println("NOT TAKEN");
    }

    // get ready for next dosage : dosageIteration
    dosageIteration = 1;
    dbWritable = true;

    // get ready for next dosage
    dosage++;

    // delay 1 millisecond
    delay(1);

  } else {
    // iteration other than first or last
    /*
       if dbWritable == true
       if switch toggle occurs
       status : taken
       upload
    */

    if (dbWritable) {
      // no button toggle has occured

      // read switch state
      switchValue = digitalRead(2);
      if ( switchValue == 1) {
        btnCurrentState = 1;
      } else {
        btnCurrentState = 0;
      }

      // check for toggle
      if (btnCurrentState != btnLastState) {
        // switch is toggled
        dbWritable = false;
        dosageStatus = "TAKEN";

        // Connect to the server (your computer or web page)
        if (client.connect(server, 80)) {
          client.print("GET /MedPhil/write_data.php?"); // This
          client.print("patientUserName="); // This
          client.print(patientUserName); // And this is what we did in the testing section above. We are making a GET request just like we would from our browser but now with live data from the sensor
          client.print("&medicineName="); // This
          client.print(medicineName);
          client.print("&dosageStatus="); // This
          client.print(dosageStatus);
          client.println(" HTTP/1.1"); // Part of the GET request
          client.println("Host: 192.168.8.100"); // IMPORTANT: If you are using XAMPP you will have to find out the IP address of your computer and put it here (it is explained in previous article). If you have a web page, enter its address (ie.Host: "www.yourwebpage.com")
          client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
          client.println(); // Empty line
          client.println(); // Empty line
          client.stop();    // Closing connection to server after writing
          Serial.println("TAKEN Detected- Successfully Uploaded");

        }
        else {
          // If Arduino can't connect to the server (your computer or web page)
          Serial.println("--> TAKEN Detected- connection failed\n");
        }

        //Serial.println("TAKEN");
      }


    }

    // ready for next iteration within dosage
    dosageIteration++;

    // delay 1 millisecond
    delay(1);
  }



}



/**
   sets color of the light
*/
void setLightColor(int blue, int green, int red)
{
  analogWrite(redPin, red);
  analogWrite(greenPin, green);
  analogWrite(bluePin, blue);
}

/**
   reminder notification
*/
void notify(int fillUpDosage) {
  if (dosage < fillUpDosage-1) {
    lightNotify();
    Serial.print("NOTIFY ");
  } else {
    lowWarning();
    Serial.print("ALERT ");
  }

}

/**
   low capacity warning
*/
void lowWarning() {
  // total duration : 2 seconds (2000)
  for (int i = 0 ; i < 4 ; i++) {
    //setLightColor(25, 186, 170);
    setLightColor(0, 150, 255);
    //setLightColor(0, 0, 255);
    //setLightColor(i*100, i*100,0);
    delay(100);
    setLightColor(0, 0, 0);
    delay(100);
  }
  //delay(1830);

  for (int i = 0 ; i < 3 ; i++) {

    setLightColor(255, 0, 0);
    delay(100);
    setLightColor(0, 0, 0);
    delay(300);
  }



}

/**
   blink lights for notification
*/
void lightNotify() {
  // total duration : 2 seconds (2000)
  for (int i = 0 ; i < 4 ; i++) {
    //setLightColor(25, 186, 170);
    setLightColor(0, 150, 255);
    //setLightColor(0, 0, 255);
    //setLightColor(i*100, i*100,0);
    delay(100);
    setLightColor(0, 0, 0);
    delay(100);
  }
  //delay(1830);
  delay(1200);
}


/**
   connects to server
*/
void connectToServer() {
  // attempt to connect, and wait a millisecond:
  Serial.println("connecting to server...");
  if (client.connect(server, 80)) {
    Serial.println("making HTTP request...");

    // make HTTP GET request to dataLocation:
    client.println("GET " + dataLocation);
    client.println("Host: 192.168.8.100");
    client.println();
  }
}


/**
   converts string to float
   return : float value
*/
float strToFloat(String str) {
  char carray[str.length() + 1];           // determine size of array
  str.toCharArray(carray, sizeof(carray)); // put str into an array
  return atof(carray);
}






