//
//  FotoDenunciasMasterViewController.m
//  SiacGob
//
//  Created by DevCH on 12/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "FotoDenunciasMasterViewController.h"
#import "Singleton.h"
#import "HUD.h"
#import <QuartzCore/QuartzCore.h>

@interface FotoDenunciasMasterViewController (){
    int option ;
}

@end

@implementation FotoDenunciasMasterViewController
@synthesize lblArchivo,txtImage,txtDen,lblFec,S,ArchivoPlano;

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

    
    [self.ActPlay startAnimating];
    self.lblText.text = self.lblArchivo;
    
    self.txtDenuncia.layer.cornerRadius=8.0f;
    self.txtDenuncia.layer.masksToBounds=YES;
    self.txtDenuncia.backgroundColor=[UIColor lightGrayColor];
    self.txtDenuncia.layer.borderColor=[[UIColor blackColor]CGColor];
    self.txtDenuncia.layer.borderWidth= 1.0f;

    

}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

-(void)viewDidAppear:(BOOL)animated{
    
    [self.txtImage setImage:[UIImage imageWithData:[NSData dataWithContentsOfURL:[NSURL URLWithString:self.lblArchivo]]]];
    [self getImageData];


}

- (IBAction)DeleteItem:(id)sender {
    [self deleteData];
}

-(void)getImageData{
    
    option = 1;

    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
    [HUD showUIBlockingIndicatorWithText:@"Loading image data, please wait..."];
    
    
    NSMutableDictionary *postDix=[[NSMutableDictionary alloc] init];
    NSLog(@"Archivo Plano: %@",self.ArchivoPlano);
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",self.ArchivoPlano] forKey:@"imagen"];
    
    NSURL *url = [NSURL URLWithString:@"http://dc.tabascoweb.com/php/01/getiOSGetDataPhotoUser.php"];
    
    NSData *postData = [self generateFormDataFormPostDictionary:postDix];
    NSLog(@"Datos: %@",[[NSString alloc] initWithData:postData encoding:NSStringEncodingConversionExternalRepresentation]);
    
    // Create the request
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
    [request setHTTPMethod:@"POST"];
    [request setAllowsCellularAccess:YES];
    
    [request setCachePolicy:NSURLRequestUseProtocolCachePolicy];
    [request setTimeoutInterval:1200.0];
    [request setValue:[NSString stringWithFormat:@"%d", postData.length] forHTTPHeaderField:@"Content-Length"];
    [request setValue:@"application/x-www-form-urlencoded charset=utf-8" forHTTPHeaderField:@"Content-Type"];
    [request setHTTPBody:postData];
    
    NSURLConnection *connection = [[NSURLConnection alloc] initWithRequest:request  delegate:self startImmediately:NO];
    // [connection ]
    
    [connection start];
    


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
-(void)deleteData{
    
    option = 0;
    
    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
    [HUD showUIBlockingIndicatorWithText:@"Deleting data, please wait..."];
    
    
    NSMutableDictionary *postDix=[[NSMutableDictionary alloc] init];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",self.ArchivoPlano] forKey:@"imagen"];
    
    NSURL *url = [NSURL URLWithString:@"http://dc.tabascoweb.com/php/01/getiOSDeletePhotoUser.php"];
    
    NSData *postData = [self generateFormDataFormPostDictionary:postDix];
    NSLog(@"Datos: %@",[[NSString alloc] initWithData:postData encoding:NSStringEncodingConversionExternalRepresentation]);
    
    // Create the request
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
    [request setHTTPMethod:@"POST"];
    [request setAllowsCellularAccess:YES];
    
    [request setCachePolicy:NSURLRequestUseProtocolCachePolicy];
    [request setTimeoutInterval:1200.0];
    [request setValue:[NSString stringWithFormat:@"%d", postData.length] forHTTPHeaderField:@"Content-Length"];
    [request setValue:@"application/x-www-form-urlencoded charset=utf-8" forHTTPHeaderField:@"Content-Type"];
    [request setHTTPBody:postData];
    
    NSURLConnection *connection = [[NSURLConnection alloc] initWithRequest:request  delegate:self startImmediately:NO];
    // [connection ]
    
    [connection start];
    
    
}

- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
   // [receivedData_ setLength:0];
    
}

//Recibe de los datos después de guardar...
- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    switch (option) {
        case 0:{
            
            NSString *str0 = [[NSString alloc] initWithFormat: @"dispatch(%i,%i)",0, 0];
            [self.S.webView  stringByEvaluatingJavaScriptFromString:str0];
            
            [self dismissViewControllerAnimated:YES completion:nil];
            break;
        }
        case 1:{
            [self.ActPlay startAnimating];
            
            NSError *jsonError = nil;
            id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
            
            NSArray *jsonArray = (NSArray *)jsonObject;
            
            NSString *den = [[jsonArray objectAtIndex:0]objectForKey:@"denuncia"];
            NSString *fec = [[jsonArray objectAtIndex:0]objectForKey:@"creado_el"];
            [self.txtDenuncia setText:den];
            [self.lblFecha setText:[[NSString alloc] initWithFormat: @"%@ ",fec]];
            self.lblFecha.layer.borderWidth = 1;
            self.lblFecha.layer.borderColor = [[UIColor grayColor] CGColor];
            self.lblFecha.layer.cornerRadius = 3;
            [self.ActPlay stopAnimating];
            break;
        }
        default:
            break;
    }
}


- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    [HUD hideUIBlockingIndicator];
}




- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error{
    
    NSString *msg = [[NSString alloc] initWithFormat:@"Connection failed! Error - %@ %@",
                     [error localizedDescription],
                     [[error userInfo] objectForKey:NSURLErrorFailingURLStringErrorKey]];
    [self alertStatus:@"Error.." Mensaje:msg Button1:nil Button2:@"OK"];
    
}

-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2{
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:titulo
                                                    message:mensaje delegate:self cancelButtonTitle:btn1
                                          otherButtonTitles:btn2, nil];
    [alert show];
    
}


@end
