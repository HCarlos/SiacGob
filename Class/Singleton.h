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
	int IdEmpresa;
	NSString *NombreEmpresa;
	NSString *rutaDB;
	int IdIO;
	NSString *Descripcion;
    NSString *JS;
	sqlite3 *DB;
	int IdMovto;
	int Mes;
	int Ano;
	NSMutableArray *arrAcum;
	int viewAcum;
    CLLocation* loSelf;
    NSString *pathPList;
    NSMutableDictionary *dataPList;
    int Modulo;
    UIWebView* webView;
    int IdUser;
    

}
@property (nonatomic, retain) NSString *rutaDB;
@property (nonatomic, retain) NSString *NombreEmpresa;
@property (nonatomic, retain) NSString *Descripcion;
@property (nonatomic, retain) NSString *JS;
@property (nonatomic) int IdEmpresa;
@property (nonatomic) int IdIO;
@property (nonatomic) int IdMovto;
@property (nonatomic) int Mes;
@property (nonatomic) int Ano;
@property (nonatomic) sqlite3 *DB;
@property (nonatomic, retain) NSMutableArray *arrAcum;
@property (nonatomic) int viewAcum;
@property (nonatomic, copy) CLLocation* loSelf;
@property (nonatomic) int Modulo;
@property (nonatomic) int IdUser;

@property(nonatomic,readonly,retain) NSString    *name;              // e.g. "My iPhone"
@property(nonatomic,readonly,retain) NSString    *model;             // e.g. @"iPhone", @"iPod Touch"
@property(nonatomic,readonly,retain) NSString    *localizedModel;    // localized version of model
@property(nonatomic,readonly,retain) NSString    *systemName;        // e.g. @"iPhone OS"
@property(nonatomic,readonly,retain) NSString    *systemVersion;     // e.g. @"2.0"
@property(nonatomic,readonly) UIDeviceOrientation orientation;       // return current device orientation
@property(nonatomic,readonly,retain) NSString    *uniqueIdentifier;  // a string unique to each device based on various 
@property(nonatomic, readonly, retain) NSUUID *identifierForVendor;
@property(nonatomic,readonly,retain) NSMutableDictionary *dataPList;
@property(nonatomic,readonly,retain) NSString *pathPList;
@property(nonatomic,retain) UIWebView* webView;


+(Singleton*)sharedMySingleton;

- (BOOL) validateEmail: (NSString *) candidate;

-(CLLocation *) getLocation:(CLLocation *)Loc;

-(NSString *) getDeviceData:(int )field;

-(NSString*) sha1:(NSString*)input;
-(NSString *)makeUniqueString;

-(void)setPlist;
-(void)insertUser:(NSString *) User;
-(void)deleteUser;
-(NSString *) getUser;
-(NSArray*)explodeString:(NSString*)stringToBeExploded WithDelimiter:(NSString*)delimiter;

-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2;

@end
