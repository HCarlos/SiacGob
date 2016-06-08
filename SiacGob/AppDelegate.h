//
//  AppDelegate.h
//  SiacGob
//
//  Created by DevCH on 03/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Singleton.h"

@interface AppDelegate : UIResponder <UIApplicationDelegate>

@property (strong, nonatomic) UIWindow *window;
@property (strong,nonatomic) Singleton *S;

@end
