//
//  imageViewController.m
//  SiacGob
//
//  Created by DevCH on 11/03/14.
//  Copyright (c) 2014 DevCH. All rights reserved.
//

#import "imageViewController.h"
#import <MessageUI/MessageUI.h>
#import "HUD.h"
#import "Singleton.h"
#import <QuartzCore/QuartzCore.h>

@interface imageViewController (){
	NSMutableData *receivedData;
	NSMutableArray *datos;
	BOOL inicio;
	NSUInteger indice;
	int intentos;
	BOOL isInternet;
	NSString *username;
	NSString *strPath;
	NSMutableArray *colors;	
}

@end

@implementation imageViewController
@synthesize datos,iddenuncia,ActPlay;

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
	// Do any additional setup after loading the ew.
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)btnRegresar:(id)sender {
}

-(NSData*)generateFormDataFormPostDictionary:(NSDictionary*)dictionary{
    NSMutableArray *parts = [[NSMutableArray alloc] init];
    for (NSString *key in dictionary) {
        NSString *encodedValue = [[dictionary objectForKey:key] stringByAddingPercentEscapesUsingEncoding:NSUTF8StringEncoding];
        NSString *encodedKey = [key stringByAddingPercentEscapesUsingEncoding:NSUTF8StringEncoding];
        NSString *part = [NSString stringWithFormat: @"%@=%@", encodedKey, encodedValue];
        [parts addObject:part];
    }
    NSString *encodedDictionary = [parts componentsJoinedByString:@"&"];
    return [encodedDictionary dataUsingEncoding:NSUTF8StringEncoding];
    
}


#pragma mark - Data Source
-(void)getData{
    
	@try
	{
		
		//[self.canvas setAlpha:0.2];
		[self setDatos:nil];
		
		[UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
		[HUD showUIBlockingIndicatorWithText:@"Loading images, please wait..."];
		
		NSMutableDictionary *postDix=[[NSMutableDictionary alloc] init];
		
		[postDix setObject:[[NSString alloc] initWithFormat: @"%i",self.S.limFrom] forKey:@"pagina"];
		[postDix setObject:[[NSString alloc] initWithFormat: @"%i",self.S.limCant] forKey:@"cantidad"];
		
		//Set database address
		NSMutableString *databaseURL = [[NSMutableString alloc] initWithString:@"http://siac.tabascoweb.com/php/01/getiOSGetPhotosAll.php"]; // address not real jsut example
		
		NSData *postData = [self generateFormDataFormPostDictionary:postDix];
		
		//prepare NSURL with newly created string
		NSURL *url = [NSURL URLWithString:databaseURL];
		
		//AsynchronousRequest to grab the data
		//NSURLRequest *request = [NSMutableURLRequest requestWithURL:url];
		NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
		
		[request setHTTPMethod:@"POST"];
		//[request setAllowsCellularAccess:YES];
		
		
		//[request setCachePolicy:NSURLRequestReloadIgnoringLocalAndRemoteCacheData];
		//[request setTimeoutInterval:10.0];
		[request setValue:[NSString stringWithFormat:@"%lu", (unsigned long)postData.length] forHTTPHeaderField:@"Content-Length"];
		[request setValue:@"application/x-www-form-urlencoded charset=utf-8" forHTTPHeaderField:@"Content-Type"];
		[request setHTTPBody:postData];
		
		//NSURLConnection *connection = [[NSURLConnection alloc] initWithRequest:request  delegate:self startImmediately:NO];
		//[connection start];
		
		
		NSOperationQueue *queue = [[NSOperationQueue alloc] init];
		[NSURLConnection sendAsynchronousRequest:request queue:queue  completionHandler:^(NSURLResponse *response, NSData *data, NSError *error)
		 {
			 if ([data length] > 0 && error == nil){
				 
				 [queue cancelAllOperations];
				 [queue setSuspended:YES];
				 
				 //[request cancel];
				 
				 
				 NSError *jsonError;
				 jsonError = nil;
				 id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
				 
				 
				 NSMutableArray *jsonArray;
				 jsonArray = (NSMutableArray *)jsonObject;
				 
				 self.datos = jsonArray;
				 
				 //[self.canvas setDelegate:self];
				 //[self.canvas setDataSource:self];
				 
				 //[self.canvas reloadData];
				 
				 [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
				 [HUD hideUIBlockingIndicator];
				 
				 //[self.canvas setAlpha:1.0];
				 
				 
				 NSLog(@"Total de Registros: %d ",(unsigned int)[self.datos count]);
				 
				 
			 }else if ([data length] == 0 && error == nil){
				 //[self setDatos:nil];
				 NSLog(@"vacio");
			 }else if (error != nil && error.code == NSURLErrorTimedOut){ //used this NSURLErrorTimedOut from foundation error responses
				 //[self timedOut];
				 NSLog(@"tiempo terminado");
			 }else if (error != nil){
				 // [self downloadError:error];
				 NSLog(@"errror");
			 }
			 
			 //[receivedData appendData:data];
			 //[queue cancelAllOperations];
			 
		 }];
		
	}
	@catch (NSException *theException)
	{
		NSLog(@"Get Data Exception: %@", theException);
	}
	
}


@end
