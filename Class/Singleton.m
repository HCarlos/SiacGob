//
//  Singleton.m
//  New Financial Personal for iPad
//
//  Created by DevCH on 10/08/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Singleton.h"
#include "glob.h"
#import <CoreLocation/CoreLocation.h>
#import <CoreTelephony/CTTelephonyNetworkInfo.h>
#import <MobileCoreServices/MobileCoreServices.h>
#import <MobileCoreServices/UTCoreTypes.h>
#import <CoreLocation/CoreLocation.h>
#import <CommonCrypto/CommonDigest.h>


@implementation Singleton

//@synthesize IdEmpresa,NombreEmpresa,rutaDB, DB,IdIO, Descripcion, IdMovto, Mes, Ano, arrAcum,viewAcum;
@synthesize loSelf,Modulo,IdIO;
@synthesize name,model,localizedModel,systemName,systemVersion,orientation,uniqueIdentifier,domicilio,webView;
@synthesize pathPList, dataPList, JS,IdUser,IsDelete,limCant, limFrom, tokenUser;

static Singleton* _sharedMySingleton = nil;
//extern NSString* CTSettingCopyMyPhoneNumber();

+(Singleton*)sharedMySingleton
{
    
    
	@synchronized([Singleton class])
    {
        if (!_sharedMySingleton)
            _sharedMySingleton = [[self alloc] init];
        
        return _sharedMySingleton;
    }
    
    return nil;
}

+(id)alloc
{
	@synchronized([Singleton class])
	{
		NSAssert(_sharedMySingleton == nil, @"Attempted to allocate a second instance of a singleton.");
		_sharedMySingleton = [super alloc];
		return _sharedMySingleton;
	}
	
	return nil;
}

-(id)init {
	self = [super init];
	if (self != nil) {
		
		/*
        self.JS = @"";
        
         self.webView = [[UIWebView alloc] initWithFrame:CGRectMake(0, 0, 10, 10)];
        //[self.webView setDelegate:self];
        
        [self.webView loadRequest:[NSMutableURLRequest requestWithURL:[NSURL URLWithString:@"http://www.tabascoweb.com/images/web/stream.php"]]];
         */
	}
	
	return self;
}


- (void)webView:(UIWebView *)webView didFailLoadWithError:(NSError *)error{
    //NSLog(@"ERROR LOADING WEBPAGE: %@", error);
}
- (void) webViewDidFinishLoad:(UIWebView*)webView
{
    //NSLog(@"finished");
    self.JS = @"finished";
    if (self.IdIO==1){
        [self alertStatus:@"Atención" Mensaje:@"Conectado a Internet..." Button1:nil Button2:@"OK"];
    }
	self.limFrom = 0;
	self.limCant = 200;
    self.tokenUser = @"";
}


+ (id)allocWithZone:(NSZone *)zone {
	@synchronized([Singleton class]) {
		NSAssert(_sharedMySingleton == nil, @"Attempted to allocate a second instance of a singleton.");
		_sharedMySingleton= [super allocWithZone:zone];
		return _sharedMySingleton; // assignment and return on first allocation
	}
	return nil; //on subsequent allocation attempts return nil
}

- (id)copyWithZone:(NSZone *)zone {
	return self;
}


- (void)viewDidUnload {
	self.loSelf = nil;

	self.webView = nil;
	self.JS = nil;
	
	//@synthesize name,model,localizedModel,systemName,systemVersion,orientation,uniqueIdentifier,webView;
	//@synthesize pathPList, dataPList, JS,IdUser;

	/*
	self.NombreEmpresa = nil;
	self.rutaDB = nil;
	self.Descripcion = nil;
	self.arrAcum = nil;
	 */
	
//    [super viewDidUnload];
	
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}
 

- (void)dealloc {
    /*
    [NombreEmpresa release];
    [rutaDB release];
	[Descripcion release];
	[arrAcum release];
    [super dealloc];
     */
}


-(CLLocation *) getLocation:(CLLocation *)Loc{

	self.limFrom = 0;
	self.limCant = 200;	
    
    self.loSelf = Loc;
    return Loc;
	
}

-(NSString *) getDeviceData:(int )field{
    
    NSString *sRet = @"";
    
    
    switch (field) {
        case 0:
            sRet = [[UIDevice currentDevice] name];
            break;
        case 1:
            sRet =  [self phoneNumber];//[[NSUserDefaults standardUserDefaults] stringForKey:@"SBFormattedPhoneNumber"];
            break;
        case 2:
            sRet = [[[UIDevice currentDevice] identifierForVendor] UUIDString];
            break;
            
        default:
            break;
    }
    return sRet;
}

-(NSString *) phoneNumber {
    
	NSString *phone = NULL; //CTSettingCopyMyPhoneNumber();

	

	//NSString *phone = [[UIDevice currentDevice] ];
	
	if (phone  == NULL){
		phone = @"iOS7";
	}
		
	
	
	//NSLog(@"Cell Phone %@",phone );
	
	
    return phone;
}


