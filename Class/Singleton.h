//
//  Singleton.h
//  New Financial Personal for iPad
//
//  Created by DevCH on 10/08/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "sqlite3.h"
#import <CoreLocation/CoreLocation.h>
#import <MobileCoreServices/MobileCoreServices.h>
#import <MobileCoreServices/UTCoreTypes.h>
#import <CoreLocation/CoreLocation.h>
#import <CommonCrypto/CommonDigest.h>

#define DBNAME  = @"dbNfP.sqlite";

@interface Singleton : NSObject <UIWebViewDelegate, UIAlertViewDelegate>{
	/*
	int IdEmpresa;
	NSString *NombreEmpresa;
	NSString *rutaDB;
	NSString *Descripcion;
	sqlite3 *DB;
	int IdMovto;
	int Mes;
	int Ano;
	NSMutableArray *arrAcum;
	int viewAcum;
	 */
	int IdIO;
    NSString *JS;
    CLLocation* loSelf;
    NSString *pathPList;
    NSMutableDictionary *dataPList;
    int Modulo;
    UIWebView* webView;
    int IdUser;
	BOOL IsDelete;
    

}
/*
@property (nonatomic, retain) NSString *rutaDB;
@property (nonatomic, retain) NSString *NombreEmpresa;
@property (nonatomic, retain) NSString *Descripcion;
@property (nonatomic) int IdEmpresa;
@property (nonatomic) int IdMovto;
@property (nonatomic) int Mes;
@property (nonatomic) int Ano;
@property (nonatomic) sqlite3 *DB;
@property (nonatomic, retain) NSMutableArray *arrAcum;
@property (nonatomic) int viewAcum;
 */
@property (nonatomic) int IdIO;
@property (nonatomic, retain) NSString *JS;
@property (nonatomic, copy) CLLocation* loSelf;
@property (nonatomic) int Modulo;
@property (nonatomic) int IdUser;
@property (nonatomic) int limFrom;
@property (nonatomic) int limCant;

@property (nonatomic) BOOL IsDelete;

@property(nonatomic,readonly,retain) NSString    *name;              // e.g. "My iPhone"
@property(nonatomic,readonly,retain) NSString    *model;             // e.g. @"iPhone", @"iPod Touch"
@property(nonatomic,readonly,retain) NSString    *localizedModel;    // localized version of model
@property(nonatomic,readonly,retain) NSString    *systemName;        // e.g. @"iPhone OS"
@property(nonatomic,readonly,retain) NSString    *systemVersion;     // e.g. @"2.0"
@property(nonatomic,readonly) UIDeviceOrientation orientation;       // return current device orientation
@property(nonatomic,retain) NSString    *typeDevice;  // a string unique to each device based on various
@property(nonatomic,retain) NSString    *uniqueIdentifier;  // a string unique to each device based on various
@property(nonatomic,retain) NSUUID *identifierForVendor;
@property(nonatomic,retain) NSString *domicilio;            // domicilio
@property(nonatomic,retain) NSString *tokenUser;              // e.g. "My iPhone"

@property(nonatomic,readonly,retain) NSMutableDictionary *dataPList;
@property(nonatomic,readonly,retain) NSString *pathPList;

@property(nonatomic,retain) UIWebView* webView;

+(Singleton*)sharedMySingleton;

- (BOOL) validateEmail: (NSString *) candidate;

-(CLLocation *) getLocation:(CLLocation *)Loc;

-(NSString *) getDeviceData:(int )field;

-(NSString*) sha1:(NSString*)input;
-(NSString *)makeUniqueString;

-(int)intInRangeMinimum:(int)min andMaximum:(int)max;
-(double)intInRangeDouble:(double)min andMaximum:(double)max;

-(void)setPlist;
-(void)insertUser:(NSString *) User;
-(void)deleteUser;

-(void)insertDataUser:(NSString *) numcell Domicilio:(NSString *) Domicilio FullName:(NSString * ) fullname;

-(NSString *) getUser;
-(NSString *) getFullName;
-(NSString *) getDomicilio;
-(NSString *) getNumCell;


-(NSArray*)explodeString:(NSString*)stringToBeExploded WithDelimiter:(NSString*)delimiter;

-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2;

@end
