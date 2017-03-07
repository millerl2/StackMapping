//
//  InteractiveMapViewController.swift
//  Library App
//
//  Created by Brendan Wrafter on 11/18/16.
//  Copyright © 2016 Brendan Wrafter. All rights reserved.
//

import UIKit

class InteractiveMapViewConroller: UIViewController {
    
    @IBOutlet var webView: UIWebView!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        let url = NSURL(string: "http://library.newpaltz.edu/appmap")!
        let request = NSURLRequest(url: url as URL)
        webView.loadRequest(request as URLRequest)
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
}

