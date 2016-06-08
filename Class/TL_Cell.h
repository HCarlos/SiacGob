//
//  TL_Cell.h
//  SiacGob
//
//  Created by DevCH on 08/03/14.
//  Copyright (c) 2014 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <QuartzCore/QuartzCore.h>
#import "Singleton.h"

@interface TL_Cell : UITableViewCell
//@property (strong, nonatomic) IBOutlet UIImageView *imageView;
@property (strong, nonatomic) IBOutlet UIImageView *imageView;
@property (strong, nonatomic) IBOutlet UIView *contentCell;

@property (strong, nonatomic) IBOutlet UIActivityIndicatorView *ActPlay;
@property (strong, nonatomic) IBOutlet UILabel *txtDenuncia;

@property (strong, nonatomic) NSString *ArchivoPlano;
@property (strong, nonatomic) NSString *pathPhoto2;
@property (strong, nonatomic) NSString *pathPhoto3;
@property (strong,nonatomic) Singleton *S;
@property (strong, nonatomic) IBOutlet UIScrollView *scrollView;
@property (strong, nonatomic) IBOutlet UIToolbar *toolbar;

@property (strong, nonatomic) IBOutlet UIButton *lblUser;

@property (strong, nonatomic) IBOutlet UIButton *lblFecha;

-(void) setPhoto:(NSString *)pathPhoto;
-(void) getImage;
- (void)displayImage:(UIImage *)image;
@end
