//
//  LoginViewController.h
//  SiacGob
//
//  Created by DevCH on 06/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <CoreLocation/CoreLocation.h>
#import <MapKit/MapKit.h>
#import "Singleton.h"
#import "HUD.h"

@interface LoginViewController : UIViewController<NSURLConnectionDelegate, UIAlertViewDelegate, CLLocationManagerDelegate>
@property (strong, nonatomic) IBOutlet UITextField *txtUsername;

@property (strong, nonatomic) IBOutlet UITextField *txtPassword;

@property (strong, nonatomic) CLLocationManager * manager;
@property (nonatomic, copy) Singleton * loSelf;
@property (strong,nonatomic) Singleton *S;

- (IBAction)setLogin:(id)sender;
- (IBAction)CloseView:(id)sender;
- (IBAction)HideKeyBoard:(id)sender;

@end
