package com.example.mendex.medphil;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class MedInfo extends AppCompatActivity {

    EditText id, medname, alertTime, dosageGap, remind;
    Button last;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_med_info);
        id = (EditText)findViewById(R.id.ID);
        medname = (EditText)findViewById(R.id.medName);
        alertTime = (EditText)findViewById(R.id.AlertTime);
        dosageGap = (EditText)findViewById(R.id.DoseGap);
        remind = (EditText)findViewById(R.id.Remind);
        last = (Button)findViewById(R.id.Done);
        LastStep();
    }

    public void LastStep(){
        last.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String bottleID = id.getText().toString();
                String MedicineName = medname.getText().toString();
                String Alert = alertTime.getText().toString();
                String doseGap = dosageGap.getText().toString();
                String RemindMe = remind.getText().toString();
                String type = "Final Step";

                Bundle bundle = getIntent().getExtras();
                String user_name = bundle.getString("UserName");
                BackgroundWorker workerForLastStep = new BackgroundWorker(MedInfo.this);
                workerForLastStep.execute(type,user_name,bottleID,MedicineName,Alert,doseGap,RemindMe);
                Intent proceed1 = new Intent("com.example.mendex.medphil.loginScreen");
                startActivity(proceed1);
            }
        });

    }
}
