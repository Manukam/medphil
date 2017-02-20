package com.example.mendex.medphil;

import android.content.Intent;
import android.icu.util.ULocale;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

public class category extends AppCompatActivity {

    private static Button categoryButton;
    private static RadioButton type;
    private static RadioGroup type_g;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_category);
        CategorySelect();
    }

    public void CategorySelect(){
        categoryButton = (Button)findViewById(R.id.nextStep);
        type_g = (RadioGroup)findViewById(R.id.type_group);

        categoryButton.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        int selected_type = type_g.getCheckedRadioButtonId();
                        type = (RadioButton) findViewById(selected_type);
                        if (selected_type != -1) {
                            if (type.getText().toString().equalsIgnoreCase("patient")) {
                                Intent patientLogin = new Intent("com.example.mendex.medphil.second_page");
                                startActivity(patientLogin);
                            } else if (type.getText().toString().equalsIgnoreCase("doctor")) {
                                Intent doctorLogin = new Intent("com.example.mendex.medphil.DoctorReg");
                                startActivity(doctorLogin);
                            } else if (type.getText().toString().equalsIgnoreCase("Care Taker")) {
                                Intent careTakerLogin = new Intent("com.example.mendex.medphil.second_page");
                                startActivity(careTakerLogin);
                            }
                        }else{
                            Toast.makeText(category.this, "Please select an Option", Toast.LENGTH_SHORT).show();
                        }

                    }
                }
        );
    }
}
