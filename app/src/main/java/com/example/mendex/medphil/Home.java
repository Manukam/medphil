package com.example.mendex.medphil;

import android.content.Context;
import android.os.AsyncTask;
import android.support.design.widget.TabLayout;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;

import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class Home extends AppCompatActivity {
    static String array1[];
    String name;
    private SectionsPagerAdapter mSectionsPagerAdapter;
    Context context;
    private ViewPager mViewPager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        // Create the adapter that will return a fragment for each of the three
        // primary sections of the activity.
        mSectionsPagerAdapter = new SectionsPagerAdapter(getSupportFragmentManager());

        // Set up the ViewPager with the sections adapter.
        mViewPager = (ViewPager) findViewById(R.id.container);
        mViewPager.setAdapter(mSectionsPagerAdapter);

        TabLayout tabLayout = (TabLayout) findViewById(R.id.tabs);
        tabLayout.setupWithViewPager(mViewPager);
        tabLayout.getTabAt(0).setIcon(R.drawable.profile);
        tabLayout.getTabAt(1).setIcon(R.drawable.noti);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });
       // ProfileLoad pf = new ProfileLoad(this);
        //pf.execute();
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_home, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    /**
     * A placeholder fragment containing a simple view.
     */
    public static class Holder extends Fragment{
        private static final String ARG_SECTION_NUMBER1 = "section_number";
        public Holder(){

        }


        public static Holder newInstance(int sectionNumber){
            Holder fragment1 = new Holder();
            Bundle args1 = new Bundle();
            args1.putInt(ARG_SECTION_NUMBER1,sectionNumber);
            //Bundle bundle = getIntent().getExtras();
            //String user_name = bundle.getString("UserName");
            fragment1.setArguments(args1);
            return fragment1;
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            Context context = getActivity();
            View rootView = inflater.inflate(R.layout.profile,container,false);
            //ProfileLoad1 test = new ProfileLoad1(getApplicationContext());
            return rootView;
        }


    }
    private class ProfileLoad1 extends AsyncTask<Void, Void, String> {

        Context context;

        ProfileLoad1(Context ctx) {
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
                array1 = new String[a.length()];
                for (int i = 0; i <= 1; i++) {
                    JSONObject object = a.getJSONObject(i);
                    array1[i] = object.getString("FullName");
                    name = array1[i];
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
            TextView FullName = (TextView) findViewById(R.id.F_Name);
            TextView Medicine = (TextView)findViewById(R.id.Med);
            FullName.setText("Afra Raheem");
            Medicine.setText("Panadols");
        }
    }


    public static class Notify extends Fragment{
        private static final String ARG_SECTION_NUMBER2 = "section_number";
        public Notify(){

        }
        //TextView

        public static Notify newInstance(int sectionNumber){
            Notify fragment_noti = new Notify();
            Bundle args1 = new Bundle();
            args1.putInt(ARG_SECTION_NUMBER2,sectionNumber);
            fragment_noti.setArguments(args1);
            return fragment_noti;
        }


        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {

            View rootView = inflater.inflate(R.layout.notifications,container,false);
            //Name = (TextView)rootView.findViewById(R.id.Name);
            // Age = (TextView)rootView.findViewById(R.id.Age);
            // Medicine = (TextView)rootView.findViewById(R.id.Med);
            //Doctor = (TextView)rootView.findViewById(R.id.doctor);
            // CareTaker = (TextView)rootView.findViewById(R.id.Taker);

            return rootView;
        }
    }



    /**
     * A {@link FragmentPagerAdapter} that returns a fragment corresponding to
     * one of the sections/tabs/pages.
     */
    public class SectionsPagerAdapter extends FragmentPagerAdapter {

        public SectionsPagerAdapter(FragmentManager fm) {
            super(fm);
        }

        @Override
        public Fragment getItem(int position) {
            // getItem is called to instantiate the fragment for the given page.
            // Return a PlaceholderFragment (defined as a static inner class below).
            switch (position){
                case 0:  return Holder.newInstance(position + 1);
                case 1: return  Notify.newInstance(position+1);
                default: return  Holder.newInstance(position+1);
            }

        }

        @Override
        public int getCount() {
            // Show 3 total pages.
            return 2;
        }

        @Override
        public CharSequence getPageTitle(int position) {
            switch (position) {
                case 0:
                    return "Profile";
                case 1:
                    return "Notifications";
                case 2:
                    return "SECTION 3";
            }
            return null;
        }
    }
        /*public void userClick(View v) {
            Button btn = (Button) findViewById(R.id.refresh);
            btn.setText("Hey");

        }*/

        }


