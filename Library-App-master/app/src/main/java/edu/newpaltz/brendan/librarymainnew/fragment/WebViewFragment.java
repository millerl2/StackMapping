package edu.newpaltz.brendan.librarymainnew.fragment;

import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.v4.app.Fragment;
import android.util.Base64;
import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import java.io.InputStream;

import edu.newpaltz.brendan.librarymainnew.MainActivity;
import edu.newpaltz.brendan.librarymainnew.R;

/**
 * Fragment for online content.
 */

public class WebViewFragment extends Fragment {

    private WebView myWebView;
    private String url;
    private String title;

    private Handler handler = new Handler(){
        @Override
        public void handleMessage(Message message) {
            switch (message.what) {
                case 1:{
                    webViewGoBack();
                }break;
            }
        }
    };

    public WebViewFragment(){
        // Required empty public constructor        
    }

    public WebViewFragment(String u, String t)
    {
        url = u;
        title = t;
    }

    @Override
    public void onActivityCreated(Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_webview, container, false);

        if (MainActivity.isConnected(getActivity())) {
            myWebView = (WebView) view.findViewById(R.id.webview);
            //if javascript is needed
            WebSettings webSettings = myWebView.getSettings();
            webSettings.setJavaScriptEnabled(true);
            //keep web within app
            myWebView.setWebViewClient(new WebViewClient() {
                @Override
                public void onPageFinished(WebView view, String url) {
                    super.onPageFinished(view, url);
                }
            });
            myWebView.loadUrl(url);
            //For using back keys
            myWebView.setOnKeyListener(new View.OnKeyListener(){
                public boolean onKey(View v, int keyCode, KeyEvent event) {
                    if (keyCode == KeyEvent.KEYCODE_BACK
                            && event.getAction() == MotionEvent.ACTION_UP
                            && myWebView.canGoBack()) {
                        handler.sendEmptyMessage(1);
                        return true;
                    }
                    return false;
                }
            });
        }

        ((MainActivity) getActivity()).setActionBarTitle(title);

        return view;
    }

    private void webViewGoBack(){
        myWebView.goBack();
    }

}