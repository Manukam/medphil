package com.example.mendex.medphil;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class second_page extends AppCompatActivity {

    EditText FirstName, Address, Age, UserName, Email, Password,LastName;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_second_page);
        //Intent intent = getIntent();

        FirstName = (EditText)findViewById(R.id.firstname);
        LastName= (EditText)findViewById(R.id.lastname);
       //Age = (EditText)findViewById(R.id.Age);
        UserName = (EditText)findViewById(R.id.UserName);
        Email = (EditText)findViewById(R.id.Email);
        Password = (EditText)findViewById(R.id.Password);
    }

    public void registerPatient (View view){
        String firstName = FirstName.getText().toString();
        //String Add = Address.getText().toString();
        //String age = Age.getText().toString();
        String User_name = UserName.getText().toString();
        String mail = Email.getText().toString();
        String pass = Password.getText().toString();
        String last_nam = LastName.getText().toString();
        String type = "Register";

        BackgroundWorker patientWorker = new BackgroundWorker(this);
        patientWorker.execute(type,firstName,User_name,mail,pass,last_nam);
        Intent proceed1 = new Intent("com.example.mendex.medphil.SelecctDoctor");
        Bundle bundle = new Bundle();
        bundle.putString("UserName", User_name);
        proceed1.putExtras(bundle);
        startActivity(proceed1);
    }
}

