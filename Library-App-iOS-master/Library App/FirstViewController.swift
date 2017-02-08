//
//  FirstViewController.swift
//  Library App
//
//  Created by Brendan Wrafter on 10/16/16.
//  Copyright © 2016 Brendan Wrafter. All rights reserved.
//

import UIKit

class FirstViewController: UIViewController {

    @IBOutlet weak var fb: UIImageView!
    @IBOutlet weak var twitter: UIImageView!
    
    @IBOutlet weak var typeLabel: UILabel!
    @IBOutlet weak var todayLabel: UILabel!
    @IBOutlet weak var openLabel: UILabel!
    @IBOutlet weak var lateRoomLabel: UILabel!
    @IBOutlet weak var weekLabel: UILabel!
    @IBOutlet weak var week2Label: UILabel!
    @IBOutlet weak var week3Label: UILabel!
    @IBOutlet weak var week5Label: UILabel!
    @IBOutlet weak var week4Label: UILabel!
    @IBOutlet weak var week6Label: UILabel!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        let fbImage = fb
        let tapFb = UITapGestureRecognizer(target: self, action: #selector(fbTapped(img:)))
        fbImage?.isUserInteractionEnabled = true
        fb.addGestureRecognizer(tapFb)
        
        let twitterImage = twitter
        let tapTwitter = UITapGestureRecognizer(target: self, action: #selector(twitterTapped(img:)))
        twitterImage?.isUserInteractionEnabled = true
        twitter.addGestureRecognizer(tapTwitter)
        
        getHours()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
    
    func fbTapped(img: AnyObject) {
        print("Facebook")
        SocialNetwork.Facebook.openPage()
    }
    
    func twitterTapped(img: AnyObject) {
        print("Twitter")
        SocialNetwork.Twitter.openPage()
    }
    
    struct SocialNetworkUrl {
        let scheme: String
        let page: String
        
        func openPage() {
            let schemeUrl = NSURL(string: scheme)!
            if UIApplication.shared.canOpenURL(schemeUrl as URL) {
                UIApplication.shared.openURL(schemeUrl as URL)
            } else {
                UIApplication.shared.openURL(NSURL(string: page)! as URL)
            }
        }
    }
    
    enum SocialNetwork {
        //TODO use real urls
        //TODO check default case
        case Facebook, GooglePlus, Twitter, Instagram
        func url() -> SocialNetworkUrl {
            switch self {
            case .Facebook: return SocialNetworkUrl(scheme: "fb://profile/PageId", page: "https://www.facebook.com/PageName")
            case .Twitter: return SocialNetworkUrl(scheme: "twitter:///user?screen_name=USERNAME", page: "https://twitter.com/USERNAME")
            default: return SocialNetworkUrl(scheme: "", page: "")
            }
        }
        func openPage() {
            self.url().openPage()
        }
    }
    

    
    func getHours(){
        if let path = URL(string: "http://library.newpaltz.edu/LibraryHoursTable.txt") {
            do {
                let datafull = try String(contentsOf: path, encoding: String.Encoding.utf8)
                let dataArray = datafull.components(separatedBy: "\n")
                let date = Date()
                let dateFormatter = DateFormatter()
                dateFormatter.dateFormat = "M/d/yyyy"
                let stringDate = dateFormatter.string(from: date)
                
                var weekArray = [String](repeating:"", count:7)
                
                print(stringDate);
                
                for i in 1 ..< dataArray.count {
                    if(dataArray[i].contains(stringDate)){
                        for j in i ..< i+7 {
                            weekArray[j-i] = dataArray[j]
                        }
                        break;
                    }
                }
                print(weekArray[0])
                formatDays(s: weekArray)
            
                
            } catch let error {
                print(error.localizedDescription)
            }
        } else {
            print("Invalid filename/path.")
        }
       
    }
    
    func formatDays(s: [String]){
        
        var today = s[0].components(separatedBy: "\t")
        let type = today[2] + ":"
        var dayOfWeek = today[3]
        
        var todayDateArray = today[1].components(separatedBy: "/")
        var todayDate = todayDateArray[0] + "/" + todayDateArray[1]
        
        var todayHours = "\nToday, " + dayOfWeek + " (" + todayDate + ")"
        
        if(today[4] != "Closed\r"){
            todayHours = todayHours + "\nOpen " + today[4] + " - " + today[5]
        }
        else {
            todayHours = todayHours + "\nClosed"
        }
        
        if(today[8] != "Closed\r"){
            todayHours = todayHours + "\nLate Room 12am - " + today[8]
        }
        else {
            todayHours = todayHours + "\nLate Room Closed"
        }
        
        var weekHours = String()
        let todayHoursArr = todayHours.components(separatedBy: "\n")
        
        
        for i in 1 ..< s.count {
            today = s[i].components(separatedBy: "\t")
            dayOfWeek = aprevDay(day: today[3])
            todayDateArray = today[1].components(separatedBy: "/")
            todayDate = todayDateArray[0] + "/" + todayDateArray[1]
            if(today[4] != "Closed") {
                weekHours = weekHours + dayOfWeek + " (" + todayDate + "): " + today[4] + " - " + today[5] + "\n"
            }
            else {
                weekHours = weekHours + dayOfWeek + " (" + todayDate + "): Closed\n"
            }
            
        }
        
        
        let weekHoursArr = weekHours.components(separatedBy: "\n")
        
        typeLabel.text = type
        todayLabel.text = todayHoursArr[1]
        openLabel.text = todayHoursArr[2]
        lateRoomLabel.text = todayHoursArr[3]
        
        weekLabel.text = weekHoursArr[0]
        week2Label.text = weekHoursArr[1]
        week3Label.text = weekHoursArr[2]
        week4Label.text = weekHoursArr[3]
        week5Label.text = weekHoursArr[4]
        week6Label.text = weekHoursArr[5]

        
    }
    
    func setLables(){

    }
    
    
    func aprevDay(day: String) -> String {
        switch day {
        case "Sunday" :
            return "Sun."
        case "Monday" :
            return "Mon."
        case "Tuesday" :
            return "Tue."
        case "Wednesday" :
            return "Wed."
        case "Thursday" :
            return "Thu."
        case "Friday" :
            return "Fri."
        case "Saturday" :
            return "Sat."
        default:
            return ""
        }
    }


}

