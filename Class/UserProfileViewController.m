//
//  UserProfileViewController.m
//  SiacGob
//
//  Created by Carlos Hidalgo on 25/08/16.
//  Copyright © 2016 DevCH. All rights reserved.
//

#import "UserProfileViewController.h"
#import "Singleton.h"

@interface UserProfileViewController (){
    NSMutableData *receivedData_;
}

@end

@implementation UserProfileViewController
@synthesize txtNumeroCelular, txtFullName, txtDomicilio, S;
- (void)viewDidLoad
{
    [super viewDidLoad];
    
    self.S  = [Singleton sharedMySingleton];
    
    UIToolbar *toolbar = [[UIToolbar alloc] init];
    [toolbar setBarStyle:UIBarStyleBlack];
    [toolbar sizeToFit];
    
    UIBarButtonItem *space = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemFlexibleSpace target:nil action:nil];
    
    UIBarButtonItem *closebuttom = [[UIBarButtonItem alloc] initWithTitle:@"Ocultar" style:UIBarButtonItemStyleDone target:self action:@selector(HideKeyBoard)];
    
    [toolbar setItems:[NSArray arrayWithObjects:space,closebuttom, nil]];
    
    [self.txtNumeroCelular setText:S.getNumCell];
    [self.txtDomicilio setText:S.getDomicilio];
    [self.txtFullName setText:S.getFullName];
    
    [[self txtFullName]setInputAccessoryView:toolbar];
    [[self txtDomicilio]setInputAccessoryView:toolbar];
    [[self txtNumeroCelular]setInputAccessoryView:toolbar];
    [self.txtFullName becomeFirstResponder];
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

-(void)HideKeyBoard{
    if ([self.view endEditing:NO]) {
        [self.view endEditing:YES ];
    } else {
        [self.view endEditing:NO];
    }
    
}

- (IBAction)cmdSaveData:(id)sender{
    NSLog(@"Hola");
    [self updateDataUser];
    NSLog(@"Mundo");
}

-(NSData*)generateFormDataFormPostDictionary:(NSDictionary*)dictionary{
    NSMutableArray *parts = [[NSMutableArray alloc] init];
    for (NSString *key in dictionary) {
        NSString *encodedValue = [[dictionary objectForKey:key] stringByAddingPercentEscapesUsingEncoding:NSUTF8StringEncoding];
        NSString *encodedKey = [key stringByAddingPercentEscapesUsingEncoding:NSUTF8StringEncoding];
        NSString *part = [NSString stringWithFormat: @"%@=%@", encodedKey, encodedValue];
        [parts addObject:part];
    }
    NSString *encodedDictionary = [parts componentsJoinedByString:@"&"];
    return [encodedDictionary dataUsingEncoding:NSUTF8StringEncoding];
    
}


-(void)updateDataUser{
    
    //Create String
    
    NSString *fullName = self.txtFullName.text;
    NSString *domiclio = self.txtDomicilio.text;
    NSString *numCell = self.txtNumeroCelular.text;
    NSString *username = [S getUser];
    
    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
    
    // [HUD showUIBlockingIndicatorWithText:@"Login"];
    
    NSMutableDictionary *postDix=[[NSMutableDictionary alloc] init];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",fullName] forKey:@"fullname"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",domiclio] forKey:@"domicilio"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",numCell]  forKey:@"celular"];
    [postDix setObject:[[NSString alloc] initWithFormat: @"%@",username] forKey:@"username"];
    
    NSLog(@"Username: %@",username);
    
    NSURL *url = [NSURL URLWithString:@"http://siac.tabascoweb.com/setiOSUserData/"];
    
    NSData *postData = [self generateFormDataFormPostDictionary:postDix];
    
    
    // Create the request
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url];
    [request setHTTPMethod:@"POST"];
    [request setValue:[NSString stringWithFormat:@"%luu",(unsigned long) (unsigned long)postData.length] forHTTPHeaderField:@"Content-Length"];
    [request setValue:@"application/x-www-form-urlencoded charset=utf-8" forHTTPHeaderField:@"Content-Type"];
    [request setHTTPBody:postData];
    
    NSURLConnection *connection = [[NSURLConnection alloc] initWithRequest:request
                                                                  delegate:self];
    [connection start];

    
}

- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    NSLog(@"AQUI 4");
    [receivedData_ setLength:0];
}

//Recibe de los datos después de guardar...
- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data {
    [receivedData_ appendData:data];
    
    NSLog(@"AQUI 5");

    NSError *jsonError = nil;
    id jsonObject = [NSJSONSerialization JSONObjectWithData:data options:kNilOptions error:&jsonError];
    
    if ([jsonObject isKindOfClass:[NSArray class]]) {
        NSArray *jsonArray = (NSArray *)jsonObject;
        NSLog(@"jsonArray - %@",jsonArray);
        NSLog(@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]);
        NSString *msg = [[NSString alloc] initWithFormat:@"%@",[[jsonArray objectAtIndex:0]objectForKey:@"msg"]] ;
        if ([msg isEqualToString:@"OK"]){

            NSString *fullName = self.txtFullName.text;
            NSString *domiclio = self.txtDomicilio.text;
            NSString *numCell = self.txtNumeroCelular.text;
            
            [S insertDataUser:numCell Domicilio:domiclio FullName:fullName ];
            
            [self alertStatus:@"Gracias" Mensaje:@"Gracias por actualizar sus datos, en breve nos estaremos comunicando con usted." Button1:nil Button2:@"OK"];
            
        }else{
            [self alertStatus:@"Error" Mensaje:msg Button1:nil Button2:@"OK"];
        }
    }
    else {
        NSDictionary *jsonDictionary = (NSDictionary *)jsonObject;
        NSLog(@"jsonDictionary - %@",jsonDictionary);
    }
    
    
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    NSLog(@"AQUI 7");
    // [HUD hideUIBlockingIndicator];
}

- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error{

    NSLog(@"AQUI 6");
    
    [connection finalize];
    
    NSString *msg = [[NSString alloc] initWithFormat:@"Connection failed! Error - %@ %@",
                     [error localizedDescription],
                     [[error userInfo] objectForKey:NSURLErrorFailingURLStringErrorKey]];
    [self alertStatus:@"Error" Mensaje:msg Button1:nil Button2:@"OK"];
    
}

-(void)alertStatus:(NSString *)titulo Mensaje:(NSString *)mensaje Button1:(NSString *)btn1 Button2:(NSString *)btn2{
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:titulo
                                                    message:mensaje delegate:self cancelButtonTitle:btn1
                                          otherButtonTitles:btn2, nil];
    [alert show];
    
}





@end
