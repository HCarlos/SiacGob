//
//  TL_ViewController.m
//  SiacGob
//
//  Created by DevCH on 08/03/14.
//  Copyright (c) 2014 DevCH. All rights reserved.
//

#import "TL_ViewController.h"
#import <MessageUI/MessageUI.h>
#import "HUD.h"
#import "Singleton.h"
#import <QuartzCore/QuartzCore.h>
#import "TL_Cell.h"
#import "imageViewController.h"

@interface TL_ViewController (){
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

@implementation TL_ViewController
@synthesize path,datos,indice,S,lblTitulo,celda;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];

	colors = [NSMutableArray array];
	
	float INCREMENT = 0.05;
	for (float hue = 0.0; hue < 1.0; hue += INCREMENT) {
		UIColor *color = [UIColor colorWithHue:hue
									saturation:1.0
									brightness:1.0
										 alpha:1.0];
		[colors addObject:color];
	}
	
    UIRefreshControl *refreshControl = [[UIRefreshControl alloc] init];
    [refreshControl addTarget:self action:@selector(doLoad) forControlEvents:UIControlEventValueChanged];
	NSMutableAttributedString *commentString = [[NSMutableAttributedString alloc] initWithString:@"Loading..."];
	
	[refreshControl setAttributedTitle:commentString ];
	
    self.refreshControl = refreshControl;
	
	[self.canvas setDelegate:self];
	[self.canvas setDataSource:self];

	//[self.canvas registerClass:[TL_Cell class] forCellReuseIdentifier:@"Cell"];
	
	isInternet = YES;
	// Do any additional setup after loading the view.
    self.S  = [Singleton sharedMySingleton];
	
	username = [self.S getUser];
	
	self.S.IsDelete = NO;
	
	[self getData];
	
}


- (void) doLoad
{

    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_DEFAULT, 0), ^{
 		// Instead of sleeping, I do a webrequest here.
		[NSThread sleepForTimeInterval: 1];
		
		dispatch_async(dispatch_get_main_queue(), ^{

			[self  reloadData];
			[self.refreshControl endRefreshing];
			//NSLog(@"Refreshing....");

		});
		
    });

	
}


- (void)refresh:(UIRefreshControl *)refreshControl {
    [refreshControl endRefreshing];
}

-(void)viewDidAppear:(BOOL)animated
{
	[super viewDidAppear:animated];
	//[self.canvas reloadData];
	
}


- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
//#warning Potentially incomplete method implementation.
    // Return the number of sections.
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
//#warning Incomplete method implementation.
    // Return the number of rows in the section.
    return  [self.datos count];
	
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
	
	

	static NSString *CellIdentifier = @"MyCell";

	TL_Cell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier forIndexPath:indexPath ];

	if (cell == nil) {
        cell = [[TL_Cell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] ;
    }
	
	@try {
		
		

		 NSUInteger i = indexPath.row;
		
		//[cell setBackgroundColor:colors[ [self.S intInRangeMinimum:0 andMaximum: (unsigned int)[self.datos count] ]  ]];
	
		NSString *foto = [[NSString alloc] initWithFormat: @"%@",[[self.datos objectAtIndex:i ]objectForKey:@"imagen"]];

		NSString *titulo = [[NSString alloc] initWithFormat: @"%@",[[self.datos objectAtIndex:i ]objectForKey:@"denuncia"]];
		//NSString *megusta = [[NSString alloc] initWithFormat: @"A %@ personas le gusta esto",[[self.datos objectAtIndex:i ]objectForKey:@"megusta"]];

		NSString *usuario = [[NSString alloc] initWithFormat: @" %@",[[self.datos objectAtIndex:i ]objectForKey:@"username"]];
		NSArray *arrExplode = [self.S explodeString:usuario WithDelimiter:@"@"];
		usuario = [[NSString alloc] initWithFormat: @"%@",[arrExplode objectAtIndex: 0]];
		
		NSString *fecha = [[NSString alloc] initWithFormat: @" %@ ",[[self.datos objectAtIndex:i ]objectForKey:@"creado_el"]];
		
		NSDate *date = [NSDate date];
		NSDateFormatter *dateFormat = [[NSDateFormatter alloc] init];
		[dateFormat setDateFormat:@"dd-MM-yyyy"];
		fecha = [dateFormat stringFromDate:date];
		 

		strPath = foto;
	
		[cell.imageView setImage:nil];
	
		[cell setPhoto:strPath];
		
		[cell.txtDenuncia setText:titulo];
		//[cell.lblMeGusta setText: megusta];
		[cell.lblUser setTitle:usuario forState:UIControlStateNormal ];
		[cell.lblFecha setTitle:fecha forState:UIControlStateNormal ];
	
	
		NSLog(@"%@",titulo);
		 

	}
	@catch (NSException *theException)
	{
		NSLog(@"Error en: %@", theException);
	}
		
	return cell;

	
}

