//
//  UserProfileViewController.h
//  SiacGob
//
//  Created by Carlos Hidalgo on 25/08/16.
//  Copyright © 2016 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface UserProfileViewController : UIViewController
@property (weak, nonatomic) IBOutlet UITextField *txtNumeroCelular;
@property (weak, nonatomic) IBOutlet UIButton *cmdSaveInfo;

- (void)HideKeyBoard;

@end
