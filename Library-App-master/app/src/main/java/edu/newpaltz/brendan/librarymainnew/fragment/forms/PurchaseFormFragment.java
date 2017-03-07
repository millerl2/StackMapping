package edu.newpaltz.brendan.librarymainnew.fragment.forms;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import java.net.URLEncoder;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import edu.newpaltz.brendan.librarymainnew.MainActivity;
import edu.newpaltz.brendan.librarymainnew.R;
import edu.newpaltz.brendan.librarymainnew.helper.POSTDataToServer;

/**
 * Fragment for online forms submission
 */

public class PurchaseFormFragment extends Fragment {

    // Debug code
    public static final String TAG = "PurchaseFormFragment";

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

        ((MainActivity) getActivity()).setActionBarTitle("Book / Media Purchase");
        view = inflater.inflate(R.layout.form_purchase_request, container, false);

        // Set spinner to current form selection
        Spinner formType = (Spinner) view.findViewById(R.id.type_spinner);
        formType.setSelection(MainActivity.PURCHASE);
        formType.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() { // Anonymous class implementation of OnItemSelectedListener

            public void onNothingSelected(AdapterView<?> parent) {
            }

            public void onItemSelected(AdapterView<?> parent, View view, int pos, long id) {
                if (pos != MainActivity.PURCHASE)
                    ((MainActivity) getActivity()).selectForm(pos); // Select form based on spinner selection (fragment transaction in MainActivity)
            }
        });

        final Button sendButton = (Button) view.findViewById(R.id.form_button);
        sendButton.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                sendForm();
                ((MainActivity) getActivity()).selectForm(0);
            }
        });

        return view;
    }

    public void sendForm() {
        Toast.makeText(getActivity(), "Form sent.", Toast.LENGTH_SHORT).show();
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