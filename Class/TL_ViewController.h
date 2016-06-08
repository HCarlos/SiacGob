//
//  TL_ViewController.h
//  SiacGob
//
//  Created by DevCH on 08/03/14.
//  Copyright (c) 2014 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <MessageUI/MessageUI.h>
#import "HUD.h"
#import "Singleton.h"
#import "TL_Cell.h"
#import <QuartzCore/QuartzCore.h>
#import "imageViewController.h"

@interface TL_ViewController : UITableViewController<NSURLConnectionDelegate, NSURLConnectionDataDelegate,UITableViewDataSource, UITableViewDelegate>
@property (strong, nonatomic) NSMutableArray *datos;
@property (assign, nonatomic) BOOL ascending;
@property (strong, nonatomic) IBOutlet UILabel *lblTitulo;
@property (strong, nonatomic) IBOutlet UITableView *canvas;
@property (strong, nonatomic) TL_Cell *celda;

@property (nonatomic, retain) NSString *path;
@property (strong,nonatomic) Singleton *S;

@property (nonatomic)NSUInteger indice;

-(void)reloadData;
-(void)getData;

@end
