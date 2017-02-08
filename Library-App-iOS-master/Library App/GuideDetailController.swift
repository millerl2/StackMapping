//
//  GuideDetailController.swift
//  Library App
//
//  Created by Brendan Wrafter on 10/17/16.
//  Copyright © 2016 Brendan Wrafter. All rights reserved.
//

import UIKit

class GuideDetailController: UIViewController {
    
    var text:String = ""
    var contentFull:String = ""
    @IBOutlet weak var label: UILabel!
    @IBOutlet weak var content: UITextView!

    override func viewDidLoad() {
        super.viewDidLoad()
        label.text = text
        content.text = contentFull
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
    
    

}
