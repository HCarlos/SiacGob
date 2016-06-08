//
//  InfoViewController.h
//  SiacGob
//
//  Created by DevCH on 07/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Singleton.h"

@interface InfoViewController : UIViewController<UIAlertViewDelegate>

@property (strong, nonatomic) IBOutlet UILabel *lblUsername;
@property (strong,nonatomic) Singleton *S;

- (IBAction)CloseWindow:(id)sender;
- (IBAction)refreshConnectInternet:(id)sender;
//- (IBAction)openBrowser:(id)sender;

@end
