#include <Arduino.h>

/*
  MedPhil : Smart Pill holder

  This sketch connects to a server using Arduino Ethernet shield,
  reads dataset from a txt file,  does LED notifications based on the read data,
  determines write dataset with Ultrasonic sensor,  and writes to the database.

  Dosage taken status detected on Lid open
  Dosage not taken status detected at the end of dosage, when no lid opening has occured

  Circuit:
   Ethernet shield attached to pins 10, 11, 12, 13 to Arduino Uno
   RGB LED attached to pins 3,4,5 (r,g,b respectively)
   Ultrasonic (HC SR04) sensor attached on pins 6,7 (trig & echo respectively)
   Toggle switch attached to pin 2 (for backup)
   Other Components :
    10 KOhm Resistor

  created on December 2016
  by Senthuran Ambalavanar

*/

#include <SPI.h>
#include <Ethernet.h>

// define connected pins //////////////////////////////////////////////////

// RGB LED
int redPin = 3;
int greenPin = 4;
int bluePin = 5;

// HCSR04 sensor
int trigPin = 6;
int echoPin = 7;

//////////////////////////////////////////////////////////////////////////

// dosage & iteration related variables
int notifyTime = 2000; // time taken for a single notification (Fixed for this pattern)
int notifyIterations = 4; // number of times notified with the pattern
long delayTime = 0;

// user related variables (in arduino code scope)
String patientUserName;
String medicineName;
String dosageStatus = "NOT_TAKEN";


// bottle related values (medicine details)(read from file)
String bottleId = "1"; // this is uniqe for each bottle
String username = "senthu16";
String medicine = "";
long dosageGap = 20000;
long notifyDuration = 0;
long fillupDosage = 5;

// no of current dosage
long dosage = 1;

// dosage iterations (within a dosage)
long dosageIteration = 1; // each dosage will have iterations within that
long dosageIterationMax = dosageGap; // iterations within dosage is upto dosageGap

// button states
//int btnLastState = 0;
//int btnCurrentState = 0;

// sensor measured distances
long lastDistance = 0;
long currentDistance = 0;

// status of writability to the database
boolean dbWritable = true;

// MAC address for the Ethernet Shield
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };

// IP address for Arduino
// takes up an un unsed IP address in the same subnet of computer's IP address
IPAddress ip(192, 168, 1, 16);

// server address where the files are hosted
// for localhost : use IP address of computer
// otherwise use the site name
// char server[] = "192.168.1.100";
char server[] = "medphil.xyz";

// txt file's available location within the server
// comes after htdocs (or www or public_html) folder
// String dataLocation = "/MedPhil/userConfig.txt HTTP/1.1";
String dataLocation = "/userConfig.txt HTTP/1.1";

// Initialize the Ethernet client library
// with the IP address and port of the server
// that is used to connect to (port 80 is default for HTTP)
EthernetClient client;


// file reading related variables
String currentLine = ""; // string for incoming serial data
String currentData = "";
boolean readingRates = false; // is reading?

// assigned during reading
String bottleInfo;
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

// switch status when detected
//int switchValue;


void setup() {

  // pinmode input & output configurations
  //pinMode(2, INPUT); // switch
  pinMode(3, OUTPUT); // LED
  pinMode(4, OUTPUT); // LED
  pinMode(5, OUTPUT); // LED
  pinMode(trigPin, OUTPUT); // ultrasonic sensor : trig
  pinMode(echoPin, INPUT); // ultrasonic sensor : echo

  // Open serial communications
  Serial.begin(9600);

  // start the Ethernet connection
  Ethernet.begin(mac, ip);

  // measure distance (at beginning)
  currentDistance = lastDistance = measure();

  Serial.println("---------------------------");
  Serial.println("MedPhil : Smart Pill Holder");
  Serial.println("---------------------------");

  // connect to server
  connectToServer(server, dataLocation);

}


