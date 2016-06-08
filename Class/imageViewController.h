//
//  imageViewController.h
//  SiacGob
//
//  Created by DevCH on 11/03/14.
//  Copyright (c) 2014 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Singleton.h"

@interface imageViewController : UIViewController<NSURLConnectionDelegate, NSURLConnectionDataDelegate>
@property (strong, nonatomic) NSMutableArray *datos;

@property (nonatomic) NSInteger iddenuncia;
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

-(void)getData;


- (IBAction)btnRegresar:(id)sender;

@end
