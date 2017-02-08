package edu.newpaltz.brendan.librarymainnew.fragment.forms;

import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import java.io.IOException;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.concurrent.ExecutionException;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import edu.newpaltz.brendan.librarymainnew.MainActivity;
import edu.newpaltz.brendan.librarymainnew.R;
import edu.newpaltz.brendan.librarymainnew.helper.POSTDataToServer;

/**
 * Fragment for online forms submission
 */

public class SuggestionFormFragment extends Fragment {

    // Debug code
    public static final String TAG = "SuggestionFormFragment";

    // Numeric IDs for form fields. IDs also serve as array indices.
    public static final int NAME = 0;
    public static final int EMAIL = 1;
    public static final int PHONE = 2;
    public static final int STATUS = 3;
    public static final int TEXT_AREA = 4;

    // Regular expressions for checking field inputs.
    public static final Pattern VALID_NAME = Pattern.compile("^[A-Z -]+$", Pattern.CASE_INSENSITIVE);
    public static final Pattern VALID_EMAIL = Pattern.compile("^[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,6}$", Pattern.CASE_INSENSITIVE);
    public static final Pattern VALID_PHONE = Pattern.compile("^[0-9]{10}$");
    public static final Pattern INVALID_SUGGESTION = Pattern.compile("[\\s]+");

    private View view;

    public View onCreateView(final LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        ((MainActivity) getActivity()).setActionBarTitle("Suggestion");
        view = inflater.inflate(R.layout.form_suggestion, container, false);

        // Set spinner to current form selection
        Spinner formType = (Spinner) view.findViewById(R.id.type_spinner);
        formType.setSelection(0);
        formType.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() { // Anonymous class implementation of OnItemSelectedListener

            public void onNothingSelected(AdapterView<?> parent) {
            }

            public void onItemSelected(AdapterView<?> parent, View view, int pos, long id) {
                if (pos != MainActivity.SUGGESTION)
                    ((MainActivity) getActivity()).selectForm(pos); // Select form based on spinner selection (fragment transaction in MainActivity)
            }
        });

        final Button sendButton = (Button) view.findViewById(R.id.form_button);
        sendButton.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                sendForm();
            }
        });

        return view;
    }

    public void sendForm() {

        String[] fields = getFieldValues();

        boolean formError = checkFields(fields);

        if (formError) {
            return;
        }

        String data = "Name=" + URLEncoder.encode(fields[NAME]) // Does not specify encoding scheme, hopefully it defaults to UTF-8 ¯\_(ツ)_/¯
                + "&Email=" + URLEncoder.encode(fields[EMAIL])
                + "&source=" + MainActivity.POST_SOURCE
                + "&formtype=suggestion"
                + "&Phone=" + URLEncoder.encode(fields[PHONE])
                + "&Suggestion=" + URLEncoder.encode(fields[TEXT_AREA]);

        try {
            if (MainActivity.isConnected(getActivity())) {
                boolean sent = new POSTDataToServer().execute(data).get();
            } else {
                return;
            }
        } catch (Exception e) {
            e.printStackTrace();
            Toast.makeText(getActivity(), "Unable to connect to server. Try again later.", Toast.LENGTH_SHORT).show();
            return;
        }

    }

    private String[] getFieldValues() {

        String[] fieldVals = new String[5];

        EditText nameField = (EditText) view.findViewById(R.id.editTextName);
        EditText mailField = (EditText) view.findViewById(R.id.editTextEmail);
        EditText phoneField = (EditText) view.findViewById(R.id.editTextPhone);
        EditText textAreaField = (EditText) view.findViewById(R.id.editTextArea);
        Spinner statusSpinner = (Spinner) view.findViewById(R.id.status_spinner);

        fieldVals[NAME] = nameField.getText().toString();
        fieldVals[EMAIL] = mailField.getText().toString().trim();
        fieldVals[PHONE] = phoneField.getText().toString().trim();
        fieldVals[STATUS] = statusSpinner.getSelectedItem().toString();
        fieldVals[TEXT_AREA] = textAreaField.getText().toString();

        return fieldVals;
    }

    /* Form fields are checked in the reverse order that they appear so that first field (name) is
     always checked last, before an error is returned.*/
    private boolean checkFields(String[] fields) {

        String message = null;

        // Check suggestion box not empty
        Matcher matcher = INVALID_SUGGESTION.matcher(fields[TEXT_AREA]);
        if (matcher.matches()) {
            message = "Suggestion required.";
        }

        // Check phone num. field
        matcher = VALID_PHONE.matcher(fields[PHONE]);
        if (!matcher.matches() && (fields[PHONE] != "")) {
            message = "Invalid phone number.";
            if (fields[PHONE].length() < 10)
                message = message + " Please include area code.";
        }

        // Check e-mail field
        matcher = VALID_EMAIL.matcher(fields[EMAIL]);
        if (!matcher.matches()) {
            message = "Invalid e-mail address format.";
        }

        // Check name field
        matcher = VALID_NAME.matcher(fields[NAME]);
        if (!matcher.matches()) {
            message = "Invalid name format. No special characters or numbers.";
        }

        if (message != null) {
            Toast.makeText(getActivity(), message, Toast.LENGTH_SHORT).show();
            return true;
        }

        return false;
    }
}