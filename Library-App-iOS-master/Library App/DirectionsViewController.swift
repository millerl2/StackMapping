//
//  DirectionsViewController.swift
//  Library App
//
//  Created by Brendan Wrafter on 12/6/16.
//  Copyright © 2016 Brendan Wrafter. All rights reserved.
//

import UIKit
import MapKit
import AddressBook

class DirectionsViewController: UIViewController {
    
    @IBOutlet var mapView: MKMapView!
    override func viewDidLoad() {
        super.viewDidLoad()
        
        let initialLocation = CLLocation(latitude: 41.740363, longitude: -74.082005)
        centerMapOnLocation(location: initialLocation)
        
        mapView.delegate = self
        let landmark = Landmark(title: "Sojourner Truth Library",
                              locationName: "SUNY New Paltz",
                              discipline: "Library",
                              coordinate: CLLocationCoordinate2D(latitude: 41.741861, longitude: -74.084772)
)
        mapView.addAnnotation(landmark)
    }
    
    
    let regionRadius: CLLocationDistance = 300
    func centerMapOnLocation(location: CLLocation) {
        let coordinateRegion = MKCoordinateRegionMakeWithDistance(location.coordinate,
                                                                  regionRadius * 2.0, regionRadius * 2.0)
        mapView.setRegion(coordinateRegion, animated: true)
    }
    
    
    
    

}
