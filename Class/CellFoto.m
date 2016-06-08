//
//  CellFoto.m
//  SiacGob
//
//  Created by DevCH on 12/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "CellFoto.h"
#import <QuartzCore/QuartzCore.h>

@interface CellFoto (){
    NSMutableData *receivedData;
	BOOL conn;
}


@end

@implementation CellFoto
@synthesize imageView,lblText,image,ActPlay,ArchivoPlano;



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

	/*
    NSMutableURLRequest *theRequest=[NSMutableURLRequest requestWithURL:[NSURL URLWithString:photo]
                                              cachePolicy:NSURLRequestUseProtocolCachePolicy
                                          timeoutInterval:600.0];
    
    NSURLConnection *theConnection=[[NSURLConnection alloc] initWithRequest:theRequest delegate:self];
    
    [theConnection start];
    
    if (theConnection) {
        //receivedData=[[NSMutableData data] retain];
    } else {
        // inform the user that the download could not be made
    }
	 */
	
	conn = false;

	NSMutableURLRequest *theRequest = [NSMutableURLRequest requestWithURL:[NSURL URLWithString:photo]
												  cachePolicy:NSURLRequestReloadIgnoringLocalAndRemoteCacheData timeoutInterval:6000.0];
	
	NSURLConnection *theConnection = [[NSURLConnection alloc] initWithRequest:theRequest delegate:self];
	
	if (theConnection)
	{
		receivedData = [[NSMutableData data] self];
	}
    
    
}

- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data;
{
    // append the new data to the receivedData
    // receivedData is declared as a method instance elsewhere
   // [receivedData appendData:data];
    
    self.imageView.image = [UIImage imageWithData:[NSData dataWithData:data]];
    self.imageView.layer.cornerRadius=8.0f;
    self.imageView.layer.masksToBounds=YES;
    self.imageView.backgroundColor=[UIColor lightGrayColor];
    self.imageView.layer.borderColor=[[UIColor blackColor]CGColor];
    self.imageView.layer.borderWidth= 1.0f;

    
    [self.ActPlay stopAnimating];
    
    
}

- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error{
   // [connection finalize];
}
- (void)connectionDidFinishLoading:(NSURLConnection *)connection{
    //[connection finalize];
}
-(void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response{
    //
}



@end
