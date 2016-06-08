//
//  FotosViewController.h
//  SiacGob
//
//  Created by DevCH on 12/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <MessageUI/MessageUI.h>
#import "HUD.h"
#import "Singleton.h"
#import "CellFoto.h"
#import "FotoDenunciasMasterViewController.h"
#import <QuartzCore/QuartzCore.h>


@interface FotosViewController : UICollectionViewController<UICollectionViewDataSource,UICollectionViewDelegate, NSURLConnectionDelegate, NSURLConnectionDataDelegate>
@property (strong, nonatomic) NSArray *datos;
@property (strong, nonatomic) IBOutlet UICollectionView *canvas;
@property (assign, nonatomic) BOOL ascending;
// @property (strong, nonatomic) IBOutlet UICollectionView *collectionView;



- (IBAction)RefreshData:(id)sender;

@property (nonatomic, retain) NSString *path;
@property (strong,nonatomic) Singleton *S;

@property (nonatomic)NSUInteger indice;
//- (void)CheckInternet;
@end
