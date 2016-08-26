//
//  RegistryViewController.h
//  SiacGob
//
//  Created by DevCH on 05/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <CoreLocation/CoreLocation.h>
#import <MapKit/MapKit.h>
#import "Singleton.h"
#import "HUD.h"
#import <FBSDKLoginKit/FBSDKLoginKit.h>

@interface RegistryViewController : UIViewController<NSURLConnectionDelegate, UIAlertViewDelegate, CLLocationManagerDelegate, FBSDKLoginButtonDelegate>
@property (strong, nonatomic) IBOutlet UITextField *txtUsername;

@property (strong, nonatomic) IBOutlet UITextField *txtUsername2;

@property (strong, nonatomic) IBOutlet UITextField *txtPassword1;

@property (strong, nonatomic) IBOutlet UITextField *txtPassword2;
@property (weak, nonatomic) IBOutlet UITextField *txtCelular;
@property (weak, nonatomic) IBOutlet FBSDKLoginButton *loginButton;
@property (weak, nonatomic) IBOutlet FBSDKLoginButton *FacebookButton;

@property (strong, nonatomic) IBOutlet UIButton *cmdRegistry;
@property (strong, nonatomic) IBOutlet UILabel *lblError;
@property (strong, nonatomic) CLLocationManager * manager;
@property (nonatomic, copy) Singleton * loSelf;

@property (strong,nonatomic) Singleton *S;
- (IBAction)setRegistry:(id)sender;
- (IBAction)CloseView:(id)sender;
- (void)HideKeyBoard;

@end