void loop() {

  // read data ///////////////////////////////////////////////////////////////////////////////////////////////////

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
          bottleInfo = currentData.substring(0, currentData.length() - (bottleIdLength + 3));

          // elements are split and assigned
          int firstSpaceIndex = bottleInfo.indexOf(" ");
          username = bottleInfo.substring(0, firstSpaceIndex); // assigning user name

          subString2 = bottleInfo.substring(firstSpaceIndex + 1);
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
          
          Serial.println("username : "+username);

        }
      }
    }
  }
  patientUserName="senthu16";
  medicineName="Panadol";

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  //readData();

  // check iteration no within dosage
  if (dosageIteration == 1) {

    Serial.println("");

    Serial.print("Dosage : ");
    Serial.println(dosage);

    // first ever iteration within dosage
    /*
       reset dbWritable to true
       measure distance
       give notification
       check for lid open

    */

    // writable to the database at the beginning of each iteration
    dbWritable = true;

    // measure distance (at beginning)
    currentDistance = lastDistance = measure();

    Serial.print("Measured Distance (dosageIteration 1) : ");
    Serial.println(currentDistance);

    // give notifications
    for (int i = 0; i < notifyIterations ; i++) {

      notify(currentDistance);

    }
    Serial.print("\n");

    // possible lid open after notification
    // measure distance & compare with the last measured distance


    /*
    // measure distance
    currentDistance = measure();

    // print and test
    //    Serial.print("Last Distance : ");
    //    Serial.println(lastDistance);
    //    Serial.print("Measured Distance : ");
    //    Serial.println(currentDistance);

    //if ((currentDistance != lastDistance) && (currentDistance != 0) && (lastDistance != 0)) {*/
    // possible +or- 1 in distance
    if ((!((currentDistance <= lastDistance + 1) && (currentDistance >= lastDistance - 3))) && (currentDistance != 0) && (lastDistance != 0) && (currentDistance > lastDistance)) {

      Serial.print("CurrentDistance : ");
      Serial.println(currentDistance);
      Serial.print("LastDistance : ");
      Serial.println(lastDistance);

      // lid open detected
      dbWritable = false;
      dosageStatus = "TAKEN";
      writeToDatabase(server, patientUserName, medicineName, dosageStatus);

    }/*
    */


    // ready for next iteration within dosage
    dosageIteration += (notifyTime * notifyIterations);

  } else if (dosageIteration == dosageIterationMax) {

    Serial.println("Last Iteration");

    // last ever iteration within dosage
    /*
       the last millisecond of dosage
       no need to check for lid open
       if dbWritable==true
       no lid opening has occured
       upload status "Not Taken"
       reset dosageIteration to 1 (ready for next dosage)
    */

    if (dbWritable) {

      // no lid opening has been occured
      //dosageStatus = "NOT_TAKEN";
      writeToDatabase(server, patientUserName, medicineName, "NOT_TAKEN");

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
       if lid opening occurs
       upload status "Taken"
    */

    if (dbWritable) {

      // no lid opening has been occured yet

      // measure distance
      currentDistance = measure();

      // print and test
      //      Serial.print("Last Distance : ");
      //      Serial.println(lastDistance);
      //      Serial.print("Measured Distance : ");
      //      Serial.println(currentDistance);

      //if ((currentDistance != lastDistance) && (currentDistance != 0) && (lastDistance != 0)) {
      // possible +or- 1 in distance
      if ((!((currentDistance <= lastDistance + 1) && (currentDistance >= lastDistance - 3))) && (currentDistance != 0) && (lastDistance != 0) && (currentDistance > lastDistance)) {

        Serial.print("CurrentDistance : ");
        Serial.println(currentDistance);
        Serial.print("LastDistance : ");
        Serial.println(lastDistance);

        // lid open detected
        dbWritable = false;
        //dosageStatus = "TAKEN";

        setLightColor(0, 255, 0);
        writeToDatabase(server, patientUserName, medicineName, "TAKEN");
        
      }

    }

    // ready for next iteration within dosage
    dosageIteration++;

    setLightColor(0, 0, 0);

    // delay 1 millisecond
    delay(1);

  }
}


/**
   dosage notification
*/
void notify(int currentDistance) {

  // old condition : user given value is compared
  //  if (dosage < fillUpDosage - 1) {

  // check for measured distance
  if (currentDistance < 4) {

    // measured height is less
    // enough pills remaining

    fullReminder();
    Serial.print("NOTIFY ");

  } else {

    // measured height is big
    // not enough pills remaining

    fullWarn();
    Serial.print("ALERT ");

  }

}



/**
   full reminder to take pills
   before pill shortage occurs
*/
void fullReminder() {

  // total duration : 2 seconds (2000)

  for (int i = 0 ; i < 4 ; i++) {
    singleReminder();
  }

  delay(1200);
}


