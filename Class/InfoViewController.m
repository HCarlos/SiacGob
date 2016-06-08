//
//  InfoViewController.m
//  SiacGob
//
//  Created by DevCH on 07/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "InfoViewController.h"
#import "Singleton.h"

@interface InfoViewController ()

@end

@implementation InfoViewController
@synthesize S;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view.
    self.S  = [Singleton sharedMySingleton];
    self.lblUsername.text = [S getUser];

}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)CloseWindow:(id)sender {
    [self dismissViewControllerAnimated:YES completion:nil];
}

- (IBAction)refreshConnectInternet:(id)sender {
    self.S.IdIO = 1;
    [self.S.webView loadRequest:[NSURLRequest requestWithURL:[NSURL URLWithString:@"http://www.tabascoweb.com/images/web/stream.php"]]];
}

/*
- (IBAction)openBrowser:(id)sender {
	[[UIApplication sharedApplication] openURL:[NSURL URLWithString:@"http://siac.tabascoweb.com/"]];	
}
 */



@end
