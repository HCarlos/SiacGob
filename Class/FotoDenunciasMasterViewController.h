//
//  FotoDenunciasMasterViewController.h
//  SiacGob
//
//  Created by DevCH on 12/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Singleton.h"
#import "HUD.h"
#import <QuartzCore/QuartzCore.h>

@interface FotoDenunciasMasterViewController : UIViewController

@property (strong, nonatomic) IBOutlet UIActivityIndicatorView *ActPlay;
@property (strong, nonatomic) UIImage *Imagen;

@property (strong, nonatomic) NSString *lblArchivo;
@property (strong, nonatomic) NSString *ArchivoPlano;

@property(strong,nonatomic)NSString *txtDen;
@property(strong,nonatomic)NSString *lblFec;

@property (strong, nonatomic) IBOutlet UIImageView *txtImage;
@property (strong, nonatomic) IBOutlet UILabel *lblText;
@property (strong, nonatomic) IBOutlet UITextView *txtDenuncia;

@property (strong, nonatomic) IBOutlet UILabel *lblFecha;
@property (strong, nonatomic) IBOutlet UILabel *lblMeGusta;
@property (strong, nonatomic) IBOutlet UILabel *lblDomicilio;

@property (strong,nonatomic) Singleton *S;


- (IBAction)DeleteItem:(id)sender;

@end