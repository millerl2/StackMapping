package edu.newpaltz.brendan.librarymainnew;

import android.Manifest;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.Fragment;
import android.support.v4.content.ContextCompat;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.widget.Button;
import android.widget.Toast;

import edu.newpaltz.brendan.librarymainnew.fragment.ContactFragment;
import edu.newpaltz.brendan.librarymainnew.fragment.DirectionsFragment;
import edu.newpaltz.brendan.librarymainnew.fragment.forms.ILLFormFragment;
import edu.newpaltz.brendan.librarymainnew.fragment.forms.PurchaseFormFragment;
import edu.newpaltz.brendan.librarymainnew.fragment.forms.SuggestionFormFragment;
import edu.newpaltz.brendan.librarymainnew.fragment.GuideFragment;
import edu.newpaltz.brendan.librarymainnew.fragment.InfoFragment;
import edu.newpaltz.brendan.librarymainnew.fragment.PCFragment;
import edu.newpaltz.brendan.librarymainnew.fragment.WebViewFragment;

import static android.Manifest.permission.ACCESS_COARSE_LOCATION;
import static android.R.attr.fragment;
import static android.R.attr.id;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    // Permissions codes
    public static final int PERMISSION_SEND_SMS = 1;
    public static final int PERMISSION_ACCESS_COARSE_LOCATION = 2;
    // public static final int PERMISSION_ACCESS_FINE_LOCATION = 3;

    // IDs for forms must match XML
    public static final int SUGGESTION = 0;
    public static final int PURCHASE = 1;
    public static final int RESEARCH = 4;
    public static final int TECH = 3;
    public static final int ILL = 2;

    // Application ID for online forms submission
    public static final String POST_SOURCE = "libraryapp1";

    // URL for forms server saved as String
    public static String FORMS_SERVER;

    NavigationView navigationView = null;
    Toolbar toolbar = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FORMS_SERVER = getString(R.string.form_proc_url);         // Used by ASyncTask helper class POSTDataToServer

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        //highlight first fragment
        navigationView.getMenu().getItem(0).setChecked(true);
        //select first fragment
        onNavigationItemSelected(navigationView.getMenu().getItem(0));

    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }


    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();
        Fragment fragment;

        if (id == R.id.nav_info) {
            fragment = new InfoFragment();
        } else if (id == R.id.nav_guide) {
            fragment = new GuideFragment();
        } else if (id == R.id.nav_directions) {
                fragment = new DirectionsFragment(); // Launch MapView
        } else if (id == R.id.nav_map) {
            fragment = new WebViewFragment(getString(R.string.map_url), "Map");
        } else if (id == R.id.nav_catalog) { 
            fragment = new WebViewFragment(getString(R.string.catalog_url), "Catalog");
        } else if (id == R.id.nav_pc_status) {
            fragment = new PCFragment();
        } else if (id == R.id.nav_contact) {
            fragment = new ContactFragment();
        } else  { //if (id == R.id.nav_form) {
            fragment = new SuggestionFormFragment();
        }

        if(id != -1) {
            android.support.v4.app.FragmentTransaction fragmentTransaction =
                    getSupportFragmentManager().beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, fragment);
            fragmentTransaction.commit();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    public void openWebChat(View view) {
        if (MainActivity.isConnected(this)) {
            WebViewFragment fragment = new WebViewFragment(getString(R.string.online_chat_url), "Web Chat");
            android.support.v4.app.FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
            fragmentTransaction.replace(R.id.fragment_container, fragment);
            fragmentTransaction.commit();
        }
    }

    public void sendSMS(View view) {
        ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.SEND_SMS}, PERMISSION_SEND_SMS);
        Intent smsIntent = new Intent(Intent.ACTION_VIEW);
        smsIntent.setData(Uri.parse("sms:"));
        smsIntent.setType("vnd.android-dir/mms-sms");
        // Brendan's Num.
        smsIntent.putExtra("address"  , "5852004554");
        smsIntent.putExtra("sms_body"  , "\'Your question here\'");
        startActivity(smsIntent);
    }

    public void openFacebook(View view) {
        try {
            Intent appIntent = new Intent(Intent.ACTION_VIEW, Uri.parse(getString(R.string.facebook_app_uri)));
            startActivity(appIntent);
        } catch (Exception e) {
            Intent browserIntent = new Intent(Intent.ACTION_VIEW, Uri.parse(getString(R.string.facebook_url)));
            startActivity(browserIntent);
        }
    }

    public void openTwitter(View view) {
            try {
                Intent appIntent = new Intent(Intent.ACTION_VIEW, Uri.parse(getString(R.string.twitter_app_uri)));
                startActivity(appIntent);
            } catch (Exception e) {
                Intent browserIntent = new Intent(Intent.ACTION_VIEW, Uri.parse(getString(R.string.twitter_url)));
                startActivity(browserIntent);
            }
    }

    public void openMaps() {

    }

    public void dialNum(View view) {
        Button b = (Button) view;
        String number = b.getText().toString();
        number.replaceAll("-","");
        number.replaceAll("\\s+","");
        Intent dialIntent = new Intent(Intent.ACTION_DIAL);
        dialIntent.setData(Uri.parse("tel:"+number));
        startActivity(dialIntent);
    }

    public void selectForm(int formNum) {
        switch (formNum) {
            case SUGGESTION: { SuggestionFormFragment suggestionFormFragment = new SuggestionFormFragment();
                android.support.v4.app.FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, suggestionFormFragment);
                fragmentTransaction.commit();
                break; }
            case PURCHASE: {
                PurchaseFormFragment purchFormFragment = new PurchaseFormFragment();
                android.support.v4.app.FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, purchFormFragment);
                fragmentTransaction.commit();
                break; }
            case RESEARCH: {
                // TODO
                break; }
            case TECH: {
                // TODO
                break; }
            case ILL: {
                ILLFormFragment illFormFragment = new ILLFormFragment();
                android.support.v4.app.FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
                fragmentTransaction.replace(R.id.fragment_container, illFormFragment);
                fragmentTransaction.commit();
                break; }
        }

    }

    public void setActionBarTitle(String title){
        getSupportActionBar().setTitle(title);
    }

    public static boolean isConnected(Context thisActivity) {
        ConnectivityManager cm = (ConnectivityManager) thisActivity.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo activeNetwork = cm.getActiveNetworkInfo();
        if (activeNetwork != null) { // connected to the internet
            return true;
        } else { // no connection
            // not connected to the internet
            Toast.makeText(thisActivity, "Please Connect to Internet", Toast.LENGTH_SHORT).show();
            return false;
        }
    }
}
