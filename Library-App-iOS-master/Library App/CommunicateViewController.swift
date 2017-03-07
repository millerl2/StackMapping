//
//  CommunicateViewController.swift
//  Library App
//
//  Created by Brendan Wrafter on 10/25/16.
//  Copyright © 2016 Brendan Wrafter. All rights reserved.
//

import UIKit
import MessageUI

class CommunicateViewController: UIViewController, UITableViewDataSource, UITableViewDelegate, MFMessageComposeViewControllerDelegate {


    let section:[String] = ["Communicate", "Department Phone Numbers"]
    let items = [["Send Text"], ["Circulation Desk", "Collections Dept","Director's Office", "Interlibrary Loans", "Information/Hours", "Library Instruction", "Records Dept", "Research Desk"]]
    let telNumbers = ["8452573714","8452573731","8452573719","8452573680","8452573700","8452573706","8452573662","8452573710"]
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "communicate_cell", for: indexPath)
        
        //communicate
        if indexPath.section == 0 {
            cell.textLabel?.text = self.items[indexPath.section][indexPath.row]

        
            var image = UIImage()
                if indexPath.row == 0 {
                    image = UIImage(named: "ic_textsms")!
                }
        
            cell.imageView?.image = image
        }
        //phone numbers
        else {
            cell.textLabel?.text = self.items[indexPath.section][indexPath.row]
        }

        return cell
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        if section == 0 {
            return items[0].count
        }
        else {
            return items[1].count
        }
        
 
    }
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return self.section.count
    }
    
    func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        return self.section[section]
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        print("selected \(indexPath.section) section and \(indexPath.row) row")
        //communicate
        if indexPath.section == 0 {
            if indexPath.row == 0 {

                if MFMessageComposeViewController.canSendText() == false {
                    print("Cannot send text")
                    return
                }
                
                let composeVC = MFMessageComposeViewController()
                composeVC.messageComposeDelegate = self
                
                // Configure the fields of the interface.
                composeVC.recipients = ["8452622011"]
                composeVC.body = "Hello!"
                
                // Present the view controller modally.
                self.present(composeVC, animated: true, completion: nil)
                
            }
            
        }
        //phone numbers 
        else{
            let tel:String = "tel://(" + telNumbers[indexPath.row] + ")"
            if let url = NSURL(string:tel), UIApplication.shared.canOpenURL(url as URL) {
                UIApplication.shared.open(url as URL)
            }
        }
        
    }
    
    func messageComposeViewController(_ controller: MFMessageComposeViewController,
                                      didFinishWith result: MessageComposeResult) {
        controller.dismiss(animated: true, completion: nil)
    }
    
    

    


    
    

    

}
