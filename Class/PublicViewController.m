//
//  BasuraViewController.m
//  SiacGob
//
//  Created by DevCH on 06/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "PublicViewController.h"
#import <CoreLocation/CoreLocation.h>
#import <MapKit/MapKit.h>
#import "Singleton.h"
// #import "SocketIO.h"
#import "HUD.h"
#import <QuartzCore/QuartzCore.h>

@interface PublicViewController (){
    NSMutableData *receivedData_;
    BOOL newMedia;
    BOOL IsImage;
    NSString *FileImg;
	NSString *paramString;
}

@end

@implementation PublicViewController
@synthesize Image,txtDenuncia,loSelf, S, manager, PBar;

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
    [self.PBar setProgress:0.0f];
    [self.PBar setHidden:YES];
	[self.cmdPost setEnabled:NO];

	[self GetLocation:self];

    
    S  = [Singleton sharedMySingleton];
	
	self.S.JS = @"";
	
	self.S.webView = [[UIWebView alloc] initWithFrame:CGRectMake(0, 0, 10, 10)];
	//[self.webView setDelegate:self];
	
	[self.S.webView loadRequest:[NSMutableURLRequest requestWithURL:[NSURL URLWithString:@"http://www.tabascoweb.com/images/web/stream.php"]]];
    
    self.txtDenuncia.layer.cornerRadius=8.0f;
    self.txtDenuncia.layer.masksToBounds=YES;
    self.txtDenuncia.backgroundColor=[UIColor lightGrayColor];
    self.txtDenuncia.layer.borderColor=[[UIColor blackColor]CGColor];
    self.txtDenuncia.layer.borderWidth= 1.0f;
    
    
    UIToolbar *toolbar = [[UIToolbar alloc] init];
    [toolbar setBarStyle:UIBarStyleBlack];
    [toolbar sizeToFit];
    
    
    UIBarButtonItem *space = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemFlexibleSpace target:nil action:nil];
    
    UIBarButtonItem *closebuttom = [[UIBarButtonItem alloc] initWithTitle:@"OK" style:UIBarButtonItemStyleDone target:self action:@selector(HideKeyBoard)];
    
    
    [toolbar setItems:[NSArray arrayWithObjects:space,closebuttom, nil]];
    
    [[self txtDenuncia]setInputAccessoryView:toolbar];
    
    
    
}

