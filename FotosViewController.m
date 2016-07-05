//
//  FotosViewController.m
//  SiacGob
//
//  Created by DevCH on 12/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "FotosViewController.h"
#import <MessageUI/MessageUI.h>
#import "HUD.h"
#import "Singleton.h"
#import "CellFoto.h"
#import "FotoDenunciasMasterViewController.h"
#import <QuartzCore/QuartzCore.h>
@interface FotosViewController (){
    NSMutableData *receivedData;
    NSArray *datos;
    BOOL inicio;
    NSUInteger indice;
    int intentos;
    BOOL isInternet;
	NSString *username;
}


@end
@implementation FotosViewController
@synthesize path,datos,indice,S;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
        //self.re
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];

    isInternet = YES;
	// Do any additional setup after loading the view.
    self.S  = [Singleton sharedMySingleton];
	
	username = [self.S getUser];
	
	self.S.IsDelete = NO;
    
	[self.canvas setDelegate:self];
	//[self.canvas setDataSource:self];
	
   [self getData];

}

- (void)didReceiveMemoryWarning
{
	 NSLog(@"Fotos falla en %s", __func__);
    [super didReceiveMemoryWarning];
	if (self.isViewLoaded && !self.view.window) {
        self.view = nil;
    }
    // Dispose of any resources that can be recreated.
}


#pragma mark - Collection View Data Sources

-(NSInteger)collectionView:(UICollectionView *)collectionView numberOfItemsInSection:(NSInteger)section {
    return [self.datos count];
}



- (UICollectionViewCell *)collectionView:(UICollectionView *)collectionView cellForItemAtIndexPath:(NSIndexPath *)indexPath{

    CellFoto *cell = [collectionView dequeueReusableCellWithReuseIdentifier:@"MY_CELL" forIndexPath:indexPath];
    //[cell.ActPlay startAnimating];
    
    if (indexPath>=0){
    
        NSInteger i = indexPath.row;//%10;

        NSString *path1 = [[NSString alloc] initWithFormat: @"%@",[[self.datos objectAtIndex:i ]objectForKey:@"imagen"]];
		
        cell.layer.cornerRadius=8.0f;
        cell.layer.masksToBounds=YES;
        cell.backgroundColor=[UIColor lightGrayColor];
        cell.layer.borderColor=[[UIColor blackColor]CGColor];
        cell.layer.borderWidth= 1.0f;
    
		[cell.imageView setImage:nil];
        [cell setPhoto:path1];
        [cell setArchivoPlano:path1];
    
    }
    return cell;
    
}

-(void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender{
    if([segue.identifier isEqualToString:@"GotoFoto"]){
        CellFoto *cell = (CellFoto *)sender;
        NSIndexPath *indexPath = [self.canvas indexPathForCell:cell];
        
        NSInteger i = indexPath.row;//%10;
        
        FotoDenunciasMasterViewController *divc = (FotoDenunciasMasterViewController *)[segue destinationViewController];
		
        //NSString *path2 = [[NSString alloc] initWithFormat: @"http://dc.tabascoweb.com/php/01/uploads/%@",[[self.datos objectAtIndex:i ]objectForKey:@"imagen"]];
        
        NSString *path2 = [[NSString alloc] initWithFormat: @"http://siac.tabascoweb.com/upload/%@",[[self.datos objectAtIndex:i ]objectForKey:@"imagen"]];
        divc.lblArchivo =  path2;
        divc.ArchivoPlano = cell.ArchivoPlano;
    }
};



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
    
    //if (isInternet==YES){
    
        [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
        [HUD showUIBlockingIndicatorWithText:@"Loading images, please wait..."];
    
    
    
    
        NSMutableDictionary *postDix=[[NSMutableDictionary alloc] init];
        [postDix setObject:[[NSString alloc] initWithFormat: @"%@",username] forKey:@"username"];
    
        NSURL *url = [NSURL URLWithString:@"http://siac.tabascoweb.com/php/01/getiOSGetPhotoUser.php"];
    
        NSData *postData = [self generateFormDataFormPostDictionary:postDix];
        //NSLog(@"Datos: %@",[[NSString alloc] initWithData:postData encoding:NSStringEncodingConversionExternalRepresentation]);
    
        NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
        [request setHTTPMethod:@"POST"];
        //[request setAllowsCellularAccess:YES];
	
		//[request setHTTPShouldHandleCookies:NO];
    
        [request setCachePolicy:NSURLRequestReloadIgnoringLocalAndRemoteCacheData];
		[request setTimeoutInterval:10.0];
    
		[request setValue:[NSString stringWithFormat:@"%lu", (unsigned long)postData.length] forHTTPHeaderField:@"Content-Length"];
        [request setValue:@"application/x-www-form-urlencoded charset=utf-8" forHTTPHeaderField:@"Content-Type"];
        [request setHTTPBody:postData];
    
        NSURLConnection *connection = [[NSURLConnection alloc] initWithRequest:request  delegate:self startImmediately:NO];
		[connection start];
/*
		NSOperationQueue *queue = [[NSOperationQueue alloc] init];
		[NSURLConnection sendAsynchronousRequest:request queue:queue  completionHandler:^(NSURLResponse *response, NSData *data, NSError *error) 
		 {
		 if ([data length] > 0 && error == nil){
			 
			 //[self.canvas setDataSource:nil ];
			 
			 [queue cancelAllOperations];
			 [queue setSuspended:YES];
			 
			 [request cancel];

			 NSError *jsonError = nil;
			 id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
			 
			 NSArray *jsonArray = (NSArray *)jsonObject;
			 
			 
			 NSString *msg = [[NSString alloc] initWithFormat:@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]] ;
			 NSArray *arrExplode = [self.S explodeString:msg WithDelimiter:@"."];
			 msg = [arrExplode objectAtIndex: 0];
			 
			 NSLog(@"%@",msg);
			 
			 self.datos = jsonArray;
			 
			 NSLog(@"Total de Registros: %i",[self.datos count]);
			 NSLog(@"Contenido del JSON-Table: %@", jsonArray);
			 

			 
			 if ([msg isEqualToString:@"OK"]) {
				 
				 [self.canvas reloadData];

				 [self.canvas setDelegate:self];
				 [self.canvas setDataSource:self];
				 
				 
			 }else{
				 
				 [self alertStatus:@"Error" Mensaje:@"No ha subido ninguna imagen." Button1:nil Button2:@"Aceptar"];
				 
				 
				 //self.datos = [[NSArray alloc] initWithObjects:nil];
				 
			 }

			 
		 }else if ([data length] == 0 && error == nil){
			 //[self emptyReply];
			 NSLog(@"vacio");
		 }else if (error != nil && error.code == NSURLErrorTimedOut){ //used this NSURLErrorTimedOut from foundation error responses
			 //[self timedOut];
			 NSLog(@"tiempo terminado");
		 }else if (error != nil){
			 // [self downloadError:error];
			 NSLog(@"errror");
		 }
		
			 
		 [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
		 [HUD hideUIBlockingIndicator];
		 
		 }];
	
	*/
	
        
    //}
    
}


- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    [receivedData setLength:0];

}

