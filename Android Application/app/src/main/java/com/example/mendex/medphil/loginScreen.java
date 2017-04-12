package com.example.mendex.medphil;

import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.support.design.widget.TabLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v4.app.NotificationCompat;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class loginScreen extends AppCompatActivity {
    EditText userName,pass;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_screen);
        userName = (EditText) findViewById(R.id.user_name);
        pass = (EditText) findViewById(R.id.pass);
      /*  Button b1 = (Button)findViewById(R.id.loginBtn);
        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //addNotification();
                String user_name = userName.getText().toString();
                String password = pass.getText().toString();
                String type = "Login";
                BackgroundWorker backgroundWorker = new BackgroundWorker(getBaseContext());
                backgroundWorker.execute(type,user_name,password);
            }
        });*/
    }

    private void addNotification() {
        NotificationCompat.Builder builder =
                new NotificationCompat.Builder(this)
                        .setSmallIcon(R.drawable.noti)
                        .setContentTitle("Notifications Example")
                        .setContentText("This is a test notification");

        Intent notificationIntent = new Intent(this, MainActivity.class);
        PendingIntent contentIntent = PendingIntent.getActivity(this, 10000, notificationIntent,
                PendingIntent.FLAG_UPDATE_CURRENT);
        builder.setContentIntent(contentIntent);

        // Add as notification
        NotificationManager manager = (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);
        manager.notify(50000, builder.build());
    }

    public void LoginAction (View view){
        String user_name = userName.getText().toString();
        String password = pass.getText().toString();
        String type = "Login";
        BackgroundWorker backgroundWorker = new BackgroundWorker(this);
        backgroundWorker.execute(type,user_name,password);

    }

}

