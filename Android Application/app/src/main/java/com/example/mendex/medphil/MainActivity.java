package com.example.mendex.medphil;

import android.content.Intent;
import android.net.sip.SipAudioCall;
import android.net.wifi.p2p.WifiP2pManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import static android.provider.AlarmClock.EXTRA_MESSAGE;

public class MainActivity extends AppCompatActivity {
    private static Button registeredUser, newUser;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        newUserClick();
        registeredUserClick();
    }

    public void newUserClick(){
        newUser = (Button)findViewById(R.id.userNew);
        newUser.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        Intent newUserIntent = new Intent("com.example.mendex.medphil.category");
                        startActivity(newUserIntent);
                    }
                }
        );

    }

    public void registeredUserClick(){
        registeredUser = (Button)findViewById(R.id.registered);
        registeredUser.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        Intent registeredUserIntent = new Intent("com.example.mendex.medphil.loginScreen");
                        startActivity(registeredUserIntent);
                    }
                }
        );
    }
}



