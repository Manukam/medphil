package com.example.mendex.medphil;


import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.Toast;
import org.json.JSONArray;
import org.json.JSONObject;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;


public class SelecctDoctor extends AppCompatActivity {
    Button button;
    public static String[] array;
    static String name;
    static String selectedDoctor;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        button = (Button) findViewById(R.id.nextForSelect);
        setContentView(R.layout.activity_selecct_doctor);
        //fetchNow();
        FetchNames fetchNames = new FetchNames(this);
        fetchNames.execute();
        newProceed();
    }

    private class FetchNames extends AsyncTask<Void, Void, String> {

        Context context;

        FetchNames(Context ctx) {
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
                URL url = new URL("http://192.168.43.248/selectDoctor.php");

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
                    return null;
                }
                forecastJsonStr = buffer.toString();
                int length = buffer.length();
                // public String[] array = new String[length];
                JSONObject o = new JSONObject(forecastJsonStr);
                JSONArray a = o.getJSONArray("result");
                array = new String[a.length()];
                for (int i = 0; i < a.length(); i++) {
                    JSONObject object = a.getJSONObject(i);
                    array[i] = object.getString("FullName");
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

        //@Override
        protected void onPostExecute(String e) {
            super.onPostExecute(e);
            Spinner spinner = (Spinner) findViewById(R.id.docSpinner);
            ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(SelecctDoctor.this, android.R.layout.simple_spinner_item, array);
            dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
            spinner.setAdapter(dataAdapter);

            spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {


                @Override
                public void onItemSelected(AdapterView<?> adapter, View v,
                                           int position, long id) {
                    selectedDoctor = adapter.getItemAtPosition(position).toString();
                    Toast.makeText(getApplicationContext(),
                            "Selected Doctor : " + selectedDoctor, Toast.LENGTH_SHORT).show();
                }

                @Override
                public void onNothingSelected(AdapterView<?> arg0) {
                    // TODO Auto-generated method stub
                }

            });
        }



    }
    public void newProceed() {
        button = (Button) findViewById(R.id.nextForSelect);
        button.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        String type = "Select_Doctor";
                        Bundle bundle = getIntent().getExtras();
                        String user_name = bundle.getString("UserName");
                        Intent proceed = new Intent("com.example.mendex.medphil.MedInfo");
                        bundle = new Bundle();
                        bundle.putString("UserName", user_name);
                        proceed.putExtras(bundle);
                        BackgroundWorker selectDoctor = new BackgroundWorker(SelecctDoctor.this);
                        selectDoctor.execute(type,user_name,selectedDoctor);
                        startActivity(proceed);
                    }
                }
        );

    }
}


