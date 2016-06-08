//
//  CellFoto.h
//  SiacGob
//
//  Created by DevCH on 12/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <QuartzCore/QuartzCore.h>
#import "Singleton.h"

@interface CellFoto : UICollectionViewCell<NSURLConnectionDataDelegate>
@property (strong, nonatomic) IBOutlet UIImageView *imageView;
//@property (strong, nonatomic) IBOutlet UIImage *image;
@property (strong, nonatomic) IBOutlet UIActivityIndicatorView *ActPlay;
@property (strong, nonatomic) NSString *pathPhoto2;
@property (strong, nonatomic) NSString *pathPhoto3;

@property (strong, nonatomic) IBOutlet UILabel *lblText;
@property (strong, nonatomic) NSString *ArchivoPlano;
@property (strong,nonatomic) Singleton *S;

-(void) setPhoto:(NSString *)photo;
-(void) getImage;
-(void)displayImage:(UIImage *)image;

@end
