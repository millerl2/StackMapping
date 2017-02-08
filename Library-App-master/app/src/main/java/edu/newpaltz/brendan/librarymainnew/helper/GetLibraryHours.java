package edu.newpaltz.brendan.librarymainnew.helper;

import android.os.AsyncTask;
import android.util.Log;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URL;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

/**
 * Helper class to retrieve library hours.
 */

public class GetLibraryHours extends AsyncTask<URL, Void, String[]> {

    private static final String TAG = "GetLibraryHours";

    private DateFormat df;
    private Date today;
    private String currentDate;

    protected String[] doInBackground(URL... urls) {
        today = new Date();
        df = new SimpleDateFormat("M/d/yyyy");
        currentDate = df.format(today);
        String[] sevenDays = new String[7];

        try {
            BufferedReader libraryHours = new BufferedReader(new InputStreamReader(urls[0].openStream()));
            String line;
            Log.d(TAG, currentDate);
            while ((line = libraryHours.readLine()) != null) {
                if (line.contains(currentDate)) {
                    for (int i = 0; i <= 6; i++) {
                        Log.d(TAG, line);
                        sevenDays[i] = line;
                        line = libraryHours.readLine();
                    }
                    break;
                }
            }
        } catch (IOException i) {
            i.printStackTrace();
        }
        return sevenDays;
    }
}
