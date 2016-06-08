//
//  CellFoto.m
//  SiacGob
//
//  Created by DevCH on 12/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "CellFoto.h"
#import <QuartzCore/QuartzCore.h>
#import "Singleton.h"

@interface CellFoto (){
    NSMutableData *receivedData;
	BOOL conn;
	NSString *photo_;
}


@end

@implementation CellFoto
@synthesize imageView,lblText,ActPlay,ArchivoPlano,pathPhoto2, pathPhoto3;



- (id)initWithFrame:(CGRect)frame
{
    self = [super initWithFrame:frame];
    if (self) {
        // Initialization code
        //[self.ActPlay startAnimating];

    }
    return self;
}



-(void) setPhoto:(NSString *)photo {

	self.S  = [Singleton sharedMySingleton];
	conn = false;

	[self.ActPlay setHidden:NO];
	[self.ActPlay setHidesWhenStopped:YES];
	[self.ActPlay setClearsContextBeforeDrawing:YES];
	[self.ActPlay startAnimating];
	
	UIColor *color = [UIColor colorWithHue:[self.S intInRangeDouble:0.00 andMaximum:1.00]
								saturation:[self.S intInRangeDouble:0.00 andMaximum:1.00]
								brightness:[self.S intInRangeDouble:0.00 andMaximum:1.00]
									 alpha:[self.S intInRangeDouble:0.00 andMaximum:1.00]];
	
	NSArray *arrExplode = [self.S explodeString:photo WithDelimiter:@"."];
    
	NSString *path2 = [[NSString alloc] initWithFormat: @"http://siac.tabascoweb.com/upload/%@-mini.%@",[arrExplode objectAtIndex: 0],[arrExplode objectAtIndex: 1]];
	

	NSString *path3 = [[NSString alloc] initWithFormat: @"%@-mini.%@",[arrExplode objectAtIndex: 0],[arrExplode objectAtIndex: 1]];
	
	NSFileManager *fileManager = [NSFileManager defaultManager];
	NSString *documentsDirectory = [NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES) objectAtIndex:0];
	NSString *path = [documentsDirectory stringByAppendingPathComponent:path3];

	self.pathPhoto2 = path2;
	self.pathPhoto3 = path3;

	
	if(![fileManager fileExistsAtPath:path]){
	
		UIImage* serverImage = [UIImage imageWithData:[NSData dataWithContentsOfURL:[NSURL URLWithString: path2]]];
		self.imageView.image = serverImage;
		self.imageView.layer.cornerRadius=8.0f;
		self.imageView.layer.masksToBounds=YES;
		
		//self.imageView.backgroundColor=color;
		[self.imageView setBackgroundColor:color];
		
		self.imageView.layer.borderColor=(__bridge CGColorRef)(color);
		self.imageView.layer.borderWidth= 1.0f;

		NSOperationQueue *queue = [NSOperationQueue new];
		NSInvocationOperation *operation = [[NSInvocationOperation alloc]
											initWithTarget:self
											selector:@selector(getImage)
											object:nil];
		[queue addOperation:operation];
		//[operation finalize];
		
		/*
		NSData *imageData = UIImageJPEGRepresentation(serverImage, 0.2);     //change Image to NSData
		
		[imageData writeToFile:[[NSString alloc] initWithFormat:@"/private/var/mobile/Media/DCIM/100APPLE/%@",path3] atomically:NO];
		NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES);
		NSString *documentsDirectory = [paths objectAtIndex:0];
		NSString *filePath2 = [NSString stringWithFormat:@"%@/%@", documentsDirectory, path3];
		[imageData writeToFile:filePath2 atomically:NO];
		NSLog(@"Save Image: %@",filePath2);
		 */
		
	}else{
		/*
		NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory,
															 NSUserDomainMask, YES);
		NSString *documentsDirectory = [paths objectAtIndex:0];
		NSString* path = [documentsDirectory stringByAppendingPathComponent:
						  path3 ];
		UIImage* serverImage = [UIImage imageWithContentsOfFile:path];

		[self.imageView setImage: serverImage];//[UIImage imageWithData:[NSData dataWithData:serverImage]];
		self.imageView.layer.cornerRadius=8.0f;
		self.imageView.layer.masksToBounds=YES;
		self.imageView.backgroundColor=[UIColor lightGrayColor];
		self.imageView.layer.borderColor=[[UIColor blackColor]CGColor];
		self.imageView.layer.borderWidth= 1.0f;
		NSLog(@"Image Load: %@",path);
		 */

	}
		 
	//[self.ActPlay stopAnimating];
    
    
}

-(void) getImage{
	NSData* serverImage = [[NSData alloc] initWithContentsOfURL:[NSURL URLWithString:self.pathPhoto2]];
	UIImage* image = [[UIImage alloc] initWithData:serverImage] ;
	[self performSelectorOnMainThread:@selector(displayImage:) withObject:image waitUntilDone:YES];
}

-(void)displayImage:(UIImage *)image {
	[self.imageView setImage:image]; //UIImageView
	[self.ActPlay stopAnimating];
}


@end