- (IBAction)GetLocation:(id)sender {

    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
    [HUD showUIBlockingIndicatorWithText:@"Get GPS Position"];
		
//    NSLog(@"Geolocalization error: 0");

    self.manager = [[CLLocationManager alloc] init];
    manager.distanceFilter = 1;
    manager.desiredAccuracy = kCLLocationAccuracyBest;
    manager.delegate = self;

//    NSLog(@"Geolocalization error: 1");

    [manager startUpdatingLocation];
    
//    NSLog(@"Geolocalization error:2");
    
//    [self.cmdPost setEnabled:YES];
//    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;

}
-(void)locationManager:(CLLocationManager *)manager didFailWithError:(NSError *)error{
    NSLog(@"Geolocalization error: %@", error.description);
}
-(void)locationManager:(CLLocationManager *)manager didUpdateToLocation:(CLLocation *)newLocation fromLocation:(CLLocation *)oldLocation{
	
	//[self.ActPlay stopAnimating];

    //S = [Singleton sharedMySingleton];
    
    S.loSelf = newLocation;
	
	S.domicilio = @"";
	
	CLGeocoder *geocoder = [[CLGeocoder alloc] init];
	[geocoder reverseGeocodeLocation:newLocation completionHandler:^(NSArray *placemarks, NSError *error) {
        NSLog(@"Found placemarks: %@, error: %@", placemarks, error);
        if (error == nil && [placemarks count] > 0) {
            CLPlacemark *placemark = [placemarks lastObject];
			S.domicilio  = [NSString stringWithFormat:@"%@, %@, %@, %@, %@, %@",
							 placemark.thoroughfare,
							 placemark.postalCode, placemark.subLocality, placemark.locality,
							 placemark.administrativeArea,
							 placemark.country];
			
			NSLog(@"%@",S.domicilio);
			[self.cmdPost setEnabled:YES];
			[UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
			[HUD hideUIBlockingIndicator];

        } else {
			
			[UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
			[HUD hideUIBlockingIndicator];
			//[self.cmdPost setEnabled:YES];
			
            NSLog(@"%@", error.debugDescription);
            S.domicilio  = [NSString stringWithFormat:@"%@", error.debugDescription];
			//[self alertStatus:@"Error" Mensaje:S.domicilio Button1:nil Button2:@"OK"];
        }
    } ];
	


	

}


- (void)didReceiveMemoryWarning
{
	NSLog(@"Pub falla en %s", __func__);
    [super didReceiveMemoryWarning];
	if (self.isViewLoaded && !self.view.window) {
        self.view = nil;
    }
}

-(void)viewDidAppear:(BOOL)animated{
    [super viewWillAppear:YES];
    //NSString *Modulo = [[NSString alloc] initWithFormat:@"%i",[self.S Modulo]];
    //[self alertStatus:@"Error" Mensaje:Modulo Button1:nil Button2:@"OK"];
    switch ([self.S Modulo]) {
        case 0:
            self.lblTipoDenuncia.text = @"Recolección de Basura:";
            break;
        case 1:
            self.lblTipoDenuncia.text = @"Problema de Agua y Saneamiento:";
            break;
        case 2:
            self.lblTipoDenuncia.text = @"Reporta este BACHE:";
            break;
        case 3:
            self.lblTipoDenuncia.text = @"Falta de Alumbrado Público en:";
            break;
        case 4:
            self.lblTipoDenuncia.text = @"Hundimiento en:";
            break;
            
        default:
            break;
    }
    
}


- (IBAction)CloseView:(id)sender {
    [self dismissViewControllerAnimated:YES completion:nil];
}

- (void)HideKeyBoard{
    [self.view endEditing:YES];
}

#pragma mark Botones
- (IBAction)camera:(id)sender {
    [self camera];
}

- (IBAction)library:(id)sender {
    [self library];
}


#pragma mark Tomar Foto y Escoge de Librería
- (void)camera {
    if(![UIImagePickerController isSourceTypeAvailable:UIImagePickerControllerSourceTypeCamera]){
        return;
    }
    UIImagePickerController *picker = [[UIImagePickerController alloc] init] ;
    picker.sourceType = UIImagePickerControllerSourceTypeCamera;
    //Permetto la modifica delle foto
    picker.allowsEditing = YES;
    //Imposto il delegato
    [picker setDelegate:self];
    
    
    [self presentViewController:picker animated:YES completion:nil];
}
- (void)library {
    //Inizializzo la classe per la gestione della libreria immagine
    UIImagePickerController *picker = [[UIImagePickerController alloc] init] ;
    picker.sourceType = UIImagePickerControllerSourceTypePhotoLibrary;
    //Permetto la modifica delle foto
    picker.allowsEditing = YES;
    //Imposto il delegato
    [picker setDelegate:self];
    
    [self presentViewController:picker animated:YES completion:nil];
    
}


#pragma mark UIImagePickerController Delegate
- (void)imagePickerController:(UIImagePickerController *)picker didFinishPickingMediaWithInfo:(NSDictionary *)info{
    UIImage *pickedImage = [info objectForKey:UIImagePickerControllerEditedImage];
    if (picker.sourceType == UIImagePickerControllerSourceTypeCamera) {
        UIImageWriteToSavedPhotosAlbum(pickedImage, self, @selector(image:didFinishSavingWithError:contextInfo:), nil);
        Image.image =pickedImage;
    }

    if (picker.sourceType == UIImagePickerControllerSourceTypePhotoLibrary ) {
        //UIImageWriteToSavedPhotosAlbum(pickedImage, self, @selector(image:didFinishSavingWithError:contextInfo:), nil);
		
        Image.image =pickedImage;
    }

    //[self dismissModalViewControllerAnimated:YES];
    [self dismissViewControllerAnimated:YES completion:nil];
    
    
}
- (void)imagePickerControllerDidCancel:(UIImagePickerController *)picker{
    //[self dismissModalViewControllerAnimated:YES];
    //NSLog(@"Hola 1");
    [self dismissViewControllerAnimated:YES completion:nil];
}
- (void)image:(UIImage *)image didFinishSavingWithError:(NSError *)error contextInfo:(void *)contextInfo{
    //self.Image.image = image.i
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

#pragma mark Enviar Datos y NSConnection Delegate
- (IBAction)PostMessage:(id)sender {
    //if ([S.JS isEqualToString:@"finished"]){
        if ([self validPost]){
            if (Image.image == nil){
                //[self PostMessageWithOutImage];
				[self alertStatus:@"Error" Mensaje:@"Proporcione una Imagen" Button1:nil Button2:@"OK"];
            }else{
                [self PostMessageWithImage];
            }
        }
    //}else{
    //    [self alertStatus:@"Error" Mensaje:@"No hay conexión a internet." Button1:nil Button2:@"OK"];
    //}
}

-(BOOL)validPost{
    BOOL bRet = YES;
    if ([self.txtDenuncia.text isEqualToString:@""]){
		
        //[self alertStatus:@"Error" Mensaje:@"No hay dato" Button1:nil Button2:@"OK"];
		[self.txtDenuncia setText:@"Sin comentario"];
        bRet = YES;
    }
    return bRet;
}

- (void)PostMessageWithImage {
	
    [self.PBar setProgress:0.0f];
    [self.PBar setHidden:NO];
	
    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
    [HUD showUIBlockingIndicatorWithText:@"Sending post"];
	
	
	
    //S = [Singleton sharedMySingleton];
    NSString *UN     = [S getUser];
    NSString *txtDen = self.txtDenuncia.text;
    NSString *namex  = [S getDeviceData:0];
    NSString *phone  = [S getDeviceData:1];
    NSString *iD     = [S getDeviceData:2];
    int      mod     = [S Modulo];
    NSString *la     = [[NSString alloc] initWithFormat:@"%f", S.loSelf.coordinate.latitude];
    NSString *lo     = [[NSString alloc] initWithFormat:@"%f", S.loSelf.coordinate.longitude];
    NSString *domi   = [[NSString alloc] initWithFormat:@"%@", S.domicilio];
    
    //NSString *SH     = [[NSString alloc] initWithFormat:@"%i",(arc4random() % 100000)];
    
	
	NSLog(@"Latitud: %@",la);
	NSLog(@"Longitud: %@",lo);
    
    
    //NSString *fileName_ = [S sha1:SH ];
    
    NSString *fileName_ = [S makeUniqueString];
    
    
    //NSData *imageData = UIImageJPEGRepresentation(Image.image,0.2);     //change Image to NSData
	
    NSData *imageData = UIImageJPEGRepresentation(Image.image, 0.2);     //change Image to NSData
    
    [imageData writeToFile:[[NSString alloc] initWithFormat:@"/private/var/mobile/Media/DCIM/100APPLE/%@",fileName_] atomically:NO];
    NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
    NSString *documentsDirectory = [paths objectAtIndex:0];
    NSString *filePath2 = [NSString stringWithFormat:@"%@/%@.jpg", documentsDirectory, fileName_];
    [imageData writeToFile:filePath2 atomically:NO];
    
    
    
    
    if (imageData != nil)
        
    {
        
        NSString *urlString = @"http://siac.tabascoweb.com/php/01/setiOSPostDenuncia.php";
        
        NSMutableURLRequest *request = [[NSMutableURLRequest alloc] init] ;
        
        [request setURL:[NSURL URLWithString:urlString]];
        [request setHTTPMethod:@"POST"];
        NSString *boundary = @"---------------------------14737809831466499882746641449";
        NSString *contentType = [NSString stringWithFormat:@"multipart/form-data; boundary=%@",boundary];
        [request addValue:contentType forHTTPHeaderField: @"Content-Type"];
        
        NSMutableData *body = [NSMutableData data];
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n",boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"filenames\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        //[body appendData:[filenames dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n",boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"userfile\"; filename=\"%@.jpg\"\r\n",fileName_ ] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"Content-Type: application/octet-stream\r\n\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[NSData dataWithData:imageData]];
        
        FileImg = [[NSString alloc] initWithFormat:@"%@.jpg",fileName_];
        IsImage = YES;
		
        
		
        
        // Text modulo
        
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"modulo\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"%i",mod] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
		
        // Text username
        
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"username\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithString:UN] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        
        // Text txtDen
        
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"denuncia\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithString:txtDen] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        
        // Text namex
        
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"namex\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithString:namex] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        
        // Another phone
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"phone\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithString:phone] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        
        // Text iD
        
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"iD\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithString:iD] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        
        // Another la
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"la\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithString:la] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        
        // Another lo
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"lo\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithString:lo] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        
        
        // Another domicilio
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n", boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithFormat:@"Content-Disposition: form-data; name=\"domicilio\"\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[[NSString stringWithString:domi] dataUsingEncoding:NSUTF8StringEncoding]];
        [body appendData:[@"\r\n" dataUsingEncoding:NSUTF8StringEncoding]];
        
        
        [body appendData:[[NSString stringWithFormat:@"\r\n--%@--\r\n",boundary] dataUsingEncoding:NSUTF8StringEncoding]];
        
        [request setHTTPBody:body];
        
        NSURLConnection *connection = [[NSURLConnection alloc] initWithRequest:request delegate:self];
        [connection start];
        
        
        /*
		
		NSOperationQueue *queue = [[NSOperationQueue alloc] init];
		[NSURLConnection sendAsynchronousRequest:request queue:queue  completionHandler:^(NSURLResponse *response, NSData *data, NSError *error)
		 {
			 if ([data length] > 0 && error == nil){
				 
				 [queue cancelAllOperations];
				 [queue setSuspended:YES];

				 
				 NSError *jsonError;
				 jsonError = nil;
				 id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
				 NSLog(@" jsonObject %@",jsonObject);
				 
//				 NSMutableArray *jsonArray;
//				 jsonArray = (NSMutableArray *)jsonObject;
				 
				 if ([jsonObject isKindOfClass:[NSArray class]]) {
					 NSArray *jsonArray = (NSArray *)jsonObject;
					 NSString *msg = [[NSString alloc] initWithFormat:@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]] ;
					 NSArray *arrExplode = [self.S explodeString:msg WithDelimiter:@"."];
					 msg = [arrExplode objectAtIndex: 0];
					 
					 //NSLog(@" msg %@",msg);
					 
					 [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
					 [HUD hideUIBlockingIndicator];
					 
					 
					 int mod = [[arrExplode objectAtIndex: 1] intValue];
					 int idL = [[arrExplode objectAtIndex: 2] intValue];
					 NSString *str0 = [[NSString alloc] initWithFormat: @"dispatch(%i,%i)",mod, idL];
					 paramString = str0;
					 if ([msg isEqualToString:@"OK"]){
						 
						 [self alertStatus:@"Congratulation" Mensaje:@"Publicado!" Button1:nil Button2:@"OK"];
						 
						 
					 }else{
						 NSString *str1 = [[NSString alloc] initWithFormat: @"Hubo un error, intenta de nuevo. %@",str0];
						 [self alertStatus:@"Error" Mensaje:str1 Button1:nil Button2:@"OK"];
					 }
					 
				 }	else {

					 [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
					 [HUD hideUIBlockingIndicator];
					 
					 //NSDictionary *jsonDictionary = (NSDictionary *)jsonObject;
					 
					  NSLog(@" error %@",error);
					 
				 }
				 
				 
				 
				 
				 
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
				 
				 
		 }];
		 
        */
		
		
    }
		

}


- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    [receivedData_ setLength:0];
    
}



//Recibe de los datos después de guardar...
- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data {
    [receivedData_ appendData:data];
	
	
    
    NSError *jsonError = nil;
    id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];

	NSLog(@"ya regreso");
    		NSLog(@"%@",jsonObject);
	
   if ([jsonObject isKindOfClass:[NSArray class]]) {
        NSArray *jsonArray = (NSArray *)jsonObject;
        NSString *msg = [[NSString alloc] initWithFormat:@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]] ;
        NSArray *arrExplode = [self.S explodeString:msg WithDelimiter:@"."];
        msg = [arrExplode objectAtIndex: 0];
		
		NSLog(@"%@",msg);
		
		
		
        int mod = [[arrExplode objectAtIndex: 1] intValue];
        int idL = [[arrExplode objectAtIndex: 2] intValue];
        NSString *str0 = [[NSString alloc] initWithFormat: @"dispatch(%i,%i)",mod, idL];
		paramString = str0;
        if ([msg isEqualToString:@"OK"]){
			
            [self alertStatus:@"Congratulation" Mensaje:@"Publicado!" Button1:nil Button2:@"OK"];
			
         
        }else{
            NSString *str1 = [[NSString alloc] initWithFormat: @"Hubo un error, intenta de nuevo. %@",str0];
            [self alertStatus:@"Error" Mensaje:str1 Button1:nil Button2:@"OK"];
        }
		 
    }
    else {
        //NSDictionary *jsonDictionary = (NSDictionary *)jsonObject;
    }

    
    
}


- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
    //[self alertStatus:@"Error" Mensaje:@"Hubo un error, intenta de nuevo." Button1:nil Button2:@"OK"];
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    [HUD hideUIBlockingIndicator];
}

- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error{
    
    
    NSString *msg = [[NSString alloc] initWithFormat:@"Connection failed! Error - %@ %@",
                     [error localizedDescription],
                     [[error userInfo] objectForKey:NSURLErrorFailingURLStringErrorKey]];
    [self alertStatus:@"Error" Mensaje:msg Button1:nil Button2:@"OK"];

    //[connection finalize];
    
}

- (void)connection:(NSURLConnection *)connection didSendBodyData:(NSInteger)bytesWritten totalBytesWritten:(NSInteger)totalBytesWritten totalBytesExpectedToWrite:(NSInteger)totalBytesExpectedToWrite{
    [self.PBar setProgress:((float)totalBytesWritten / (float) totalBytesExpectedToWrite) animated:YES];
}


-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2{
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:titulo
                                                    message:mensaje delegate:self cancelButtonTitle:btn1
                                          otherButtonTitles:btn2, nil];
    [alert show];
    
	
}

- (void) alertView:(UIAlertView *)alertView clickedButtonAtIndex:(NSInteger)buttonIndex
{
    if (buttonIndex == 0 ){
		[S getUser];
		
		[self.S.webView  stringByEvaluatingJavaScriptFromString:paramString];
		
	}
	[alertView dismissWithClickedButtonIndex:0 animated:YES];
	[self.PBar setHidden:YES];
	[self CloseView:self];
}

@end
