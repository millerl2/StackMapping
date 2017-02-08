package edu.newpaltz.brendan.librarymainnew.fragment;

import android.os.Bundle;
import android.os.StrictMode;
import android.support.v4.app.Fragment;
import android.support.v4.content.res.ResourcesCompat;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.graphics.Color;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;


import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.URL;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import java.util.Objects;

import edu.newpaltz.brendan.librarymainnew.MainActivity;
import edu.newpaltz.brendan.librarymainnew.R;


/**
 * Fragment for PC availability.
 */

public class PCFragment extends Fragment {

    public PCFragment() {}
    private ArrayList<String> PCstatusArray = new ArrayList<>();
    View view;


    @Override
    public void onActivityCreated(Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_pc, container, false);
        RelativeLayout rlayout  = (RelativeLayout) view.findViewById(R.id.pc_fragment);
        setPCStausByTag(rlayout);

        ((MainActivity) getActivity()).setActionBarTitle("PC availability");


        return view;

    }

    private void setPCStausByTag(RelativeLayout rlayout){
        try {
            StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                    .permitAll().build();
            StrictMode.setThreadPolicy(policy);

            InputStream input = new URL("http://library.newpaltz.edu/pctracker/counts/").openStream();

            BufferedReader r = new BufferedReader(new InputStreamReader(input));
            StringBuilder total = new StringBuilder();
            String line;
            while ((line = r.readLine()) != null) {
                total.append(line);
            }

            ArrayList<String> jsonLines = (ArrayList) extractJSON(total.toString(), "{", "}");
            createJson(jsonLines.get(1));
            //handles pc 0
            PCstatusArray.add(null);
            makePCStatusArray(jsonLines.get(2));

        } catch (IOException|JSONException e) {
            e.printStackTrace();
        }


        TextView t;

        //loop through every pc
        for (int i = 1; i < PCstatusArray.size(); i++) {
            //set t to each pc textbox
            t = (TextView) rlayout.findViewWithTag("pcnum" + i);
            if (Objects.equals(PCstatusArray.get(i), "available")) {
                //set background green
                t.setBackgroundColor(ResourcesCompat.getColor(getResources(), R.color.colorAccent, null));
            } else if (Objects.equals(PCstatusArray.get(i),"inUse")) {
                //set background grey
                t.setBackgroundColor(Color.parseColor("#a6a6a6"));
            } else if (Objects.equals(PCstatusArray.get(i),"unAvailable")) {
                //set background white
                t.setBackgroundColor(Color.parseColor("#ffffff"));
            }
        }
    }

    private void setProgressBar(int max, int min){
        ProgressBar progressBar = (ProgressBar) view.findViewById(R.id.pc_progressBar);
        progressBar.setMax(max);
        progressBar.setProgress(min);

        TextView textView = (TextView) view.findViewById(R.id.textViewPcs);
        textView.setText(min + " PCs Available out of " + max);
    }


    public List<String> extractJSON(String text, String begin, String end) {
        int BeginJSON = 0;
        int EndJSON = 0;
        String json;
        List<String> textsJSON = new ArrayList<>();

        BeginJSON = text.indexOf(begin, BeginJSON + 1);

        do {
            EndJSON = text.lastIndexOf(end);
            if(EndJSON <= BeginJSON) {
                break;
            }

            do {
                json = text.substring(BeginJSON, EndJSON + 1);
                try {
                    new JSONObject(json);
                    textsJSON.add(json);
                } catch (Exception e) {
                }
                EndJSON = text.substring(0, EndJSON).lastIndexOf(end);
            } while(EndJSON > BeginJSON);

            BeginJSON = text.indexOf(begin, BeginJSON + 1);

        } while(BeginJSON != -1);

        return textsJSON;
    }


    public void createJson(String json) throws JSONException{
        JSONObject jsonObject = new JSONObject(json);
        setProgressBar(jsonObject.getInt("pcsTotal"), jsonObject.getInt("pcsAvailable"));
    }

    public void makePCStatusArray(String json) throws  JSONException {
        JSONObject jsonObject = new JSONObject(json);

        for (Iterator<String> keys = jsonObject.keys(); keys.hasNext();) {
            PCstatusArray.add(jsonObject.getString(keys.next()));

        }
    }





}