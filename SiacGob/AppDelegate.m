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

@implementation AppDelegate

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {
	// Let the device know we want to receive push notifications

	
    // Nos registramos para recibir las notificaciones Push de los tipos especificados
    /*
    [[UIApplication sharedApplication] registerForRemoteNotificationTypes:(UIRemoteNotificationTypeAlert | UIRemoteNotificationTypeBadge | UIRemoteNotificationTypeSound)];
	*/
    
	self.S  = [Singleton sharedMySingleton];
	self.S.limFrom = 0;
	self.S.limCant = 20;
	
    return YES;
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

- (void)applicationDidBecomeActive:(UIApplication *)application
{
    // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
}

- (void)applicationWillTerminate:(UIApplication *)application
{
    // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
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



- (void)application:(UIApplication *)application didRegisterForRemoteNotificationsWithDeviceToken:(NSData *)deviceToken
{
    // NSLog(@"Mi device token es %@", deviceToken);
    // NSLog(@"Remote Notification Recieved");
	self.S.tokenUser = [[NSString alloc] initWithFormat:@"%@",deviceToken] ;
	
	NSString *new = [self.S.tokenUser stringByReplacingOccurrencesOfString: @" " withString:@""];
	new = [new stringByReplacingOccurrencesOfString: @"<" withString:@""];
	new = [new stringByReplacingOccurrencesOfString: @">" withString:@""];
	self.S.tokenUser = new;
    //NSLog(@"Mi device token es %@", self.S.tokenUser );
	
}

// Lo podemos comprobar en el simulador ya que en este no podemos probar las notificaciones Push
- (void)application:(UIApplication *)application didFailToRegisterForRemoteNotificationsWithError:(NSError *)error
{
    //NSLog(@"Error al obtener el token. Error: %@", error);
}

- (void)application:(UIApplication *)application didReceiveRemoteNotification:(NSDictionary *)userInfo
{
	
    NSLog(@"Contenido del JSON: %@", userInfo);
    UILocalNotification *notification = [[UILocalNotification alloc] init];
    notification.alertBody =  @"Looks like i got a notification - fetch thingy";
    [application presentLocalNotificationNow:notification];
    //completionHandler(UIBackgroundFetchResultNewData);
	 
	
}


-(void)willAppearIn:(UIWindow *)navigationController
{
    //[self addCenterButtonWithImage:[UIImage imageNamed:@"cameraTabBarItem.png"] highlightImage:nil];
	//[self addCenterButtonWithImage:[UIImage imageNamed:@"camera_button_take.png"] highlightImage:nil];
}



@end
