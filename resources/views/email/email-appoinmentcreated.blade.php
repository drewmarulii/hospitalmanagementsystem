<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <meta name="format-detection" content="date=no">
  <meta name="format-detection" content="telephone=no">
  <style type="text/CSS"></style>
  <title></title>
  <style>
    table,
    td,
    div,
    h1,
    p {
      font-family: 'Basier Circle', 'Roboto', 'Helvetica', 'Arial', sans-serif;
    }

    @media screen and (max-width: 530px) {
      .unsub {
        display: block;
        padding: 8px;
        margin-top: 14px;
        border-radius: 6px;
        background-color: #FFEADA;
        text-decoration: none !important;
        font-weight: bold;
      }

      .button {
        min-height: 42px;
        line-height: 42px;
      }

      .col-lge {
        max-width: 100% !important;
      }
    }

    @media screen and (min-width: 531px) {
      .col-sml {
        max-width: 27% !important;
      }

      .col-lge {
        max-width: 73% !important;
      }
    }

    .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border-radius: 15px; /* 5px rounded corners */
    }

    .card-header {
      background-color:dark;
      padding: 10px;
      color:white;
    }
    .container {
      padding:10px;
    }

  </style>
</head>

<body style="margin:0;padding:0;word-spacing:normal;background-color:#FDF8F4;">
  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#FDF8F4;">
    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
      <tr>
        <td align="center" style="padding:0;">
          <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:'Basier Circle', 'Roboto', 'Helvetica', 'Arial', sans-serif;font-size:1em;line-height:1.37em;color:#384049;">
            <!--      Logo headder -->
            <tr>
              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:1.5em;font-weight:bold;">
              Appointment Card
              </td>
            </tr>
            <!--      Intro Section -->
            <tr>
              <td style="padding:30px;background-color:#ffffff;">

              <h2 class="text-dark">{{$appointmentID}}</h2>
                <div class="card">
                  <div class="card-header">
                    ADVENTIST HOSPITAL <strong>Appointment Card</strong>
                  </div>
                  <div class="container">
                  <table id="customers">
                    <tr>
                      <td style="width:100px;"><strong>FULL NAME</strong></td>
                      <td>:  {{$patientfName}} {{$patientmName}} {{$patientlName}} </td>
                    </tr>
                    <tr>
                      <td style="width:100px;"><strong>Date</strong></td>
                      <td>: <?php echo(date('d M Y', strtotime($appointmentDate))); ?></td>
                    </tr>
                    <tr>
                      <td style="width:100px;"><strong>Room</strong></td>
                      <td>: {{$room}}</td>
                    </tr>
                    <tr>
                      <td style="width:100px;"><strong>Physician</strong></td>
                      <td>: Dr. {{$physicianfName}} {{$physicianmName}} {{$physicianlName}}<small class="ml-2"> | {{$clinic}}</small></td>
                    </tr>
                  </table>
                  </div>
                </div>
                
                
                <p>Keep the spirit and He will heal, God Bless</p>
                <p>With Love,</p>
                <p>Adventist Hospital</p>
              </td>
            </tr>
          </table>
          <!--[if mso]>
          </td>
          </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
    </table>
  </div>
</body>

</html>