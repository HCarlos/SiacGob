//
//  TL_Cell.m
//  SiacGob
//
//  Created by DevCH on 08/03/14.
//  Copyright (c) 2014 DevCH. All rights reserved.
//

#import "TL_Cell.h"
#import <QuartzCore/QuartzCore.h>
#import "Singleton.h"


@interface TL_Cell (){
    NSMutableData *receivedData;
	BOOL conn;
	NSString *photo_;
	
}
@end
@implementation TL_Cell

@synthesize contentCell, scrollView, imageView,txtDenuncia,ActPlay,ArchivoPlano,pathPhoto2,pathPhoto3,toolbar;

- (id)initWithStyle:(UITableViewCellStyle)style reuseIdentifier:(NSString *)reuseIdentifier
{
    self = [super initWithStyle:style reuseIdentifier:reuseIdentifier];

    if (self) {
        // Initialization code
		
    }
    return self;
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated
{
    [super setSelected:selected animated:animated];

    // Configure the view for the selected state
}

-(void) setPhoto:(NSString *)pathPhoto{

	self.S  = [Singleton sharedMySingleton];
	conn = false;

	UIColor *color = [UIColor colorWithHue:[self.S intInRangeDouble:0.00 andMaximum:1.00]
								saturation:[self.S intInRangeDouble:0.00 andMaximum:1.00]
								brightness:[self.S intInRangeDouble:0.00 andMaximum:1.00]
									 alpha:[self.S intInRangeDouble:0.00 andMaximum:1.00]];
	
	[self.ActPlay setHidden:NO];
	[self.ActPlay setHidesWhenStopped:YES];
	[self.ActPlay setClearsContextBeforeDrawing:YES];
	[self.ActPlay startAnimating];
	self.imageView.layer.cornerRadius=4.0f;
	self.imageView.layer.masksToBounds=YES;
	self.imageView.backgroundColor=color;
	self.imageView.layer.borderColor=(__bridge CGColorRef)(color);
	self.imageView.layer.borderWidth= 0.5f;
	self.scrollView.layer.cornerRadius=5.0f;
	self.scrollView.layer.masksToBounds=YES;
	
	//self.txtDenuncia.lineBreakMode = NSLineBreakByWordWrapping;
	//self.txtDenuncia.numberOfLines = 3;
	
	//CGRect bounds = toolbar.bounds;
	//bounds.size.height = 30.0;
	
	 //[self.toolbar setFrame:bounds] ;
	
	self.pathPhoto2 = pathPhoto;
	
	NSArray *arrExplode = [self.S explodeString:pathPhoto WithDelimiter:@"."];
    
	NSString *path2 = [[NSString alloc] initWithFormat: @"http://siac.tabascoweb.com/upload/%@-s.%@",[arrExplode objectAtIndex: 0],[arrExplode objectAtIndex: 1]];
	
	
	NSString *path3 = [[NSString alloc] initWithFormat: @"%@-s.%@",[arrExplode objectAtIndex: 0],[arrExplode objectAtIndex: 1]];
	
	NSFileManager *fileManager = [NSFileManager defaultManager];
	NSString *documentsDirectory = [NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES) objectAtIndex:0];
	NSString *path = [documentsDirectory stringByAppendingPathComponent:path3];

	self.pathPhoto2 = path2;
	self.pathPhoto3 = path3;
	
	if(![fileManager fileExistsAtPath:path]){
		

		//self.contentCell.layer.borderColor=[[UIColor whiteColor]CGColor];
		//self.contentCell.layer.borderWidth= 1.0f;

		NSOperationQueue *queue = [NSOperationQueue new];
		NSInvocationOperation *operation = [[NSInvocationOperation alloc]
											initWithTarget:self
											selector:@selector(getImage)
											object:nil];
		[queue addOperation:operation];
		//[operation cancel];
		//[queue cancelAllOperations];
		
		//[self getImage];
		
	}else{
		/*
		NSArray *paths = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory,
															 NSUserDomainMask, YES);
		NSString *documentsDirectory = [paths objectAtIndex:0];
		NSString* path = [documentsDirectory stringByAppendingPathComponent:
						  self.pathPhoto3 ];
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
	
	
	
}

-(void) getImage{
	@try
	{
		
	NSData* serverImage = [[NSData alloc] initWithContentsOfURL:[NSURL URLWithString:self.pathPhoto2]];
	UIImage* image = [[UIImage alloc] initWithData:serverImage] ;
	[self performSelectorOnMainThread:@selector(displayImage:) withObject:image waitUntilDone:NO];
	}
	@catch (NSException *theException)
	{
		NSLog(@"Cell Exception: %@", theException);
	}
		
}

- (void)displayImage:(UIImage *)image {
	[self.imageView setImage:image]; //UIImageView
	[self.ActPlay stopAnimating];
}

@end
