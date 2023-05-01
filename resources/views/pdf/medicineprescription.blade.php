<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PRESCRIPTION | {{$medrec->RECORD_ID}}</title>
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
    width: 12cm;  
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

  h2.name {
    font-size: 1.5em;
    font-weight: normal;
    margin: 0;
    margin-top:10px;
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
  .meditem {
    margin:0;
    font-size: 1.1em;
    font-weight: bold;
    margin-bottom:8px;
  }
  .description {
    padding-left:15px;
  }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{$logo}}">
      </div>
      <div id="company">
        <h2 class="name"><strong>Adventist Hospital</strong> Medicine Prescription</h2>
        <div>Jl. Indonesia Berjaya Raya No. 17, DKI Jakarta, Indonesia</div>
        <div>+62 928-108-027</div>
      </div>
      </div>
    </header>

    <div class="row">
      <div class="column">
        <p class="title">Patient Information</p>
        <p class="subtitle">{{$title}} {{$patients->PAT_FNAME}} {{$patients->PAT_MNAME}} {{$patients->PAT_LNAME}}</p> 
        <p class="subtitle">{{$medrec->RECORD_ID}}</p> 
        <p class="subtitle">{{ date('l, d M Y', strtotime($medrec->MEDREC_DATE)) }}</p> 
      </div>
    </div>

    <div class="row">
      <div class="column-12">
      <p class="title">Medicine Prescription</p>
        <table>
        <?php $i=1; ?>
          @foreach($medicines as $item)
          <tr>
            <td>
               <p class="meditem">{{$i}}. {{$item->MEDICINE_NAME}}</p>
               <span class="description">Quantity: {{$item->QUANTITY}} {{$item->MED_PACKTYPE}}</span>
               <br>
               <span class="description">Instruction: {{$item->INSTRUCTION}}</span>
            </td>
          </tr>
          <?php $i++; ?>
          @endforeach
        </table>
      </div>
    </div>

    <div class="row center">
      <p><i>"May the Lord bless you and Heal you"</i></p>
    </div>

  </body>
</html>