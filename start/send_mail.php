<!DOCTYPE html>
<html lang="en">
<?php 
require_once "../config.php";
require("../PHPMailer/src/Exception.php");
require("../PHPMailer/src/PHPMailer.php");
require("../PHPMailer/src/SMTP.php");

session_start();


$event_id = $_GET[ 'event_id' ];
$guest_id = $_GET[ 'guest_id' ];
$email = $_GET[ 'guest_email' ];


        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
      
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        //$mail->Host = "smtp.gmail.com";
        $mail->Host = "ssl://smtp.gmail.com"; 
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "ana7bratucu@gmail.com";
        $mail->Password = "gotony1997";
        $mail->SetFrom("ana7bratucu@gmail.com");
        $mail->Subject = "Event Invitation RSVP";
        $mail->AddEmbeddedImage('images/logo4.png', 'logoimg', 'logo4.png');
        $mail->AddEmbeddedImage('images/try.png', 'flowerimg', 'try.png');
        $mail->AddEmbeddedImage('images/facebook2x.png', 'fb', 'facebook2x.png');
        $mail->AddEmbeddedImage('images/twitter2x.png', 'twitter', 'twitter2x.png');
        $mail->AddEmbeddedImage('images/instagram2x.png', 'insta', 'instagram2x.png');
        $mail->AddEmbeddedImage('images/linkedin2x.png', 'linked', 'linkedin2x.png');
        //$htmlContent = file_get_contents('invitations/index_' . $_SESSION[ 'username' ] . '.html');
        $mail->Body = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
        <head>
        <link href="https://fonts.googleapis.com/css?family=Abril Fatface" rel="stylesheet" type="text/css"/>
        <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
        <meta content="width=device-width" name="viewport"/>
        <!--[if !mso]><!-->
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <!--<![endif]-->
        <title></title>
        <!--[if !mso]><!-->
        
        <!--<![endif]-->
        <style type="text/css">
                body {
                    margin: 0;
                    padding: 0;
                    font-family: "Abril Fatface";
                }
        
                table,
                td,
                tr {
                    vertical-align: top;
                    border-collapse: collapse;
                }
        
                * {
                    line-height: inherit;
                }
        
                a[x-apple-data-detectors=true] {
                    color: inherit !important;
                    text-decoration: none !important;
                }
            </style>
        <style id="media-query" type="text/css">
                @media (max-width: 660px) {
        
                    .block-grid,
                    .col {
                        min-width: 320px !important;
                        max-width: 100% !important;
                        display: block !important;
                    }
        
                    .block-grid {
                        width: 100% !important;
                    }
        
                    .col {
                        width: 100% !important;
                    }
        
                    .col>div {
                        margin: 0 auto;
                    }
        
                    img.fullwidth,
                    img.fullwidthOnMobile {
                        max-width: 100% !important;
                    }
        
                    .no-stack .col {
                        min-width: 0 !important;
                        display: table-cell !important;
                    }
        
                    .no-stack.two-up .col {
                        width: 50% !important;
                    }
        
                    .no-stack .col.num4 {
                        width: 33% !important;
                    }
        
                    .no-stack .col.num8 {
                        width: 66% !important;
                    }
        
                    .no-stack .col.num4 {
                        width: 33% !important;
                    }
        
                    .no-stack .col.num3 {
                        width: 25% !important;
                    }
        
                    .no-stack .col.num6 {
                        width: 50% !important;
                    }
        
                    .no-stack .col.num9 {
                        width: 75% !important;
                    }
        
                    .video-block {
                        max-width: none !important;
                    }
        
                    .mobile_hide {
                        min-height: 0px;
                        max-height: 0px;
                        max-width: 0px;
                        display: none;
                        overflow: hidden;
                        font-size: 0px;
                    }
        
                    .desktop_hide {
                        display: block !important;
                        max-height: none !important;
                    }
                }


                .container {
                    position: relative;
                    text-align: center;
                    color: white;
                }
                .centered {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                }
            </style>
        </head>
        <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
        <!--[if IE]><div class="ie-browser"><![endif]-->
        <table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;" valign="top" width="100%">
        <tbody>
        <tr style="vertical-align: top;" valign="top">
        <td style="word-break: break-word; vertical-align: top;" valign="top">
        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#FFFFFF"><![endif]-->
        <div style="background-color:transparent;margin-top:-50px;">
        <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #443276;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#443276;">
        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px"><tr class="layout-full-width" style="background-color:#443276"><![endif]-->
        <!--[if (mso)|(IE)]><td align="center" width="640" style="background-color:#443276;width:640px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:35px; padding-bottom:35px;"><![endif]-->
        <div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
        <div style="height:1px;width:100% !important;">
        <!--[if (!mso)&(!IE)]><!-->
        <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:35px; padding-bottom:35px; padding-right: 0px; padding-left: 0px;">
        <!--<![endif]-->
        <div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><a href="http://localhost/git/bachelor/intro.php" style="outline:none" tabindex="-1" target="_blank"> <img align="center" alt="Logo" border="0" class="center autowidth" src="cid:logoimg" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; width: 100%; max-width: 168px; display: block;" title="Logo" width="168"/></a>
        <!--[if mso]></td></tr></table><![endif]-->
        </div>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style="background-color:transparent;">
        <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #443276;">
        
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#443276;background-position:center top;background-repeat:no-repeat">
        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px"><tr class="layout-full-width" style="background-color:#443276"><![endif]-->
        <!--[if (mso)|(IE)]><td align="center" width="640" style="background-color:#443276;width:640px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:60px; padding-bottom:60px;"><![endif]-->
        <div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
        <div style="width:100% !important;">
        <!--[if (!mso)&(!IE)]><!-->
        <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:60px; padding-bottom:60px; padding-right: 0px; padding-left: 0px;">
        <!--<![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
        <tbody>
        <tr style="vertical-align: top;" valign="top">
        <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 40px; padding-right: 0px; padding-bottom: 40px; padding-left: 0px;" valign="top">
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 0px; width: 100%;" valign="top" width="100%">
        <tbody>
        <tr style="vertical-align: top;" valign="top">
        <td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
       
        </div>
        </div>

        <div class="container" style="margin-top:-200px;">
        <img src="cid:flowerimg">
        
        <div class="centered" style="margin-top:-200px;">
        <div style="color:#ffffff;font-family:"Abril Fatface", Arial, "Helvetica Neue", Helvetica, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
        <div style="font-size: 14px; line-height: 1.2; font-family: "Abril Fatface", Arial, "Helvetica Neue", Helvetica, sans-serif; color: #ffffff; mso-line-height-alt: 17px;">
        <p style="font-size: 104px; line-height: 1.2; word-break: break-word; text-align: center; font-family: "Abril Fatface", Arial, "Helvetica Neue", Helvetica, sans-serif; mso-line-height-alt: 125px; margin: 0;"><span style="font-size: 104px;color:white;text-align:center;">Wedding Invitation</span></p>
        
        
        </div>
      </div>


        <!--[if mso]></td></tr></table><![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
        <tbody>
        <tr style="vertical-align: top;" valign="top">
        <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 40px; padding-right: 0px; padding-bottom: 40px; padding-left: 0px;" valign="top">
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="0" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 0px; width: 100%;" valign="top" width="100%">
        <tbody>
        <tr style="vertical-align: top;" valign="top">
        <td height="0" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style="background-color:transparent;">
        <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #443276;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:#443276;">
        <div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="invitations/index_' . $event_id . '.html" style="height:31.5pt; width:162pt; v-text-anchor:middle;" arcsize="10%" stroke="false" fillcolor="#e09f3a"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Tahoma, sans-serif; font-size:16px"><![endif]--><a href="http://localhost/git/bachelor/start/invitations/index_' . $event_id . '.html" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #e09f3a; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; width: auto; width: auto; border-top: 1px solid #e09f3a; border-right: 1px solid #e09f3a; border-bottom: 1px solid #e09f3a; border-left: 1px solid #e09f3a; padding-top: 5px; padding-bottom: 5px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">ACCESS INVITATION</span></span></a>
        <!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
        </div>
        <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
        <tbody>
        <tr style="vertical-align: top;" valign="top">
        <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #FFFFFF; width: 35%;" valign="top" width="35%">
        <tbody>
        <tr style="vertical-align: top;" valign="top">
        <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
        <div style="color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
        <div style="font-size: 14px; line-height: 1.2; color: #ffffff; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 17px;">
        <p style="font-size: 22px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 26px; margin: 0;"><span style="font-size: 22px;">RSVP TO THE LINK ABOVE</span></p>
        </div>
        </div>
        <!--[if mso]></td></tr></table><![endif]-->
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style="background-color:transparent;">
        <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
        <!--[if (mso)|(IE)]><td align="center" width="640" style="background-color:transparent;width:640px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
        <div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
        <div style="height:1px;width:100% !important;">
        <!--[if (!mso)&(!IE)]><!-->
        <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
        <!--<![endif]-->
        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, sans-serif"><![endif]-->
        <div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
        <div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
        <p style="font-size: 14px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 17px; margin: 0;">&copy; ' . date("Y") . ' - PlanSaver Inc - All rights reserved | <span style="background-color: #ffffff; color: #000000;"><a href="http://localhost/git/bachelor/about.php" rel="noopener" style="text-decoration: underline; background-color: #ffffff; color: #000000;" target="_blank">About us</a></span></p>
        </div>
        </div>
        <!--[if mso]></td></tr></table><![endif]-->
        <table cellpadding="0" cellspacing="0" class="social_icons" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" valign="top" width="100%">
        <tbody>
        <tr style="vertical-align: top;" valign="top">
        <td style="word-break: break-word; vertical-align: top; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
        <table align="center" cellpadding="0" cellspacing="0" class="social_table" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-tspace: 0; mso-table-rspace: 0; mso-table-bspace: 0; mso-table-lspace: 0;" valign="top">
        <tbody>
        <tr align="center" style="vertical-align: top; display: inline-block; text-align: center;" valign="top">
        <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 1px; padding-left: 1px;" valign="top"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="cid:fb" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Facebook" width="32"/></a></td>
        <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 1px; padding-left: 1px;" valign="top"><a href="https://twitter.com/home" target="_blank"><img alt="Twitter" height="32" src="cid:twitter" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Twitter" width="32"/></a></td>
        <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 1px; padding-left: 1px;" valign="top"><a href="https://www.instagram.com/?hl=ro" target="_blank"><img alt="Instagram" height="32" src="cid:insta" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Instagram" width="32"/></a></td>
        <td style="word-break: break-word; vertical-align: top; padding-bottom: 0; padding-right: 1px; padding-left: 1px;" valign="top"><a href="https://ro.linkedin.com/" target="_blank"><img alt="LinkedIn" height="32" src="cid:linked" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="LinkedIn" width="32"/></a></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if (IE)]></div><![endif]-->
        </body>
        </html>
        ';
        $mail->AddAddress($email);
        
        if(!$mail->Send()) {
           echo "Mailer Error: " . $mail->ErrorInfo;
        }else{
            $sql = "UPDATE guests SET guest_send = :guest_send WHERE guest_id = :guest_id";
    
		if( $stmt = $pdo->prepare($sql)  ){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":guest_send", $param_send);
			$stmt->bindParam(":guest_id", $param_id);
            
            // Set parameters
			$param_send = 'yes';
			$param_id = $guest_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				// Records created successfully. Redirect to landing page
                header("location: guests.php?event_id=" . $event_id);
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        }

?>

    
</body>
</html>