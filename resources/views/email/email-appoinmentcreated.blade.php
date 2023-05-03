<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Appointment Card</title>
    <meta name="description" content="Reset Password Email">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:darkslategray; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:white; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">Adventist Hospital</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                </table>
            </td>
        </tr>
    </table>
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr colspan="2">
                                    <td style="float: left; width: 100%;" colspan="3">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;"></h1>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">{{$appointmentID}}</p>
                                        <span
                                        style="display:inline-block; vertical-align:middle; margin:10px 0 10px; border-bottom:1px solid #cecece; width:100px;"></span>
                                    </td>
                                </tr>
                                <tr>
                                  <td style="padding:0 35px; width: 30%;">
                                      <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">PATIENT NAME</h3>
                                  </td>
                                  <td style="padding:0 35px;  width: 1%;">
                                    <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">:</h3>
                                  </td>
                                  <td>
                                    <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">{{$patientfName}} {{$patientmName}} {{$patientlName}}</h3>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding:0 35px;">
                                      <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">DATE</h3>
                                  </td>
                                  <td style="padding:0 35px;  width: 1%;">
                                    <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">:</h3>
                                  </td>
                                  <td>
                                    <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;"><?php echo(date('d M Y', strtotime($appointmentDate))); ?></h3>
                                  </td>
                                </tr> 
                                <tr>
                                  <td style="padding:0 35px;">
                                      <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">ROOM:</h3>
                                  </td>
                                  <td style="padding:0 35px;  width: 1%;">
                                    <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">:</h3>
                                  </td>
                                  <td>
                                    <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">{{$room}}</h3>
                                  </td>
                                </tr>     
                                <tr>
                                  <td style="padding:0 35px; margin-bottom: 10%;">
                                      <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">PHYSICIAN:</h3>
                                  </td>
                                  <td style="padding:0 35px;  width: 1%;">
                                    <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">:</h3>
                                  </td>
                                  <td>
                                    <h3 style="color:#1e1e2d; font-weight:500; margin-bottom:1px;font-size:15px;font-family:'Rubik',sans-serif; float: left;">Dr. {{$physicianfName}} {{$physicianmName}} {{$physicianlName}}<small class="ml-2"> | {{$clinic}}</h3>
                                  </td>
                                </tr>                               
                                <tr style="margin-top: 10px;" >
                                      <td  style="padding:0 35px; font-size: small;" colspan="3" ><p><i>"The Lord Bless you and Heal you"</i></p>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
                
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>