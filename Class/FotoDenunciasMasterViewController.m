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
    float _lat;
    float _lon;
    UITapGestureRecognizer *letterTapRecognizer;
    
}

@end

@implementation FotoDenunciasMasterViewController
@synthesize lblArchivo,txtImage,txtDen,lblFec,S,ArchivoPlano, mapView, manager;

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
    
    manager = [[CLLocationManager alloc] init];
    manager.distanceFilter = 1;
    manager.desiredAccuracy = kCLLocationAccuracyBest;
    [manager setDelegate:self];
    
#ifdef __IPHONE_8_0
    if(IS_OS_8_OR_LATER) {
        // Use one or the other, not both. Depending on what you put in info.plist
        //[self.locationManager requestWhenInUseAuthorization];
        [manager requestWhenInUseAuthorization];
    }
#endif
    [manager startUpdatingLocation];
    
    self.S  = [Singleton sharedMySingleton];

    UITapGestureRecognizer *singleTap = [[UITapGestureRecognizer alloc] initWithTarget:self action:@selector(highlightLetter:)];
    
    [mapView addGestureRecognizer:singleTap];
    
    [self.ActPlay startAnimating];
    self.lblText.text = self.lblArchivo;
    
}

- (void)handleSingleTap:(UIGestureRecognizer *)gestureRecognizer {
    // single tap does nothing for now
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
    
    BOOL fileExists = [[NSFileManager defaultManager] fileExistsAtPath:path];

    if (fileExists)
        [self.txtImage setImage: [UIImage imageWithContentsOfFile:path]];
    else
        [self.txtImage setImage:[UIImage imageWithData:[NSData dataWithContentsOfURL:[NSURL URLWithString:self.lblArchivo]]]];
    
    [self getImageData];


}

- (void)highlightLetter:(UITapGestureRecognizer*)sender {
    // UIView *view = sender.view;
    // NSLog(@"TaPPED %ld", (long)view.description);//By tag, you can find out where you had tapped.
    
    // CLLocationCoordinate2D location = [[[self.mapView userLocation] location] coordinate];
    // NSLog(@"Location found from Map: %f %f",location.latitude,location.longitude);

    // This is important if you only want to receive one tap and hold event
    
    if (sender.state == UIGestureRecognizerStateEnded){
        NSLog(@"Released!");
        [self.mapView removeGestureRecognizer:sender];
    }else{
        // Here we get the CGPoint for the touch and convert it to latitude and longitude coordinates to display on the map
        CGPoint point = [sender locationInView:self.mapView];
        CLLocationCoordinate2D coord = [self.mapView convertPoint:point toCoordinateFromView:self.mapView];
        // Then all you have to do is create the annotation and add it to the map
        MKCoordinateSpan span = MKCoordinateSpanMake(0.1, 0.1);
        MKCoordinateRegion region = {coord, span};
        
        MKPointAnnotation *annotation = [[MKPointAnnotation alloc] init];
        [annotation setCoordinate:coord];
        
        [mapView setRegion:region];
        [mapView addAnnotation:annotation];
        [mapView setCenterCoordinate:coord animated:YES];

        NSLog(@"Hold!!");
        NSLog(@"Location found from Map: %f %f",coord.latitude,coord.longitude);
    }
    
}

- (IBAction)DeleteItem:(id)sender {
    // [self deleteData];

    [self alertStatus:@"Atención" Mensaje:@"Desea eliminar esta imagen de tu dispositivo?" Button1:@"No" Button2:@"Si"];
    
}

-(void)getImageData{
    
    option = 1;

    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
    
    // [HUD showUIBlockingIndicatorWithText:@"Loading image data, please wait..."];
    
    
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
    
    // [HUD showUIBlockingIndicatorWithText:@"Deleting data, please wait..."];
    
    
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
			
			
            // NSString *dom = [[NSString alloc] initWithFormat:@"%@ \n (%@, %@)",dm,lat,lon];
			NSString *dom = [[NSString alloc] initWithFormat:@"%@)",dm];
            [self.txtDenuncia setText:[[NSString alloc] initWithFormat:@"%@",den]];
			[self.lblDomicilio setText:dom];
			[self.lblMeGusta setText:[[NSString alloc] initWithFormat:@"(%@) Me Gusta",meg]];
			
            [self.lblFecha setText:[[NSString alloc] initWithFormat: @"%@ ",fec]];
            
            float latitude = lat.floatValue;
            float longitude = lon.floatValue;
            
            self->_lat = latitude;
            self->_lon = longitude;
            
            [self pintaMapa:latitude long:longitude ];
            
            [self.ActPlay stopAnimating];
            
            break;
            
        }
        default:
            break;
    }
}


