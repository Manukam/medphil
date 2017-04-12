package com.example.mendex.medphil;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

/**
 * Created by Manuka on 12/29/2016.
 */

public class BackgroundWorker extends AsyncTask<String,Void,String> {
    Context thisContext;
    ProgressDialog pDialog;
    BackgroundWorker(Context ctx) {

        thisContext = ctx;
    }
    Bundle bundleForHome = new Bundle();

    @Override
    protected String doInBackground(String... voids) {
        String type = voids[0];
        String login_url = "http://192.168.43.248/Login.php";
        if (type.equalsIgnoreCase("Login")) {
            try {
                String user_name = voids[1];
                String password = voids[2];
                URL url = new URL(login_url);
                bundleForHome.putString("NameForHome", user_name);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
                String post_data = URLEncoder.encode("user_name", "UTF-8") + "=" + URLEncoder.encode(user_name, "UTF-8") + "&" +
                        URLEncoder.encode("password", "UTF-8") + "=" + URLEncoder.encode(password, "UTF-8");
                bufferedWriter.write(post_data);
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();

                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
                String result = "";
                String line = "";
                while ((line = bufferedReader.readLine()) != null) {
                    result += line;
                }
                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();

                /*if (result.equalsIgnoreCase("Login Success"))
                    Toast.makeText(context, "Login Succesful", Toast.LENGTH_SHORT).show();
                else {
                    Toast.makeText(context, "Invalid Login Information", Toast.LENGTH_SHORT).show();
                }*/
                return result;


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }else if(type.equalsIgnoreCase("Doc_Register")){
            try {
                String doc_url = "http://192.168.8.103/InsertDoctor.php";
                String user_name = voids[1];
                String docField = voids[2];
                String docHospital = voids[3];
                String docMobile = voids[4];
                String password = voids[5];
                String docFullName = voids[6];
                URL url = new URL(doc_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream,"UTF-8"));
                String post_data = URLEncoder.encode("UserName","UTF-8")+"="+URLEncoder.encode(user_name,"UTF-8")+"&" +
                        URLEncoder.encode("Field","UTF-8")+"="+URLEncoder.encode(docField,"UTF-8")+"&"+
                        URLEncoder.encode("Hospital","UTF-8")+"="+URLEncoder.encode(docHospital,"UTF-8")+"&"+
                        URLEncoder.encode("Mobile","UTF-8")+"="+URLEncoder.encode(docMobile,"UTF-8")+"&"+
                        URLEncoder.encode("pass","UTF-8")+"="+URLEncoder.encode(password,"UTF-8")+"&"+
                        URLEncoder.encode("FullName","UTF-8")+"="+URLEncoder.encode(docFullName,"UTF-8");
                bufferedWriter.write(post_data);
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();

                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
                String result = "";
                String line = "";
                while((line = bufferedReader.readLine()) != null){
                    result += line;
                }
                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();

                return result;


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }else if(type.equalsIgnoreCase("Register")){
            try {
                String patient_url = "http://192.168.8.103/InsertPatient.php";
                String FirstName = voids[1];
                //String Address = voids[2];
               // String Age = voids[3];
                String UserName = voids[2];
                String mail = voids[3];
                String pass = voids[4];
                String lastName = voids[5];

                URL url = new URL(patient_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream,"UTF-8"));
                String post_data = URLEncoder.encode("FirstName","UTF-8")+"="+URLEncoder.encode(FirstName,"UTF-8")+"&" +
                        URLEncoder.encode("LastName","UTF-8")+"="+URLEncoder.encode(lastName,"UTF-8")+"&"+
                      //  URLEncoder.encode("","UTF-8")+"="+URLEncoder.encode(Age,"UTF-8")+"&"+
                        URLEncoder.encode("UserName","UTF-8")+"="+URLEncoder.encode(UserName,"UTF-8")+"&"+
                        URLEncoder.encode("mail","UTF-8")+"="+URLEncoder.encode(mail,"UTF-8")+"&"+
                        URLEncoder.encode("pass","UTF-8")+"="+URLEncoder.encode(pass,"UTF-8");
                bufferedWriter.write(post_data);
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();

                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
                String result = "";
                String line = "";
                while((line = bufferedReader.readLine()) != null){
                    result += line;
                }
                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();

               /* if (result.equalsIgnoreCase("Successfully Registered!")) {
                    Toast.makeText(context, "Registration Succesful!", Toast.LENGTH_SHORT).show();
                }else{
                    Toast.makeText(context, "Something went wrong! Try Again!", Toast.LENGTH_SHORT).show();
                }*/
                return result;


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

        }else if(type.equalsIgnoreCase("Select_Doctor")){
            try {
                String doctor_patient_url = "http://192.168.8.103/Doctor_Patient.php";
                String user_name = voids[1];
                String doctor_name = voids[2];
                URL url = new URL(doctor_patient_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
                String post_data = URLEncoder.encode("PUserName", "UTF-8") + "=" + URLEncoder.encode(user_name, "UTF-8") + "&" +
                        URLEncoder.encode("DUserName", "UTF-8") + "=" + URLEncoder.encode(doctor_name, "UTF-8");
                bufferedWriter.write(post_data);
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();

                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
                String result = "";
                String line = "";
                while ((line = bufferedReader.readLine()) != null) {
                    result += line;
                }
                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();

                /*if (result.equalsIgnoreCase("Login Success"))
                    Toast.makeText(context, "Login Succesful", Toast.LENGTH_SHORT).show();
                else {
                    Toast.makeText(context, "Invalid Login Information", Toast.LENGTH_SHORT).show();
                }*/
                return result;
            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }else if(type.equalsIgnoreCase("Final Step")){
            try{
            String doctor_patient_url = "http://192.168.8.103/UserMedicine.php";
            String Table_url = "http://192.168.8.103/newTable.php";
                String user_name = voids[1];
                URL url = new URL(Table_url);
                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                httpURLConnection.setDoInput(true);
                OutputStream outputStream = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
                String post_data = URLEncoder.encode("UserName", "UTF-8") + "=" + URLEncoder.encode(user_name, "UTF-8");
                bufferedWriter.write(post_data);
                bufferedWriter.flush();
                bufferedWriter.close();
                outputStream.close();
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
                String result = "";
                String line = "";
                while ((line = bufferedReader.readLine()) != null) {
                    result += line;
                }
                bufferedReader.close();
                inputStream.close();
                httpURLConnection.disconnect();

               // return result;
            user_name = voids[1];
            String bottle_id = voids[2];
            String medicine_name = voids[3];
            String alert_n = voids[4];
            String dose_Gap = voids[5];
            String remind_me = voids[6];
            url = new URL(doctor_patient_url);
            httpURLConnection = (HttpURLConnection) url.openConnection();
            httpURLConnection.setRequestMethod("POST");
            httpURLConnection.setDoOutput(true);
            httpURLConnection.setDoInput(true);
            outputStream = httpURLConnection.getOutputStream();
            bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
            post_data = URLEncoder.encode("UserName", "UTF-8") + "=" + URLEncoder.encode(user_name, "UTF-8") + "&" +
                    URLEncoder.encode("bottle", "UTF-8") + "=" + URLEncoder.encode(bottle_id, "UTF-8")+"&"+
                    URLEncoder.encode("Medicine", "UTF-8") + "=" + URLEncoder.encode(medicine_name, "UTF-8")+"&"+
                    URLEncoder.encode("remind", "UTF-8") + "=" + URLEncoder.encode(alert_n, "UTF-8")+"&"+
                    URLEncoder.encode("Gap", "UTF-8") + "=" + URLEncoder.encode(dose_Gap, "UTF-8")+"&"+
                    URLEncoder.encode("fillDosage", "UTF-8") + "=" + URLEncoder.encode(remind_me, "UTF-8");
            bufferedWriter.write(post_data);
            bufferedWriter.flush();
            bufferedWriter.close();
            outputStream.close();

            inputStream = httpURLConnection.getInputStream();
            bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
            result = "";
            line = "";
            while ((line = bufferedReader.readLine()) != null) {
                result += line;
            }
            bufferedReader.close();
            inputStream.close();
            httpURLConnection.disconnect();

            return result;
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }

        }
        return null;
    }

    @Override
    protected void onPreExecute() {
        // alertDialog = new AlertDialog.Builder(context).create();
        //alertDialog.setTitle("Login Status");
        super.onPreExecute();
        // Showing progress dialog
        pDialog = new ProgressDialog(thisContext);
        pDialog.setMessage("Please wait...");
        pDialog.setCancelable(true);
        pDialog.show();

    }

    @Override
    protected void onPostExecute(String result) {
        pDialog.dismiss();
        if (result.equalsIgnoreCase("Successfully Registered!")) {
           // Toast.makeText(thisContext, "Registration Successful!", Toast.LENGTH_SHORT).show();
        }else if(result.equalsIgnoreCase("Registration Unsuccessful")){
            Toast.makeText(thisContext, "Something went wrong! Try Again!", Toast.LENGTH_SHORT).show();
        }else if(result.equalsIgnoreCase("Patient")) {
            Toast.makeText(thisContext, "Welcome!", Toast.LENGTH_SHORT).show();
            Intent home = new Intent("com.example.mendex.medphil.FullHome");
            home.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            home.putExtras(bundleForHome);
            thisContext.startActivity(home);
        }else if (result.equalsIgnoreCase("Doctor")){
            Toast.makeText(thisContext, "Welcome!", Toast.LENGTH_SHORT).show();
            Intent homeForDoctor = new Intent("com.example.mendex.medphil.ShowPatients");
            thisContext.startActivity(homeForDoctor);
        }else if(result.equalsIgnoreCase("Login Unsuccessful")){
            Toast.makeText(thisContext, "Invalid User Name/Password", Toast.LENGTH_SHORT).show();

        }
    }



    @Override
    protected void onProgressUpdate(Void... values) {
        super.onProgressUpdate(values);
    }
}
