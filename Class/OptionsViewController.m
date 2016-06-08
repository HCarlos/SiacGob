//
//  OptionsViewController.m
//  SiacGob
//
//  Created by DevCH on 03/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "OptionsViewController.h"
#import "Singleton.h"

@interface OptionsViewController ()

@end

@implementation OptionsViewController
@synthesize S,cmdCloseSession,ActPub;

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
    //[self.Pub setDelegate:self];

    
    [self.ActPub startAnimating];

    [self setPub:_Pub];
    
    S = [Singleton sharedMySingleton ];
    
    //[S setPlist];

    [self Validate];
}



- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
    
}

-(void)viewDidAppear:(BOOL)animated{
    [self Validate];
    //NSLog(@"viewDidAppear");
}


-(void)viewWillAppear:(BOOL)animated{
    [super viewWillAppear:YES];
    [self Validate];
    //NSLog(@"viewWillAppear");

}

-(void)Validate{
    if([[S getUser] length]==0){
        
        [self.cmdCloseSession setHidden:YES];
        [self.cmdAlumbrado setHidden:YES];
        [self.cmdBaches setHidden:YES];
        [self.cmdBasura setHidden:YES];
        [self.cmdFugaDeAgua setHidden:YES];
        [self.cmdHundimiento setHidden:YES];
        
        
    }else{
        [self.cmdCloseSession setHidden:NO];
        [self.cmdAlumbrado setHidden:NO];
        [self.cmdBaches setHidden:NO];
        [self.cmdBasura setHidden:NO];
        [self.cmdFugaDeAgua setHidden:NO];
        [self.cmdHundimiento setHidden:NO];
        
        //[self.cmdBaches setTitle:@"Hola" forState:UIControlStateNormal];
        
    }
    
}



-(void)setPub:(UIWebView *)Pub{
    ////// SET PUB //////
    //Create a URL object.
    
    [Pub setDelegate:self];
    NSURL *url = [NSURL URLWithString:@"http://www.tabascoweb.com/images/web/pub.html"];
    
    //URL Requst Object
    NSURLRequest *request = [NSURLRequest requestWithURL:url];
    
    //Load the request in the UIWebView.
    [Pub loadRequest:request];
    
}

-(void)viewDidDisappear:(BOOL)animated{
//    NSLog(@"Desapareció");
}
- (IBAction)CloseSession:(id)sender {
    [S deleteUser];
    [self dismissViewControllerAnimated:YES completion:nil];
}




- (IBAction)Basura:(id)sender {
    [S setModulo:0];
}

- (IBAction)FugaDeAgua:(id)sender {
    [S setModulo:1];
}

- (IBAction)Baches:(id)sender {
    [S setModulo:2];
}

- (IBAction)Alumbrado:(id)sender {
    [S setModulo:3];
}

- (IBAction)cmdHundimiento:(id)sender {
    [S setModulo:4];
}


- (void)webView:(UIWebView *)webView didFailLoadWithError:(NSError *)error{
    [self.ActPub stopAnimating];
    NSLog(@"ERROR LOADING WEBPAGE: %@", error);
}
- (void) webViewDidFinishLoad:(UIWebView*)webView
{
    [self.ActPub stopAnimating];
   NSLog(@"finished");
}

@end
