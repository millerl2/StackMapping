//
//  CatalogViewController.swift
//  Library App
//
//  Created by Brendan Wrafter on 10/16/16.
//  Copyright © 2016 Brendan Wrafter. All rights reserved.
//

import UIKit

class CatalogViewController: UIViewController {

    @IBOutlet var webView: UIWebView!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        let url = NSURL(string: "http://new.sunyconnect.suny.edu:4430/F?func=find-b-0&local_base=NEW01_MOBILE")!
        let request = NSURLRequest(url: url as URL)
        webView.loadRequest(request as URLRequest)
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }


}
