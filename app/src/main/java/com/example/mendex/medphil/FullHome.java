package com.example.mendex.medphil;

import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.media.RingtoneManager;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Handler;
import android.support.v4.app.NotificationCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

import static java.lang.Thread.sleep;

public class FullHome extends AppCompatActivity {
    Context context;
    String array[];
    String name;
    TextView FullName;
    static int dosageNo = 0;
    private int mInterval = 18000; // 18 seconds by default, can be changed later
    private Handler mHandler;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_full_home);
        Intent b = new Intent();
        Bundle bun = getIntent().getExtras();
        String nam = bun.getString("NameForHome");
       // Log.d("TestUser", nam);
        FullName = (TextView) findViewById(R.id.F_Name);
        TextView Medicine = (TextView) findViewById(R.id.Med);
        FullName.setText(nam);
        Medicine.setText("Panadols");
        ProfileLoad load = new ProfileLoad(context);
        load.execute();
        mHandler = new Handler();
        startRepeatingTask();

    }


    private class ProfileLoad extends AsyncTask<Void, Void, String> {

        Context context;

        ProfileLoad(Context ctx) {
            context = ctx;
        }

        @Override
        protected String doInBackground(Void... params) {
            // These two need to be declared outside the try/catch
            // so that they can be closed in the finally block.
            HttpURLConnection urlConnection = null;
            BufferedReader reader = null;

            // Will contain the raw JSON response as a string.
            String forecastJsonStr = null;
            try {
                // Construct the URL for the OpenWeatherMap query
                // Possible parameters are avaiable at OWM's forecast API page, at
                // http://openweathermap.org/API#forecast
                URL url = new URL("http://192.168.43.248/profileLoad.php");

                // Create the request to OpenWeatherMap, and open the connection
                urlConnection = (HttpURLConnection) url.openConnection();
                urlConnection.setRequestMethod("GET");
                urlConnection.connect();

                // Read the input stream into a String
                InputStream inputStream = urlConnection.getInputStream();
                StringBuffer buffer = new StringBuffer();
                if (inputStream == null) {
                    // Nothing to do.
                    return null;
                }
                reader = new BufferedReader(new InputStreamReader(inputStream));

                String line;
                while ((line = reader.readLine()) != null) {
                    // Since it's JSON, adding a newline isn't necessary (it won't affect parsing)
                    // But it does make debugging a *lot* easier if you print out the completed
                    // buffer for debugging.
                    buffer.append(line + "\n");
                }

                if (buffer.length() == 0) {
                    // Stream was empty.  No point in parsing.
                    return "No";
                }
                forecastJsonStr = buffer.toString();
                int length = buffer.length();
                // public String[] array = new String[length];
                JSONObject o = new JSONObject(forecastJsonStr);
                JSONArray a = o.getJSONArray("result");
                array = new String[a.length()];
                for (int i = 0; i <= 1; i++) {
                    JSONObject object = a.getJSONObject(i);
                    array[i] = object.getString("FullName");
                    name = array[i];
                }
                return name;
            } catch (Exception e) {
                Log.e("PlaceholderFragment", "Error ", e);
                return null;
            } finally {
                if (urlConnection != null) {
                    urlConnection.disconnect();
                }
                if (reader != null) {
                    try {
                        reader.close();
                    } catch (final IOException e) {
                        Log.e("PlaceholderFragment", "Error closing stream", e);
                    }
                }
            }
        }

        protected void onPostExecute(String e) {
            FullName = (TextView) findViewById(R.id.F_Name);
            TextView Medicine = (TextView) findViewById(R.id.Med);
          //  FullName.setText("Darth Vadar");
            Medicine.setText("Panadols");
        }
    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        stopRepeatingTask();
    }

    Runnable mStatusChecker = new Runnable() {
        @Override
        public void run() {
            try {
               // updateStatus(); //this function can change value of mInterval.
                //sleep(5000);

                    addNotification();
                    dosageDetails();




            }catch (Exception e){

            }finally {
                // 100% guarantee that this always happens, even if
                // your update method throws an exception
                mHandler.postDelayed(mStatusChecker, mInterval);
            }
        }
    };

    void startRepeatingTask() {
        mStatusChecker.run();
    }

    void stopRepeatingTask() {
        mHandler.removeCallbacks(mStatusChecker);
    }


    private void addNotification() {
        int numMessages = 0;
        NotificationCompat.Builder builder =
                new NotificationCompat.Builder(this)
                       .setSmallIcon(R.drawable.noti)
                       .setContentTitle("Dosage Alert")
                        .setContentText("Take 2 Panadols");

        Intent notificationIntent = new Intent(this, FullHome.class);
        PendingIntent contentIntent = PendingIntent.getActivity(this, 10000, notificationIntent,
                PendingIntent.FLAG_UPDATE_CURRENT);

        builder.setVibrate(new long[] { 1000});
        builder.setLights(Color.RED, 3000, 3000);
        Uri uri= RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
        builder.setSound(uri);
        builder.setNumber(++numMessages);
        builder.setPriority(Notification.PRIORITY_HIGH);
       builder.setContentIntent(contentIntent);

      // NotificationCompat.InboxStyle inboxStyle = new NotificationCompat.InboxStyle();

         // String[] events = new String[2];
         //events[0] = new String("Medication Information");
           //events[1] = new String("This is your "+ String.valueOf(numMessages)+ " Dose");
        //events[2] = new String("You have Taken the Previous Dose");


        // Sets a title for the Inbox style big view
          //  inboxStyle.setBigContentTitle("MedPhil Notification");

        // Moves events into the big view
        //for (int i=0; i < events.length; i++) {
            //inboxStyle.addLine(events[i]);
        //}

        //builder.setStyle(inboxStyle);

        // Add as notification
        NotificationManager manager = (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);
        manager.notify(50000, builder.build());
    }

    public void dosageDetails(){
       // dosageNo = 0;
       // String[] textArray = {"One", "Two", "Three", "Four"};
        View linearLayout = findViewById(R.id.layoutForDetails);
      // LinearLayout linearLayout = new LinearLayout(this);
        ++dosageNo;
        String time = String.valueOf(dosageNo);
        TextView valueTV = new TextView(this);
        if(dosageNo == 2 || dosageNo == 5) {
            valueTV.setText("Your Dosage : " + time + " \nTake 2 Panadols");
        }else{
            valueTV.setText("Your Dosage : " + time + " \nTake 2 Panadols");
        }
        valueTV.setTextColor(Color.parseColor("#87CEFA"));
        valueTV.setTextSize(getResources().getDimension(R.dimen.textsize));
        //valueTV.setBackgroundResource(R.drawable.med);

        valueTV.setHeight(250);
        valueTV.setLayoutParams(new LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.WRAP_CONTENT));

        ((LinearLayout) linearLayout).addView(valueTV);
    }
}

