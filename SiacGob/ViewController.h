//
//  ViewController.h
//  SiacGob
//
//  Created by DevCH on 03/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Singleton.h"

@interface ViewController : UIViewController<UIAlertViewDelegate>
@property (strong, nonatomic) IBOutlet UIButton *cmdLogin;
@property (strong, nonatomic) IBOutlet UIButton *cmdRegistry;
@property (strong, nonatomic) IBOutlet UILabel *lblBienvenido;
@property (strong, nonatomic) IBOutlet UILabel *lblEresNuevo;
@property (strong, nonatomic) IBOutlet UIButton *GotoTab;


@property (strong,nonatomic) Singleton *S;

@end
