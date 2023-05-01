<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice | {{$invoice->INVOICE_ID}}</title>
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
    border: 1px solid #ddd;
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
        <h1 class="name"><strong>Adventist Hospital</strong> Invoice</h1>
        <div>Jl. Indonesia Berjaya Raya No. 17, DKI Jakarta, Indonesia</div>
        <div>+62 928-108-027</div>
        <a href="mailto:bah@adventist.com">www.adventisthospital.com</a></div>
      </div>
      </div>
    </header>

    <div class="row">
      <div class="column">
        <p class="title">Invoice Information</p>
        <p class="subtitle">{{$invoice->INVOICE_ID}}</p>
        <p class="subtitle">{{ date('l, d M Y', strtotime($invoice->INVOICE_DATE)) }}</p>
      </div>
      <div class="column right">
        <p class="title">Patient Information</p>
        <p class="subtitle">{{$patient->PATIENT_ID}}</p>
        <p class="subtitle">{{$patient->PAT_FNAME}} {{$patient->PAT_MNAME}} {{$patient->PAT_LNAME}}</p> 
        <p class="subtitle">{{$patient->PAT_ADDRESS}}</p> 
        <p class="subtitle">{{$patient->PAT_CITY}}, {{$patient->PAT_COUNTRY}}</p> 
      </div>
    </div>

    <div class="row">
        <div class="row">
        <div class="column-12">
            <p class="title">ADMINISTRATION</p>
            <table>
                <tr>
                    <th style="width: 7%;"></th>
                    <th>ITEM</th>
                    <th class="right" style="width: 20%;">Sub-Total</th>
                </tr>
                <?php $i=1; ?>
                @foreach($invoiceitem as $item)
                <tr>
                    <td class="center">{{$i}}</td>
                    <td>{{$item->ITEM_NAME}}</td>
                    <td class="right">@money($item->ITEM_PRICE)</td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </table>
            <br>
            <p class="title">TREATMENT</p>
            <table class="diagnosis">
                <tr>
                    <th style="width: 7%;"></th>
                    <th>TREATMENT</th>
                    <th  class="right" style="width: 20%;">Sub-Total</th>
                </tr>
                <?php $i=1; ?>
                @foreach($treatment as $item)
                <tr>
                    <td class="center">{{$i}}</td>
                    <td>{{$item->TREATMENT_NAME}}</td>
                    <td class="right">@money($item->TREATMENT_PRICE)</td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </table>
            <br>
            <p class="title">MEDICINE</p>
            <table class="diagnosis">
                <tr>
                    <th style="width: 7%;"></th>
                    <th>MEDICINE</th>
                    <th style="width: 10%;">QTY</th>
                    <th class="right" style="width: 20%;">Price</th>
                    <th class="right" style="width: 20%;">Sub-Total</th>
                </tr>
                <?php $i=1; ?>
                @foreach($medicine as $item)
                <tr>
                    <td class="center">{{$i}}</td>
                    <td>{{$item->MEDICINE_NAME}}</td>
                    <td>{{$item->QUANTITY}}</td>
                    <td class="right">@money($item->MED_PRICE)</td>
                    <td class="right">@money(($item->MED_PRICE)*($item->QUANTITY))</td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </table>
        </div>
        </div>
    </div>

    <div class="row">
      <div class="column">

      </div>
      <div class="column right">
      <table>
          <tr>
            <th class="right">Total</th>
            <td class="right" style="width: 40%;">@money($totalprice)</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row center">
      <p><i>"May the Lord bless you and Heal you"</i></p>
    </div>

  </body>
</html>