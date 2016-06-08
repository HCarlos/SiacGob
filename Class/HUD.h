#import "MBProgressHUD.h"
@interface HUD : NSObject

+(MBProgressHUD*)showUIBlockingIndicator;
+(MBProgressHUD*)showUIBlockingIndicatorWithText:(NSString*)str;
+(MBProgressHUD*)showUIBlockingIndicatorWithText:(NSString*)str withTimeout:(int)seconds;

+(MBProgressHUD*)showUIBlockingProgressIndicatorWithText:(NSString*)str andProgress:(float)progress;

+(MBProgressHUD*)showAlertWithTitle:(NSString*)titleText text:(NSString*)text;
+(MBProgressHUD*)showTimedAlertWithTitle:(NSString*)titleText text:(NSString*)text withTimeout:(int)seconds;
+(MBProgressHUD*)showAlertWithTitle:(NSString*)titleText text:(NSString*)text target:(id)t action:(SEL)sel;

+(void)hideUIBlockingIndicator;

@end