- (void)scrollToRowAtIndexPath:(NSIndexPath *)indexPath atScrollPosition:(UITableViewScrollPosition)scrollPosition animated:(BOOL)animated
{
    /*
	CGFloat height = scrollView.frame.size.height;
	
    CGFloat contentYoffset = scrollView.contentOffset.y;
	
    CGFloat distanceFromBottom = scrollView.contentSize.height - contentYoffset;
	*/
	
	NSString *inte = [[NSString alloc] initWithFormat: @"%@",[[self.datos objectAtIndex:scrollPosition ]objectForKey:@"imagen"]];
	
	NSLog(@"---> %@ ",inte);
	
    if(inte != nil)
    {
        NSLog(@"***** %@ ",inte);
		
    }

}


- (void)scrollViewDidEndDragging:(UIScrollView *)aScrollView willDecelerate:(BOOL)decelerate{
	
    CGPoint offset = aScrollView.contentOffset;
    CGRect bounds = aScrollView.bounds;
    CGSize size = aScrollView.contentSize;
    UIEdgeInsets inset = aScrollView.contentInset;
    float y = offset.y + bounds.size.height - inset.bottom;
    float h = size.height;
	
    float reload_distance = 60;
    if(y > h + reload_distance) {
		self.S.limFrom++;

		dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_DEFAULT, 0), ^{
			// Instead of sleeping, I do a webrequest here.
			[NSThread sleepForTimeInterval: 0];
			
			
			dispatch_async(dispatch_get_main_queue(), ^{

				[self reloadData];
				
			});
			
		});
		
    }
 
}




 
/*
// Override to support conditional editing of the table view.
- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return YES;
}
*/

/*
// Override to support editing the table view.
- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        // Delete the row from the data source
        [tableView deleteRowsAtIndexPaths:@[indexPath] withRowAnimation:UITableViewRowAnimationFade];
    }   
    else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
    }   
}
*/

/*
// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
{
}
*/

/*
// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}
*/

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



/*
- (void)refreshDisplay:(UITableView *)tableView {
    
	//[[self canvas] reloadData];
	//[tableView performSelectorOnMainThread:@selector(getData) withObject:(tableView) waitUntilDone:YES];

}




- (void)reloadRowsAtIndexPaths:(NSArray *)indexPaths withRowAnimation:(UITableViewRowAnimation)animation{
	//[UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
	//[HUD showUIBlockingIndicatorWithText:@"Loading..."];
}
*/

- (void)reloadData{
	[self performSelectorOnMainThread:@selector(getData) withObject:nil waitUntilDone:YES];
}