/**
   full reminder with warning
   when pill shortage occurs
*/
void fullWarn() {
  // total duration : 2 seconds (2000)

  for (int i = 0 ; i < 4 ; i++) {
    singleReminder();
  }

  for (int i = 0 ; i < 3 ; i++) {
    singleWarn();
  }

}

/**
   single reminder to take pills
   before pill shortage occurs
*/
void singleReminder() {
  // blue LED blink
  setLightColor(0, 0, 255);
  delay(100);
  setLightColor(0, 0, 0);
  delay(100);
}

/**
   single warn
   when pill shortage is met
*/
void singleWarn() {
  // red LED blink
  setLightColor(255, 0, 0);
  delay(100);
  setLightColor(0, 0, 0);
  delay(300);
}

/**
   sets color of the light
*/
void setLightColor(int red, int green, int blue) {
  analogWrite(redPin, red);
  analogWrite(greenPin, green);
  analogWrite(bluePin, blue);
}

/**
  reads data from text file
*/
void readData() {
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
          bottleInfo = currentData.substring(0, currentData.length() - (bottleIdLength + 3));

          // elements are split and assigned
          int firstSpaceIndex = bottleInfo.indexOf(" ");
          username = bottleInfo.substring(0, firstSpaceIndex); // assigning user name

          subString2 = bottleInfo.substring(firstSpaceIndex + 1);
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
}

/**
   connects to server
*/
void connectToServer(char server[], String dataLocation) {
  // attempt to connect, and wait a millisecond:
  Serial.println("connecting to server...");
  if (client.connect(server, 80)) {
    Serial.println("making HTTP request...");

    // make HTTP GET request to dataLocation:
    client.println("GET " + dataLocation);

    client.print("Host: ");
    client.println(server);
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


/**
   returns distance, measured with HCSR04 sensor
*/
long sonarSensor(int trigPin, int echoPin) {
  digitalWrite(trigPin, LOW);
  //delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  //delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  long duration = pulseIn(echoPin, HIGH);
  long distance = (duration / 2) / 29.1;
  //currentDistance = distance;
  return distance;
}

/**
   executes sonarSensor measurement & return measured value
*/
long measure() {
  return sonarSensor(trigPin, echoPin);
}


/**
   writes dosage status to the database
*/
void writeToDatabase(char server[], String patientUserName, String medicineName, String dosageStatus) {

  Serial.println("WritetoDB");
  Serial.println("UName : "+ patientUserName);
  Serial.println("medic : "+ medicineName);
  Serial.println("status : "+ dosageStatus);

// AFRA'S ROUTER
  
  if (client.connect("192.168.1.100", 80)) {
    // arduino connects to the server

    Serial.println("Client Connected");

    client.print("GET /MedPhil2/firebaseTest.php?"); // This
    client.print("username="); // This
    client.print(patientUserName); // And this is what we did in the testing section above. We are making a GET request just like we would from our browser but now with live data from the sensor
    //client.print("senthu16"); // And this is what we did in the testing section above. We are making a GET request just like we would from our browser but now with live data from the sensor
    client.print("&medicine="); // This
    client.print(medicineName);
    client.print("&status="); // This
    client.print(dosageStatus);
    client.println(" HTTP/1.1"); // Part of the GET request
    client.print("Host: "); // IMPORTANT: If you are using XAMPP you will have to find out the IP address of your computer and put it here (it is explained in previous article). If you have a web page, enter its address (ie.Host: "www.yourwebpage.com")
    client.println("192.168.1.100");
    client.println("Connection: close"); // Part of the GET request telling the server that we are over transmitting the message
    client.println(); // Empty line
    client.println(); // Empty line
    client.stop();    // Closing connection to server after writing

    Serial.println("Client Stopped");


    // show status in serial monitor
    if (dosageStatus.equals("TAKEN")) {
      Serial.println("TAKEN Detected - Successfully Uploaded");
    } else {
      Serial.println("NOT_TAKEN - Successfully Uploaded");
    }

  } else {
    // arduino can't connect to the server

    // show status in serial monitor
    if (dosageStatus.equals("TAKEN")) {
      Serial.println("--> TAKEN Detected - Uploading failed");
    } else {
      Serial.println("--> NOT_TAKEN - Uploading failed");
    }
  }// end if
}





