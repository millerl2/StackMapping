package edu.newpaltz.brendan.librarymainnew.helper;

import android.os.AsyncTask;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;

import edu.newpaltz.brendan.librarymainnew.MainActivity;

/**
 *  Helper class to retrieve POST (http) form data.
 */

// TODO: connect to Gary's HTTPS server (use HttpsURLConnection)
public class POSTDataToServer extends AsyncTask<String, Void, Boolean> {

    protected Boolean doInBackground(String... data) {

        byte[] byteData = data[0].getBytes();

        OutputStream outputStream = null;
        InputStream serverReply = null;
        String replyString = null;

        try {
            URL formProcessor = new URL(MainActivity.FORMS_SERVER);
            HttpURLConnection httpClient = (HttpURLConnection) formProcessor.openConnection();

            httpClient.setDoOutput(true); // Necessary to form an HTTP request with a body (automatically sets method to POST)
            httpClient.setFixedLengthStreamingMode(byteData.length);

            outputStream = new BufferedOutputStream(httpClient.getOutputStream());

            outputStream.write(byteData);

            outputStream.close();

            httpClient.disconnect();
        } catch (IOException i) {
            i.printStackTrace();
        }
        return true;
    }
}
