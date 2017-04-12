package com.example.mendex.medphil;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

public class DoctorReg extends AppCompatActivity {

    EditText docUserName, Field, Hospital, Mobile, docPassword, docFullName;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_doctor_reg);
        docUserName = (EditText)findViewById(R.id.docUserName);
        Field = (EditText)findViewById(R.id.docField);
        Hospital = (EditText)findViewById(R.id.Hospital);
        Mobile = (EditText)findViewById(R.id.Mobile);
        docPassword = (EditText)findViewById(R.id.docPassword);
        docFullName = (EditText)findViewById(R.id.firstname);
    }

    public void DocRegister (View view){
        String doc_UserName = docUserName.getText().toString();
        String doc_Field = Field.getText().toString();
        String doc_Hospital = Hospital.getText().toString();
        String doc_Mobile = Mobile.getText().toString();
        String pass = docPassword.getText().toString();
        String doc_FullName = docFullName.getText().toString();
        String type = "Doc_Register";
        BackgroundWorker backgroundWorkerForDoctor = new BackgroundWorker(this);
        backgroundWorkerForDoctor.execute(type,doc_UserName,doc_Field,doc_Hospital,doc_Mobile,pass,doc_FullName);
        Intent proceed = new Intent("com.example.mendex.medphil.loginScreen");
        startActivity(proceed);
    }
}
