//
//  RegistryViewController.m
//  SiacGob
//
//  Created by DevCH on 05/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "RegistryViewController.h"
#import <CoreLocation/CoreLocation.h>
#import <MapKit/MapKit.h>
#import "Singleton.h"
#import "HUD.h"

@interface RegistryViewController (){
    NSMutableData *receivedData_;
}


@end

@implementation RegistryViewController
@synthesize S,manager,loSelf;

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

    self.manager = [[CLLocationManager alloc] init];
    manager.distanceFilter = 1;
    manager.desiredAccuracy = kCLLocationAccuracyBest;
    manager.delegate = self;
    
    [manager startUpdatingLocation];
    
    
    self.S  = [Singleton sharedMySingleton];
    
    UIToolbar *toolbar = [[UIToolbar alloc] init];
    [toolbar setBarStyle:UIBarStyleBlack];
    [toolbar sizeToFit];
    
    
    UIBarButtonItem *space = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemFlexibleSpace target:nil action:nil];
    
    UIBarButtonItem *closebuttom = [[UIBarButtonItem alloc] initWithTitle:@"Ocultar" style:UIBarButtonItemStyleDone target:self action:@selector(HideKeyBoard)];
    
    
    [toolbar setItems:[NSArray arrayWithObjects:space,closebuttom, nil]];
    
    [[self txtUsername]setInputAccessoryView:toolbar];
    [[self txtUsername2]setInputAccessoryView:toolbar];
    [[self txtPassword1]setInputAccessoryView:toolbar];
    [[self txtPassword2]setInputAccessoryView:toolbar];
    

}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (IBAction)setRegistry:(id)sender {
    if ([self.S validateEmail:self.txtUsername.text]){
        if ([self.txtUsername.text isEqualToString:self.txtUsername2.text]){
            NSInteger pl1 = [self.txtPassword1.text length];
            NSInteger pl2 = [self.txtPassword2.text length];
        
            if ([self.txtPassword1.text isEqualToString:self.txtPassword2.text] ){
                if ((pl1 > 3 && pl1 <= 13) && (pl2 > 3 && pl2 <= 13)){
                    [self Registry];

                }else{
                    [self alertStatus:@"Error" Mensaje:@"Su password debe tener una longitud entre 4 y 14 caracteres..." Button1:nil Button2:@"OK"];
                }
            }else{
                [self alertStatus:@"Error" Mensaje:@"No coinciden los passwords..." Button1:nil Button2:@"OK"];
            }
        }else{
            [self alertStatus:@"Error" Mensaje:@"Los correos no coinciden" Button1:nil Button2:@"OK"];
        }
    }else{
        [self alertStatus:@"Error" Mensaje:@"Correo NO Válido" Button1:nil Button2:@"OK"];
    }
    
    
}

- (IBAction)CloseView:(id)sender {
    [self dismissViewControllerAnimated:YES completion:nil];
}

-(void)HideKeyBoard{
    if ([self.view endEditing:NO]) {
        [self.view endEditing:YES ];
    } else {
        [self.view endEditing:NO];
    }
    
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


-(void)Registry{
    
    //Create String
    
    //Singleton *S = [Singleton sharedMySingleton];
    NSString *x = self.txtUsername.text;
    NSString *y = self.txtPassword1.text;
    NSString *name = [self.S getDeviceData:0];
    NSString *phone = [self.S getDeviceData:1];
    NSString *iD = [self.S getDeviceData:2];
    NSString *la = [[NSString alloc] initWithFormat:@"%f", self.S.loSelf.coordinate.latitude];
    NSString *lo = [[NSString alloc] initWithFormat:@"%f", self.S.loSelf.coordinate.longitude];
    
    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
    [HUD showUIBlockingIndicatorWithText:@"Saving data"];
    
    NSMutableDictionary *postDix=[[NSMutableDictionary alloc] init];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",x] forKey:@"username"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",y] forKey:@"password"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",name] forKey:@"nombre"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",phone] forKey:@"celular"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",iD] forKey:@"idF"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",la] forKey:@"latitud"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",lo] forKey:@"longitud"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",x] forKey:@"message"];
   
    NSURL *url = [NSURL URLWithString:@"http://siac.tabascoweb.com/php/01/setiOSRegistry.php"];
    
    NSData *postData = [self generateFormDataFormPostDictionary:postDix];
    
    // Create the request
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
    [request setHTTPMethod:@"POST"];
    [request setValue:[NSString stringWithFormat:@"%lu", (unsigned long)postData.length] forHTTPHeaderField:@"Content-Length"];
    [request setValue:@"application/x-www-form-urlencoded charset=utf-8" forHTTPHeaderField:@"Content-Type"];
    [request setHTTPBody:postData];
    
    NSURLConnection *connection = [[NSURLConnection alloc] initWithRequest:request
                                                                  delegate:self];
    [connection start];
}

- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    [receivedData_ setLength:0];
}

//Recibe de los datos después de guardar...
- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data {
    [receivedData_ appendData:data];
    
    NSError *jsonError = nil;
    id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
    
    if ([jsonObject isKindOfClass:[NSArray class]]) {
        NSArray *jsonArray = (NSArray *)jsonObject;
        //NSLog(@"jsonArray - %@",jsonArray);
        NSLog(@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]);
        NSString *msg = [[NSString alloc] initWithFormat:@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]] ;
        if ([msg isEqualToString:@"OK"]){
            //[self alertStatus:@"Congratulation" Mensaje:@"Registry correct..." Button1:nil Button2:@"OK"];
            [self dismissViewControllerAnimated:YES completion:nil];
        }else{
            [self alertStatus:@"Error" Mensaje:msg Button1:nil Button2:@"OK"];
        }
    }
    else {
        //NSDictionary *jsonDictionary = (NSDictionary *)jsonObject;
        //NSLog(@"jsonDictionary - %@",jsonDictionary);
    }
    
    
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    [HUD hideUIBlockingIndicator];
}

- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error{
    
    [connection finalize];
    
    NSString *msg = [[NSString alloc] initWithFormat:@"Connection failed! Error - %@ %@",
                     [error localizedDescription],
                     [[error userInfo] objectForKey:NSURLErrorFailingURLStringErrorKey]];
    [self alertStatus:@"Error" Mensaje:msg Button1:nil Button2:@"OK"];
    
}

-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2{
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:titulo
                                                    message:mensaje delegate:self cancelButtonTitle:btn1
                                          otherButtonTitles:btn2, nil];
    [alert show];
    
}

-(void)locationManager:(CLLocationManager *)manager didFailWithError:(NSError *)error{
    //Algo
}
-(void)locationManager:(CLLocationManager *)manager didUpdateToLocation:(CLLocation *)newLocation fromLocation:(CLLocation *)oldLocation{
    
    
    
    self.S.loSelf = newLocation;
    
    MKCoordinateRegion region;
    
    region.center.latitude = newLocation.coordinate.latitude;
    region.center.longitude = newLocation.coordinate.longitude;
    
    region.span.latitudeDelta = 0.01;
    region.span.longitudeDelta = 0.01;
    
    
    
    
}



@end
