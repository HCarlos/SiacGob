//
//  TabBarController.m
//  SiacGob
//
//  Created by DevCH on 10/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "TabBarController.h"
#import "OptionsViewController.h"

@interface TabBarController ()

@end

@implementation TabBarController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        //OptionsViewController *vc = [[OptionsViewController alloc] initWithNibName:@"OptionsViewController" bundle:nil];
        //[self dismissViewControllerAnimated:YES completion:nil];
        //[self initWithNibName:vc bundle:nil ];
        
        NSLog(@"Intro");
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view.
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
