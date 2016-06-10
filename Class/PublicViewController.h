//
//  BasuraViewController.h
//  SiacGob
//
//  Created by DevCH on 06/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <CoreLocation/CoreLocation.h>
#import <MapKit/MapKit.h>
#import "Singleton.h"
// #import "SocketIO.h"
#import "HUD.h"
#import <QuartzCore/QuartzCore.h>

@interface PublicViewController : UIViewController<UIPageViewControllerDelegate, UIImagePickerControllerDelegate, UINavigationControllerDelegate, NSURLConnectionDelegate, UIAlertViewDelegate, CLLocationManagerDelegate>

@property (strong, nonatomic) IBOutlet UITextView *txtDenuncia;
@property (strong, nonatomic) IBOutlet UILabel *lblTipoDenuncia;

@property (strong, nonatomic) IBOutlet UIButton *cmdCloseView;
@property (strong, nonatomic) IBOutlet UIButton *cmdPost;
@property (strong, nonatomic) IBOutlet UIImageView *Image;
@property (strong, nonatomic) IBOutlet UIProgressView *PBar;

@property (strong, nonatomic) CLLocationManager * manager;
@property (strong, nonatomic) CLLocation * location;

@property (nonatomic, copy) Singleton * loSelf;
@property (strong,nonatomic) Singleton *S;

-(BOOL)validPost;

- (IBAction)CloseView:(id)sender;
- (IBAction)camera:(id)sender;
- (IBAction)library:(id)sender;
//- (IBAction)PostMessage:(id)sender;
- (IBAction)PostMessage:(id)sender;

- (void)GetLocation;

@end