- (void)longpressToGetLocation:(UIGestureRecognizer *)gestureRecognizer
{
    if (gestureRecognizer.state != UIGestureRecognizerStateBegan)
        return;
    
    CGPoint touchPoint = [gestureRecognizer locationInView:self.mapView];
    CLLocationCoordinate2D location =
    [self.mapView convertPoint:touchPoint toCoordinateFromView:self.mapView];
    
    NSLog(@"Location found from Map: %f %f",location.latitude,location.longitude);
    
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    // [HUD hideUIBlockingIndicator];
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

-(void)pintaMapa:(float) lat long:(float) lon{

    
    [manager startUpdatingLocation];
    
    
    CGRect rect = self.view.frame;
    rect.origin.x = 0;
    rect.origin.y = 440;
    rect.size.height = 200;
    rect.size.width = self.view.bounds.size.width;
    mapView.frame = rect;
    mapView.showsUserLocation = NO;
    mapView.showsPointsOfInterest = YES;
    mapView.mapType = MKMapTypeStandard;
    mapView.delegate = self;
    
    CLLocationCoordinate2D coord = CLLocationCoordinate2DMake(lat, lon);
    
    MKCoordinateSpan span = MKCoordinateSpanMake(0.1, 0.1);
    MKCoordinateRegion region = {coord, span};
    
    MKPointAnnotation *annotation = [[MKPointAnnotation alloc] init];
    [annotation setCoordinate:coord];
    
    [mapView setRegion:region];
    [mapView addAnnotation:annotation];
    [mapView setCenterCoordinate:coord animated:YES];

    MKCircle *circle = [MKCircle circleWithCenterCoordinate:coord radius:25];
    [mapView addOverlay:circle];
    
    // MKMapPoint point = MKMapPointForCoordinate(coord);
    
     CLLocationCoordinate2D* coords = malloc(1 * sizeof(CLLocationCoordinate2D));
    coords[0] = coord;
    MKPolyline *polyline = [MKPolyline polylineWithCoordinates:coords count:1];
    
    [mapView addOverlay:polyline];
    [mapView setNeedsDisplay];


    
    
}

- (void)mapView:(MKMapView *)mapView didAddAnnotationViews:(nonnull NSArray<MKAnnotationView *> *)views{
    MKCoordinateRegion region;
    MKCoordinateSpan span;
    span.latitudeDelta = 0.005;
    span.longitudeDelta = 0.005;
    CLLocationCoordinate2D location;
    location.latitude = self->_lat;
    location.longitude = self->_lon;
    region.span = span;
    region.center = location;
    [self.mapView setRegion:region animated:YES];
    
}

- (void)mapView:(MKMapView *)mapView didUpdateUserLocation:(MKUserLocation *)userLocation {
    MKCoordinateRegion region;
    MKCoordinateSpan span;
    span.latitudeDelta = 0.005;
    span.longitudeDelta = 0.005;
    CLLocationCoordinate2D location;
    location.latitude = userLocation.coordinate.latitude;
    location.longitude = userLocation.coordinate.longitude;
    region.span = span;
    region.center = location;
    [self.mapView setRegion:region animated:YES];
    
}

- (void)locationManager:(CLLocationManager *)manager
    didUpdateToLocation:(CLLocation *)newLocation
           fromLocation:(CLLocation *)oldLocation{
    CLLocationCoordinate2D location;
    location.latitude = newLocation.coordinate.latitude;
    location.longitude = newLocation.coordinate.longitude;
    
    NSLog(@"LAT: %f LONG: %f",location.latitude,location.longitude);
    
}



- (MKOverlayRenderer *)mapView:(MKMapView *)mapView rendererForOverlay:(id<MKOverlay>)overlay
{
    if ([overlay isKindOfClass:[MKPolygon class]])
    {
        MKPolygonRenderer *renderer = [[MKPolygonRenderer alloc] initWithPolygon:overlay];
        
        renderer.fillColor   = [[UIColor cyanColor] colorWithAlphaComponent:0.2];
        renderer.strokeColor = [[UIColor blueColor] colorWithAlphaComponent:0.7];
        renderer.lineWidth   = 3;
        
        return renderer;
    }
    
    if ([overlay isKindOfClass:[MKCircle class]])
    {
        MKCircleRenderer *renderer = [[MKCircleRenderer alloc] initWithCircle:overlay];
        
        renderer.fillColor   = [[UIColor cyanColor] colorWithAlphaComponent:0.2];
        renderer.strokeColor = [[UIColor blueColor] colorWithAlphaComponent:0.7];
        renderer.lineWidth   = 3;
        
        return renderer;
    }
    
    if ([overlay isKindOfClass:[MKPolyline class]])
    {
        MKPolylineRenderer *renderer = [[MKPolylineRenderer alloc] initWithPolyline:overlay];
        
        renderer.strokeColor = [[UIColor blueColor] colorWithAlphaComponent:0.7];
        renderer.lineWidth   = 3;
        
        return renderer;
    }
    
    return nil;
}




@end
