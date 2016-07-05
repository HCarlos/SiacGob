//
//  ViewController.m
//  SiacGob
//
//  Created by DevCH on 03/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "ViewController.h"
#import "Singleton.h"


@interface ViewController ()

@end

@implementation ViewController
@synthesize S,GotoTab;

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
    
    [GotoTab setHidden:YES];
    
    S = [Singleton sharedMySingleton ];
    
    [S setPlist];
    
}


- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
    
}

-(void)viewDidAppear:(BOOL)animated{
    [self Validate];
    //NSLog(@"viewDidAppear 1");
}


-(void)viewWillAppear:(BOOL)animated{
    [super viewWillAppear:YES];
    [self Validate];
    //NSLog(@"viewWillAppear 2");

}

-(void)Validate{
    if([[S getUser] length]==0){
        
        [self.cmdLogin setHidden:NO];
        [self.cmdRegistry setHidden:NO];
        [self.lblBienvenido setHidden:NO];
        [self.lblEresNuevo setHidden:NO];

    }else{
        [self.cmdLogin setHidden:YES];
        [self.cmdRegistry setHidden:YES];
        [self.lblBienvenido setHidden:YES];
        [self.lblEresNuevo setHidden:YES];

        [self performSegueWithIdentifier: @"Tab" sender: self];
        
        //NSLog(@"Logeado");
        
        
    }
    
}

-(void)viewDidDisappear:(BOOL)animated{
//    NSLog(@"Desapareció");
}


@end
