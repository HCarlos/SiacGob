//
//  OptionsViewController.h
//  SiacGob
//
//  Created by DevCH on 03/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Singleton.h"

@interface OptionsViewController : UIViewController<UIAlertViewDelegate,UIWebViewDelegate>
@property (strong, nonatomic) IBOutlet UIWebView *Pub;
@property (strong, nonatomic) IBOutlet UIButton *cmdCloseSession;
@property (strong, nonatomic) IBOutlet UIButton *cmdBasura;
@property (strong, nonatomic) IBOutlet UIButton *cmdFugaDeAgua;
@property (strong, nonatomic) IBOutlet UIButton *cmdBaches;
@property (strong, nonatomic) IBOutlet UIButton *cmdAlumbrado;
@property (strong, nonatomic) IBOutlet UIButton *cmdHundimiento;
@property (strong, nonatomic) IBOutlet UIActivityIndicatorView *ActPub;

- (IBAction)Alumbrado:(id)sender;
- (IBAction)Baches:(id)sender;
- (IBAction)Basura:(id)sender;
- (IBAction)FugaDeAgua:(id)sender;
- (IBAction)cmdHundimiento:(id)sender;

@property (strong,nonatomic) Singleton *S;
- (IBAction)CloseSession:(id)sender;

@end
