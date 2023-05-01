<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MedRec | {{$medrec}}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
      @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
  }

  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }

  a {
    color: #0087C3;
    text-decoration: none;
  }

  body {
    position: relative;
    width: 19cm;  
    height: 29.7cm; 
    margin: 0 auto; 
    color: #555555;
    background: #FFFFFF; 
    font-family: Arial, sans-serif; 
    font-size: 14px; 
    font-family: SourceSansPro;
  }

  header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #AAAAAA;
  }

  #logo {
    float: left;
    margin-top: 8px;
  }

  #logo img {
    height: 70px;
  }

  #company {
    float: right;
    text-align: right;
  }

  #details {
    margin-bottom: 50px;
  }

  #client {
    padding-left: 6px;
    float: left;
  }

  #client .to {
    color: black;
  }

  h1.name {
    font-size: 2em;
    font-weight: normal;
    margin: 0;
    color: black;
  }

  .title {
    font-size: 1.2em;
    font-weight: bold;
    margin: 0;
    margin-bottom:10px;
    color: black;
  }

  .subtitle {
    font-size: 1em;
    margin: 0;
  }

  .column {
    float: left;
    width: 50%; 
    color: black;
    margin-bottom:20px;
  }

  .column-8 {
    float: left;
    width: 70%; 
    color: black;
    margin-bottom:20px;
  }

  .column-12 {
    float: left;
    width: 100%; 
    color: black;
    margin-bottom:20px;
  }

  .column-4 {
    float: left;
    width: 30%; 
    color: black;
    margin-bottom:20px;
  }

  .right {
    text-align: right;
  }

  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  margin-right:10px;
  }

  .left {
  padding-right:10px;
  }

  th, td {
    text-align: left;
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }

  tr:nth-child(even) {
    background-color: white;
  }

  .diagnosis {
    margin-top: 10px;
  }

  small {
    margin-top: 0;
  }

  .center {
    text-align: center;
  }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{$logo}}">
      </div>
      <div id="company">
        <h1 class="name"><strong>Adventist Hospital</strong> Medical Record</h1>
        <div>Jl. Indonesia Berjaya Raya No. 17, DKI Jakarta, Indonesia</div>
        <div>+62 928-108-027</div>
        <a href="mailto:bah@adventist.com">www.adventisthospital.com</a></div>
      </div>
      </div>
    </header>

    <div class="row">
      <div class="column">
        <p class="title">Medical Record</p>
        <p class="subtitle">{{$medrec}}</p>
        <p class="subtitle">{{ date('l, d M Y', strtotime($date)) }}</p>
        <p class="subtitle">{{$appointment}} [{{$status}}]</p>
        <p class="subtitle">Dr. {{$physicianFNAME}} {{$physicianMNAME}} {{$physicianLNAME}}</p>
      </div>
      <div class="column right">
        <p class="title">Patient Information</p>
        <p class="subtitle">{{$patientID}}</p>
        <p class="subtitle">{{$patientTitle}} {{$patientFNAME}} {{$patientMNAME}} {{$patientLNAME}}</p> 
        <p class="subtitle">0{{$phoneNumber}}</p> 
        <p class="subtitle">{{$patientADDRESS}}</p> 
        <p class="subtitle">{{$patientCITY}}, {{$patientCOUNTRY}}</p> 
      </div>
    </div>

    <div class="row">
      <div class="column-12">
      <table>
          <tr>
            <th>Patient Complaints</th>
          </tr>
          <tr>
            <td>{{$complaints}}</td>
          </tr>
        </table>
        <table class="diagnosis">
          <tr>
            <th>Physician Diagnosis & Treatment Description</th>
          </tr>
          <tr>
            <td>{{$diagnosis}}</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="column-8">
        <table class="left">
          <tr>
            <th>Treatment Received</th>
          </tr>
          @foreach($treatment as $item)
          <tr>
            <td>{{$item->TREATMENT_NAME}}
              <br>
              @if($item->TREATMENT_DESC)
              <i><small>Notes: {{$item->TREATMENT_DESC}}</small></i>
              @else
              <i><small>Notes: There is no note from the physician</small></i>
              @endif
            </td>    
          </tr>
          @endforeach
        </table>

        <table class="left diagnosis">
          <tr>
            <th>Medicine Prescription</th>
          </tr>
          @foreach($medicine as $item)
          <tr>
            <td>{{$item->MEDICINE_NAME}}
            <br>
            <i><small>Quantity: {{$item->QUANTITY}} {{$item->MED_PACKTYPE}} | Instruction: {{$item->INSTRUCTION}}</small></i>
            </td>
          </tr>
          @endforeach
        </table>
    
      </div>
      <div class="column-4 right">
      <table>
        <tr>
          <th colspan="2">Vital Sign Record</th>
        </tr>
        <tr>
          <td>Weight</td>
          <td>{{$weight}} kg</td>
        </tr>
        <tr>
          <td>Height</td>
          <td>{{$height}} cm</td>
        </tr>
        <tr>
          <td>Temperature</td>
          <td>{{$temperature}} &deg;C</td>
        </tr>
        <tr>
          <td>Heartrate</td>
          <td>{{$heartrate}} /min</td>
        </tr>
        <tr>
          <td>Blood Pressure</td>
          <td>{{$systolic}}/{{$diastolic}} mmHg</td>
        </tr>
        <tr>
          <td>Respiration</td>
          <td>{{$respiration}} /min</td>
        </tr>
      </table>
        
      </div>
    </div>

    <div class="row center">
      <p><i>"May the Lord bless you and Heal you"</i></p>
    </div>

  </body>
</html>