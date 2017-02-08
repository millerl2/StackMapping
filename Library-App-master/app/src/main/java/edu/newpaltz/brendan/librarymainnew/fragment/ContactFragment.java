package edu.newpaltz.brendan.librarymainnew.fragment;

import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import edu.newpaltz.brendan.librarymainnew.MainActivity;
import edu.newpaltz.brendan.librarymainnew.R;

/**
 * Fragment for sending SMS and online librarian chat (behavior defined in XML)
 */

public class ContactFragment extends Fragment{

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        ((MainActivity) getActivity()).setActionBarTitle("Contact");

        return inflater.inflate(R.layout.fragment_contact, container, false);
    }

}