-(NSString*) sha1:(NSString*)input
{
    const char *cstr = [input cStringUsingEncoding:NSUTF8StringEncoding];
    NSData *data = [NSData dataWithBytes:cstr length:input.length];
    
    uint8_t digest[CC_SHA1_DIGEST_LENGTH];
    
    CC_SHA1(data.bytes, (unsigned int)data.length, digest);
    
    NSMutableString* output = [NSMutableString stringWithCapacity:CC_SHA1_DIGEST_LENGTH * 2];
    
    for(NSUInteger i = 0; i < CC_SHA1_DIGEST_LENGTH; i++)
        [output appendFormat:@"%02x", digest[i]];
    
    return output;
    
}

-(void)setPlist{
    
    NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
    NSString *documentsDirectory = [paths objectAtIndex:0];
    pathPList = [documentsDirectory stringByAppendingPathComponent:@"ConfigSIACGOB.plist"];
    NSFileManager *fileManager = [NSFileManager defaultManager];
    
    if (![fileManager fileExistsAtPath: pathPList])
    {
        pathPList = [documentsDirectory stringByAppendingPathComponent: [NSString stringWithFormat: @"ConfigSIACGOB.plist"] ];
        //NSLog(@"Creado" );
    }else{
        //NSLog(@"Ya estaba Creado" );
        
    }
    
    fileManager = [NSFileManager defaultManager];
    //NSMutableDictionary *data;
    
    if ([fileManager fileExistsAtPath: pathPList])
    {
        dataPList = [[NSMutableDictionary alloc] initWithContentsOfFile: pathPList];
        //NSLog(@"WTF!!" );
    }
    else
    {
        // If the file doesn’t exist, create an empty dictionary
        dataPList = [[NSMutableDictionary alloc] init];
        [dataPList writeToFile: pathPList atomically:YES];

    }
}
-(void)insertUser:(NSString *) User{
    ///// INSERTAR ////////
    
    //To insert the data into the plist
    NSString *Usr = User;
    [dataPList setObject:[NSString stringWithString:Usr] forKey:@"user"];
    [dataPList writeToFile: pathPList atomically:YES];
    //[data release];
    
}

-(void)deleteUser{

    ///// QUITAR /////////////
    //    NSMutableDictionary *plist = [NSMutableDictionary dictionaryWithCOntentsOfFile:pathToPlist];
    
    [dataPList removeObjectForKey:@"user"];
    [dataPList writeToFile:pathPList atomically:YES];
    
    
    
}

-(NSString *) getUser{
    
    
    //To reterive the data from the plist
    NSMutableDictionary *savedStock = [[NSMutableDictionary alloc] initWithContentsOfFile: pathPList];
    NSString *value1;
    value1 = [savedStock objectForKey:@"user"] ;
    
    //NSLog(@"%i",[value1 length] );
    
    //[savedStock release];
    return value1;

}

-(BOOL) validateEmail: (NSString *) candidate {
    NSString *emailRegex =
    @"(?:[a-z0-9!#$%\\&'*+/=?\\^_`{|}~-]+(?:\\.[a-z0-9!#$%\\&'*+/=?\\^_`{|}"
    @"~-]+)*|\"(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21\\x23-\\x5b\\x5d-\\"
    @"x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])*\")@(?:(?:[a-z0-9](?:[a-"
    @"z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5"
    @"]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-"
    @"9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\\x01-\\x08\\x0b\\x0c\\x0e-\\x1f\\x21"
    @"-\\x5a\\x53-\\x7f]|\\\\[\\x01-\\x09\\x0b\\x0c\\x0e-\\x7f])+)\\])";
    NSPredicate *emailTest = [NSPredicate predicateWithFormat:@"SELF MATCHES[c] %@", emailRegex];
    
    return [emailTest evaluateWithObject:candidate];
}

-(NSArray*)explodeString:(NSString*)stringToBeExploded WithDelimiter:(NSString*)delimiter
{
    return [stringToBeExploded componentsSeparatedByString: delimiter];
}

-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2{
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:titulo
                                                    message:mensaje delegate:self cancelButtonTitle:btn1
                                          otherButtonTitles:btn2, nil];
    [alert show];
    
}

-(NSString *)makeUniqueString{
    NSDateFormatter *dateFormatter = [[NSDateFormatter alloc] init];
    [dateFormatter setDateFormat:@"yyMMddHHmmss"];
    NSString *dateString = [dateFormatter stringFromDate:[NSDate date]];
    //[dateFormatter release];
    int randomValue = arc4random() % 100000;
    NSString *unique = [NSString stringWithFormat:@"%@h%d",dateString,randomValue];
    return unique;
}

-(int)intInRangeMinimum:(int)min andMaximum:(int)max {
    if (min > max) { return -1; }
    int adjustedMax = (max + 1) - min; // arc4random returns within the set {min, (max - 1)}
    int random = arc4random() % adjustedMax;
    int result = random + min;
    return result;
}
-(double)intInRangeDouble:(double)min andMaximum:(double)max {
    return (double)rand()/RAND_MAX * (max - min) + min;
}

@end
