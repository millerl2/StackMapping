package edu.newpaltz.brendan.librarymainnew.fragment;

import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.TextView;

import java.net.MalformedURLException;
import java.net.URL;
import java.util.concurrent.ExecutionException;

import edu.newpaltz.brendan.librarymainnew.MainActivity;
import edu.newpaltz.brendan.librarymainnew.helper.GetLibraryHours;
import edu.newpaltz.brendan.librarymainnew.R;

/**
 * Fragment for general info.
 */

public class InfoFragment extends Fragment {

    private URL libraryHoursTxt;
    private String[] hours;

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        try {
            if (MainActivity.isConnected(getActivity())) {
                libraryHoursTxt = new URL(getString(R.string.library_hours_url));
                hours = new GetLibraryHours().execute(libraryHoursTxt).get();
            }
        } catch (MalformedURLException m) {
            m.printStackTrace();
        } catch (InterruptedException i) {
            i.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        ((MainActivity) getActivity()).setActionBarTitle("General");
        return inflater.inflate(R.layout.fragment_info, container, false);
    }

    public void onStart() {
        super.onStart();

        if (hours != null) {
            TextView typeView = (TextView) getView().findViewById(R.id.day_type_view);
            TextView todayView = (TextView) getView().findViewById(R.id.today_view);
            TextView weekView = (TextView) getView().findViewById(R.id.week_view);

            String[] tokens = hours[0].split("\\t");
            String type = tokens[2]+":";
            String dayOfWeek = tokens[3];
            String todaysDate = tokens[1].substring(0,tokens[1].indexOf('/',3));
            String todaysHours = "\nToday, "+dayOfWeek+" ("+todaysDate+")";

            String weekHours = "";

            // Today's Hours
            if (!tokens[4].equals("Closed")) {
                todaysHours = todaysHours+"\nOpen "+tokens[4]+" - "+tokens[5];
            } else {
                todaysHours = todaysHours+"\nClosed";
            }

            // Late Room Hours
            if (!tokens[8].equals("Closed")) {
                todaysHours = todaysHours+"\nLate Room 12am - "+tokens[8];
            } else {
                todaysHours = todaysHours+"\nLate Room Closed";
            }

            // This week's hours
            for (int i = 1; i < hours.length; i++) {
                tokens = hours[i].split("\\t");
                dayOfWeek = abrevDay(tokens[3]);
                todaysDate = tokens[1].substring(0,tokens[1].indexOf('/',3));
                if (!tokens[4].equals("Closed")) {
                    weekHours = weekHours+dayOfWeek+" ("+todaysDate+"): "+tokens[4]+" - "+tokens[5]+"\n";
                } else {
                    weekHours = weekHours+dayOfWeek+" ("+todaysDate+"): Closed\n";
                }
            }

            // Set view text
            typeView.setText(type);
            todayView.setText(todaysHours);
            weekView.setText(weekHours);
        }
    }

    public String abrevDay(String dOW) {
        if (dOW.equals("Sunday")) {
            return "Sun.";
        } else if (dOW.equals("Monday")) {
            return "Mon.";
        } else if (dOW.equals("Tuesday")) {
            return "Tue.";
        } else if (dOW.equals("Wednesday")) {
            return "Wed.";
        } else if (dOW.equals("Thursday")) {
            return "Thu.";
        } else if (dOW.equals("Friday")) {
            return "Fri.";
        } else if (dOW.equals("Saturday")) {
            return "Sat.";
        } else {
            return "";
        }
    }
}
