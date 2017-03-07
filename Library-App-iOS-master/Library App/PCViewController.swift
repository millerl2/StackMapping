//
//  PCViewController.swift
//  Library App
//
//  Created by Brendan Wrafter on 10/17/16.
//  Copyright © 2016 Brendan Wrafter. All rights reserved.
//

import UIKit
import Foundation

class PCViewController: UIViewController, UICollectionViewDataSource, UICollectionViewDelegate {
    
    //todo grab count from json
    var PCStatus = [String?](repeating: nil, count:80)
    
    @IBOutlet weak var progressBar: UIProgressView!
    @IBOutlet weak var progressText: UILabel!
    override func viewDidLoad() {
        super.viewDidLoad()
        self.getJSON()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
    
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return PCStatus.count
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let cell: PCCollectionViewCell = collectionView.dequeueReusableCell(withReuseIdentifier: "PCcell", for: indexPath) as! PCCollectionViewCell
        cell.cellLabel.text = ("PC:\(indexPath.row+1)")
        if PCStatus[indexPath.row] == "available" {
            cell.backgroundColor = UIColor(red: 161/255.0, green: 177/255.0, blue: 34/255.0, alpha: 1.0)
        }
        else if PCStatus[indexPath.row] == "inUse" {
            cell.backgroundColor = UIColor.lightGray

        }
        else {
            cell.backgroundColor = UIColor.white
        }
        return cell
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        print("Cell \(indexPath) selected")
    }
    
    func getJSON() -> [JSON]{
        var jsonArr = [JSON]()
        if let path = URL(string: "https://library.newpaltz.edu/pctracker/counts/") {
            do {
                let datafull = try String(contentsOf: path, encoding: String.Encoding.utf8)
                
                let datafullarr = datafull.components(separatedBy: "var pcstatus =")
                
                var data1 = datafullarr[0]
                data1 = data1.replacingOccurrences(of: "var pcstatus =", with: "")
                data1 = data1.replacingOccurrences(of: "var pccounts =", with: "")
                data1 = data1.replacingOccurrences(of: "\\n", with: "")
                data1 = data1.replacingOccurrences(of: "\\", with: "")
                data1 = data1.replacingOccurrences(of: "[", with: "")
                data1 = data1.replacingOccurrences(of: "];", with: "")
                
                var data2 = datafullarr[1]
                data2 = data2.replacingOccurrences(of: "var pcstatus =", with: "")
                data2 = data2.replacingOccurrences(of: "var pccounts =", with: "")
                data2 = data2.replacingOccurrences(of: "\\n", with: "")
                data2 = data2.replacingOccurrences(of: "\\", with: "")
                data2 = data2.replacingOccurrences(of: "[", with: "")
                data2 = data2.replacingOccurrences(of: "];", with: "")
               
                
                var data = data1.data(using: .utf8)
                var jsonObj = JSON(data: data!)
                jsonArr.append(jsonObj)
                
                data = data2.data(using: .utf8)
                jsonObj = JSON(data: data!)
                jsonArr.append(jsonObj)
                
                
                setProgressBar(json: jsonArr[0])
                makePCArray(json: jsonArr[1])
                
                
                return jsonArr
                
            } catch let error {
                print(error.localizedDescription)
            }
        } else {
            print("Invalid filename/path.")
        }
        return [JSON.null]
    }
    
    func setProgressBar(json:JSON){
        let avail = json["pcsAvailable"]
        let total = json["pcsTotal"]
        let progress = Float(avail.float!/total.float!)
        progressBar.setProgress(progress, animated: false)
        progressText.text = ("\(avail) PCs Available out of \(total)" )
    }
    
    func makePCArray(json:JSON){
        for(key, subJson):(String, JSON) in json {
            PCStatus[Int(key)!-1] = subJson.string!
        }
    }
    


}
