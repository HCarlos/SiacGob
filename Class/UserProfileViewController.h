//
//  UserProfileViewController.h
//  SiacGob
//
//  Created by Carlos Hidalgo on 25/08/16.
//  Copyright © 2016 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Singleton.h"
#import "HUD.h"

@interface UserProfileViewController : UIViewController<NSURLConnectionDelegate, UIAlertViewDelegate>
@property (weak, nonatomic) IBOutlet UITextField *txtNumeroCelular;
@property (weak, nonatomic) IBOutlet UITextField *txtFullName;
@property (weak, nonatomic) IBOutlet UITextField *txtDomicilio;
@property (weak, nonatomic) IBOutlet UIButton *cmdSaveInfo;

@property (strong,nonatomic) Singleton *S;

- (void)HideKeyBoard;
- (void)updateDataUser;

- (IBAction)cmdSaveData:(id)sender;


@end
