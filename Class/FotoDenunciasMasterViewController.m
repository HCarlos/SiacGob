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
    /*
    self.txtDenuncia.layer.cornerRadius=8.0f;
    self.txtDenuncia.layer.masksToBounds=YES;
    self.txtDenuncia.backgroundColor=[UIColor lightGrayColor];
    self.txtDenuncia.layer.borderColor=[[UIColor blackColor]CGColor];
    self.txtDenuncia.layer.borderWidth= 1.0f;
	 */
    

}

- (void)didReceiveMemoryWarning
{
	NSLog(@"Foto en %s", __func__);
    [super didReceiveMemoryWarning];
	if (self.isViewLoaded && !self.view.window) {
        self.view = nil;
    }
}

-(void)viewDidAppear:(BOOL)animated{

	NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory,
														 NSUserDomainMask, YES);
	NSString *documentsDirectory = [paths objectAtIndex:0];
	NSString* path = [documentsDirectory stringByAppendingPathComponent:self.ArchivoPlano ];
    
    NSLog(@"PATH: %@",path);
    
	[self.txtImage setImage: [UIImage imageWithContentsOfFile:path]];
    
    //[self.txtImage setImage:[UIImage imageWithData:[NSData dataWithContentsOfURL:[NSURL URLWithString:self.lblArchivo]]]];
    [self getImageData];


}

- (IBAction)DeleteItem:(id)sender {
    // [self deleteData];

    [self alertStatus:@"Atención" Mensaje:@"Desea eliminar esta imagen de tu dispositivo?" Button1:@"No" Button2:@"Si"];
    
}

-(void)getImageData{
    
    option = 1;

    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
    [HUD showUIBlockingIndicatorWithText:@"Loading image data, please wait..."];
    
    
    NSMutableDictionary *postDix=[[NSMutableDictionary alloc] init];
    NSLog(@"Archivo Plano: %@",self.ArchivoPlano);
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",self.ArchivoPlano] forKey:@"imagen"];
    
    NSURL *url = [NSURL URLWithString:@"http://siac.tabascoweb.com/php/01/getiOSGetDataPhotoUser.php"];
    
    NSData *postData = [self generateFormDataFormPostDictionary:postDix];
    // NSLog(@"Datos: %@",[[NSString alloc] initWithData:postData encoding:NSStringEncodingConversionExternalRepresentation]);
    
    // Create the request
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
    [request setHTTPMethod:@"POST"];
    //[request setAllowsCellularAccess:YES];
    
    //[request setCachePolicy:NSURLRequestUseProtocolCachePolicy];
    //[request setTimeoutInterval:1200.0];
    [request setValue:[NSString stringWithFormat:@"%lu", (unsigned long)postData.length] forHTTPHeaderField:@"Content-Length"];
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
    
    NSURL *url = [NSURL URLWithString:@"http://siac.tabascoweb.com/php/01/getiOSDeletePhotoUser.php"];
    
    NSData *postData = [self generateFormDataFormPostDictionary:postDix];
    // NSLog(@"Datos: %@",[[NSString alloc] initWithData:postData encoding:NSStringEncodingConversionExternalRepresentation]);
    
    // Create the request
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
    [request setHTTPMethod:@"POST"];
    [request setAllowsCellularAccess:YES];
    
    [request setCachePolicy:NSURLRequestUseProtocolCachePolicy];
    [request setTimeoutInterval:1200.0];
    [request setValue:[NSString stringWithFormat:@"%lu", (unsigned long)postData.length] forHTTPHeaderField:@"Content-Length"];
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
            self.S.IsDelete = YES;
			[self.navigationController popViewControllerAnimated:YES];
			
            break;
        }
        case 1:{
            [self.ActPlay startAnimating];
            
            NSError *jsonError = nil;
            id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
            
            NSArray *jsonArray = (NSArray *)jsonObject;
            
            NSString *den = [[jsonArray objectAtIndex:0]objectForKey:@"denuncia"];
            NSString *fec = [[jsonArray objectAtIndex:0]objectForKey:@"creado_el"];
            NSString *dm  = [[jsonArray objectAtIndex:0]objectForKey:@"domicilio"];
            NSString *lat  = [[jsonArray objectAtIndex:0]objectForKey:@"latitud"];
            NSString *lon  = [[jsonArray objectAtIndex:0]objectForKey:@"longitud"];
            NSString *meg  = [[jsonArray objectAtIndex:0]objectForKey:@"megusta"];
			
			
			NSString *dom = [[NSString alloc] initWithFormat:@"%@ \n (%@, %@)",dm,lat,lon];
            [self.txtDenuncia setText:[[NSString alloc] initWithFormat:@"'%@'",den]];
			[self.lblDomicilio setText:dom];
			[self.lblMeGusta setText:[[NSString alloc] initWithFormat:@"(%@) Me Gusta",meg]];
			
            [self.lblFecha setText:[[NSString alloc] initWithFormat: @"%@ ",fec]];
			/*
            self.lblFecha.layer.borderWidth = 1;
            self.lblFecha.layer.borderColor = [[UIColor grayColor] CGColor];
            self.lblFecha.layer.cornerRadius = 3;
			 */
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

-(void)alertView:(UIAlertView *)alertView clickedButtonAtIndex:(NSInteger)buttonIndex{
    if ( buttonIndex == 1 ){
        [self deleteData];
        
    }
}




@end
