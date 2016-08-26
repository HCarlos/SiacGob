//
//  UserProfileViewController.m
//  SiacGob
//
//  Created by Carlos Hidalgo on 25/08/16.
//  Copyright © 2016 DevCH. All rights reserved.
//

#import "UserProfileViewController.h"

@interface UserProfileViewController (){
    NSMutableData *receivedData_;
}

@end

@implementation UserProfileViewController

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    UIToolbar *toolbar = [[UIToolbar alloc] init];
    [toolbar setBarStyle:UIBarStyleBlack];
    [toolbar sizeToFit];
    
    UIBarButtonItem *space = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemFlexibleSpace target:nil action:nil];
    
    UIBarButtonItem *closebuttom = [[UIBarButtonItem alloc] initWithTitle:@"Ocultar" style:UIBarButtonItemStyleDone target:self action:@selector(HideKeyBoard)];
    
    [toolbar setItems:[NSArray arrayWithObjects:space,closebuttom, nil]];
    
    [[self txtNumeroCelular]setInputAccessoryView:toolbar];
    
    [self.txtNumeroCelular becomeFirstResponder];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

-(void)HideKeyBoard{
    if ([self.view endEditing:NO]) {
        [self.view endEditing:YES ];
    } else {
        [self.view endEditing:NO];
    }
    
}

@end
