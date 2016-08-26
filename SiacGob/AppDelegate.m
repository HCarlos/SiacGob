//
//  AppDelegate.m
//  SiacGob
//
//  Created by DevCH on 03/08/13.
//  Copyright (c) 2013 DevCH. All rights reserved.
//

#import "AppDelegate.h"
#import "FotoDenunciasMasterViewController.h"
#import "Singleton.h"
#import <FBSDKCoreKit/FBSDKCoreKit.h>

@interface AppDelegate ()

@end

@implementation AppDelegate
@synthesize S;

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {
	// Let the device know we want to receive push notifications

    [UIApplication sharedApplication].applicationIconBadgeNumber = 0;
	
    if (launchOptions != nil)
    {
        NSDictionary* dictionary = [launchOptions objectForKey:UIApplicationLaunchOptionsRemoteNotificationKey];
        if (dictionary != nil)
        {
            NSLog(@"Launched from push notification: %@", dictionary);
            
            [self clearNotifications];
        }
    }else{
        
        self.S  = [Singleton sharedMySingleton];
        [self.S setPlist];
        
        
        UIDevice *myDevice=[UIDevice currentDevice];
        NSString *UUID = [[myDevice identifierForVendor] UUIDString];
        
        self.S.uniqueIdentifier = UUID;
        self.S.typeDevice = @"1";
        // NSLog(@"UUID: %@",UUID);
        
        myDevice = nil;
        UUID = nil;
        
        if ([application respondsToSelector:@selector(registerUserNotificationSettings:)]) {
#ifdef __IPHONE_8_0
            UIUserNotificationSettings *settings = [UIUserNotificationSettings settingsForTypes:(UIUserNotificationTypeAlert
                                                                                                 | UIUserNotificationTypeBadge
                                                                                                 | UIUserNotificationTypeSound) categories:nil];
            [application registerUserNotificationSettings:settings];
#endif
            
        } else {
            
            /*
             
             UIRemoteNotificationType myTypes = UIRemoteNotificationTypeBadge | UIRemoteNotificationTypeAlert | UIRemoteNotificationTypeSound;
             [application registerForRemoteNotificationTypes:myTypes];
             
             */
            
        }
        
    }
    
    
	self.S  = [Singleton sharedMySingleton];
	self.S.limFrom = 0;
	self.S.limCant = 20;
	
    [[FBSDKApplicationDelegate sharedInstance] application:application
                             didFinishLaunchingWithOptions:launchOptions];
    
    return YES;
}

- (BOOL)application:(UIApplication *)application openURL:(NSURL *)url
  sourceApplication:(NSString *)sourceApplication annotation:(id)annotation {
    
    BOOL handled = [[FBSDKApplicationDelegate sharedInstance] application:application
                                                                  openURL:url
                                                        sourceApplication:sourceApplication
                                                               annotation:annotation
                    ];
    // Add any custom logic here.
    return handled;
}

- (void)applicationDidBecomeActive:(UIApplication *)application {
    [FBSDKAppEvents activateApp];
}

#ifdef __IPHONE_8_0
- (void)application:(UIApplication *)application didRegisterUserNotificationSettings:(UIUserNotificationSettings *)notificationSettings
{
    //register to receive notifications
    [application registerForRemoteNotifications];
}

- (void)application:(UIApplication *)application handleActionWithIdentifier:(NSString *)identifier forRemoteNotification:(NSDictionary *)userInfo completionHandler:(void(^)())completionHandler
{
    //handle the actions
    if ([identifier isEqualToString:@"declineAction"]){
    }
    else if ([identifier isEqualToString:@"answerAction"]){
    }
}
#endif

- (void)application:(UIApplication *)application didRegisterForRemoteNotificationsWithDeviceToken:(NSData *)deviceToke{
    self.S.tokenUser = [[NSString alloc] initWithFormat:@"%@",deviceToke] ;
    
    NSString *new = [self.S.tokenUser stringByReplacingOccurrencesOfString: @" " withString:@""];
    new = [new stringByReplacingOccurrencesOfString: @"<" withString:@""];
    new = [new stringByReplacingOccurrencesOfString: @">" withString:@""];
    self.S.tokenUser = new;
    
}

-(void)application:(UIApplication *)application didFailToRegisterForRemoteNotificationsWithError:(NSError *)error{
    
}

- (void)application:(UIApplication *)application didReceiveRemoteNotification:(NSDictionary *)userInfo fetchCompletionHandler:(void (^)(UIBackgroundFetchResult))completionHandler
{
    NSLog(@"Remote Notification Recieved...");
    UILocalNotification *notification = [[UILocalNotification alloc] init];
    //notification.alertBody =  @"Looks like i got a notification - fetch thingy";
    [application presentLocalNotificationNow:notification];
    completionHandler(UIBackgroundFetchResultNewData);
    /*
     UIAlertView *alertView = [[UIAlertView alloc]initWithTitle:@"Título"
     message:@"Esto es una prueba"
     delegate:self
     cancelButtonTitle:@"Aceptar"
     otherButtonTitles:@"Botón 1", @"Botón 2", nil];
     [alertView show];
     */
}

- (void)application:(UIApplication *)application didReceiveRemoteNotification:(NSDictionary *)userInfo
{
    
    NSLog(@"Contenido del JSON: %@", userInfo);
    UILocalNotification *notification = [[UILocalNotification alloc] init];
    notification.alertBody =  @"Looks like i got a notification - fetch thingy";
    [application presentLocalNotificationNow:notification];
    //completionHandler(UIBackgroundFetchResultNewData);
    
    
}

/*
- (void)loadImage { NSData* imageData = [[NSData alloc] initWithContentsOfURL:[NSURL URLWithString:@"imageurl.jpg"]]; UIImage* image = [[[UIImage alloc] initWithData:imageData] autorelease]; [imageData release]; [self performSelectorOnMainThread:@selector(displayImage:) withObject:image waitUntilDone:NO]; }
- (void)displayImage:(UIImage *)image { [imageView setImage:image]; //UIImageView }
*/

- (void)applicationWillResignActive:(UIApplication *)application
{
    // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
    // Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
}

- (void)applicationDidEnterBackground:(UIApplication *)application
{
    // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later. 
    // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
}

- (void)applicationWillEnterForeground:(UIApplication *)application
{
    // Called as part of the transition from the background to the inactive state; here you can undo many of the changes made on entering the background.
}

- (void)applicationWillTerminate:(UIApplication *)application
{
    // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
}

-(void)willAppearIn:(UIWindow *)navigationController
{
    //[self addCenterButtonWithImage:[UIImage imageNamed:@"cameraTabBarItem.png"] highlightImage:nil];
	//[self addCenterButtonWithImage:[UIImage imageNamed:@"camera_button_take.png"] highlightImage:nil];
}

- (void) clearNotifications {
    [[UIApplication sharedApplication] setApplicationIconBadgeNumber: 0];
    [[UIApplication sharedApplication] cancelAllLocalNotifications];
}



@end