#pragma mark - Data Source
-(void)getData{
    
	@try
	{
		
		[self.canvas setAlpha:0.2];
		[self setDatos:nil];
    
	[UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
	[HUD showUIBlockingIndicatorWithText:@"Loading"];
    
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

			 [self.canvas setDelegate:self];
			 [self.canvas setDataSource:self];

			 [self.canvas reloadData];
			 
			 [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
			 [HUD hideUIBlockingIndicator];

			 [self.canvas setAlpha:1.0];
			 
			 
			 NSLog(@"Total de Registros: %d ",(unsigned int)[self.datos count]);
			 
			 
		 }else if ([data length] == 0 && error == nil){
			 //[self setDatos:nil];
			 NSLog(@"vacio");
		 }else if (error != nil && error.code == NSURLErrorTimedOut){ //used this NSURLErrorTimedOut from foundation error responses
			 //[self timedOut];
			 NSLog(@"tiempo terminado");
		 }else if (error != nil){
			 // [self downloadError:error];
			 NSLog(@"DevCH -> Error %@", error.localizedDescription);
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


/*
- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    [receivedData setLength:0];
	
}

//Recibe de los datos después de guardar...
- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data {
    [receivedData appendData:data];
    
	if ([data length] > 0 ){
	
	

		
		NSError *jsonError = nil;
		id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
		
		NSMutableArray *jsonArray = (NSMutableArray *)jsonObject;
		
		
        NSString *msg = [[NSString alloc] initWithFormat:@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]] ;
        NSArray *arrExplode = [self.S explodeString:msg WithDelimiter:@"."];
        msg = [arrExplode objectAtIndex: 0];
		
		NSLog(@"%@",msg);
		
		self.datos = jsonArray;
		
		NSLog(@"Total de Registros: %i",[self.datos count]);
		
		if ([msg isEqualToString:@"OK"]) {
			
			[self.canvas reloadData];
			[self.canvas setDelegate:self];
			[self.canvas setDataSource:self];
			
		}else{
			
			[connection cancel];
			[self getData];
			
		}
		
	}else{
		[connection cancel];
		[self getData];
	}

	
	
	NSLog(@"Datos recibidos...");
	[connection cancel];
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    [HUD hideUIBlockingIndicator];
	
}


- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    [connection cancel];
	NSLog(@"Datos cancelados...");
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    [HUD hideUIBlockingIndicator];
}



- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error{
    
    
    NSString *msg = [[NSString alloc] initWithFormat:@"Connection failed! Error - %@ %@",
                     [error localizedDescription],
                     [[error userInfo] objectForKey:NSURLErrorFailingURLStringErrorKey]];
    [self alertStatus:@"Error.." Mensaje:msg Button1:nil Button2:@"OK"];
	
    [connection cancel];
    
}

- (void)connection:(NSURLConnection *)connection didSendBodyData:(NSInteger)bytesWritten totalBytesWritten:(NSInteger)totalBytesWritten totalBytesExpectedToWrite:(NSInteger)totalBytesExpectedToWrite{
    //[self.PBar setProgress:((float)totalBytesWritten / (float) totalBytesExpectedToWrite) animated:YES];
    //[connection cancel];
}
*/

-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2{
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:titulo
                                                    message:mensaje delegate:self cancelButtonTitle:btn1
                                          otherButtonTitles:btn2, nil];
    [alert show];
    
}

#pragma mark - Navigation
-(void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender{
    if([segue.identifier isEqualToString:@"gotoFoto"]){
        
		TL_Cell *cell = (TL_Cell *)sender;
        NSIndexPath *indexPath = [self.canvas indexPathForCell:cell];
        
        NSUInteger i = indexPath.row;//%10;
        
         imageViewController *divc = (imageViewController *)[segue destinationViewController];
		
        
        //NSString *path2 = [[NSString alloc] initWithFormat: @"http://siac.tabascoweb.com/upload/%@",[[self.datos objectAtIndex:i ]objectForKey:@"imagen"]];
        
		divc.iddenuncia =  i;
        
		//divc.ArchivoPlano = cell.ArchivoPlano;
		 
    }
}
	
@end