//Recibe de los datos después de guardar...
- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data {
    [receivedData appendData:data];
    
	//if (data==nil) { data = [[NSMutableData alloc] initWithCapacity:10240]; }

	
	if (data!=NULL && data!=nil) {
		
		//[self.canvas setDataSource:nil ];
    
		NSError *jsonError = nil;
		id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
    
		NSArray *jsonArray = (NSArray *)jsonObject;
		
		
        NSString *msg = [[NSString alloc] initWithFormat:@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]] ;
        NSArray *arrExplode = [self.S explodeString:msg WithDelimiter:@"."];
        msg = [arrExplode objectAtIndex: 0];
		
		NSLog(@"%@",msg);
    
		self.datos = jsonArray;
    
		[self.canvas setDataSource:self];

		NSLog(@"Total de Registros: %lu",(unsigned long)[self.datos count]);
		NSLog(@"Contenido del JSON-Table: %@", jsonArray);
		
		if ([msg isEqualToString:@"OK"]) {
			
			[self.canvas reloadData];

		}else{
    
			[self alertStatus:@"Error" Mensaje:@"No ha subido ninguna imagen." Button1:nil Button2:@"Aceptar"];
        
			self.datos = [[NSArray alloc] init];
			//sectionTitles = [[NSMutableArray alloc] init];
		}
		
	}else{
		//[connection finalize];
		//[self getData];
	}
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    [HUD hideUIBlockingIndicator];
	
	[connection cancel];
}


- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    //[connection finalize];
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    [HUD hideUIBlockingIndicator];
}



- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error{
    
    
    NSString *msg = [[NSString alloc] initWithFormat:@"Connection failed! Error - %@ %@",
                     [error localizedDescription],
                     [[error userInfo] objectForKey:NSURLErrorFailingURLStringErrorKey]];
    [self alertStatus:@"Error.." Mensaje:msg Button1:nil Button2:@"OK"];

    [connection finalize];
    
}

- (void)connection:(NSURLConnection *)connection didSendBodyData:(NSInteger)bytesWritten totalBytesWritten:(NSInteger)totalBytesWritten totalBytesExpectedToWrite:(NSInteger)totalBytesExpectedToWrite{
    //[self.PBar setProgress:((float)totalBytesWritten / (float) totalBytesExpectedToWrite) animated:YES];
    //[connection finalize];
}



-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2{
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:titulo
                                                    message:mensaje delegate:self cancelButtonTitle:btn1
                                          otherButtonTitles:btn2, nil];
    [alert show];
    
}


- (IBAction)RefreshData:(id)sender {
    [self getData];
}

-(void)viewDidAppear:(BOOL)animated
{
	[super viewDidAppear:animated];
	if (self.S.IsDelete) {
		[self getData];
		self.S.IsDelete = NO;
	}
}


@end
