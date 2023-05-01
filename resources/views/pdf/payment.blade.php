<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>RECEIPT | {{$receiptID}}</title>
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
    width: 50mm;  
    height: 50mm; 
    margin: 0 auto; 
    color: #555555;
    background: #FFFFFF; 
    font-family: Arial, sans-serif; 
    font-size: 14px; 
    font-family: SourceSansPro;
    padding:0;
  }

  header {
    padding:0;
    margin-bottom: 10px;
    border-bottom: 1px solid #AAAAAA;
  }

  #logo {
    text-align:center;
  }

  #logo img {
    padding:0;
    height: 30px;
    margin-bottom:0px;
  }

  #company {
    margin-top:0px;
    text-align: center;
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
    font-size: 1em;
    font-weight: normal;
    margin: 0;
    margin-bottom: 10px;
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

  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  margin-right:10px;
  }

  .right {
    text-align:right;
  }

  th, td {
    text-align: left;
    color: black;
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
    font-size: 0.8em;
  }

  .meditem {
    margin:0;
    font-size: 1.1em;
    font-weight: bold;
    margin-bottom:8px;
  }
  .no-bottom-margin {
    margin-bottom: 0px;
  }

  .text-receipt {
    font-size: 0.8em;
  }
  .receipt {
    border: 0.5px solid black;
    text-align:center;
    padding:5px;
  }
    </style>
  </head>
  <body>
        <div id="logo">
        <img src="{{$logo}}">
      </div>
    <header class="clearfix">

    <div id="company">
        <h2 class="name"><strong>Adventist Hospital</strong> Receipt</h2>
      </div>
      </div>
    </header>

    <div class="row">
      <div class="column">
        <table class="text-receipt">
          <tr>
            <th colspan="2" class="receipt">{{$receiptID}}</th>
          </tr>
          <tr>
            <td>Date</td>
            <td class="right">{{ date('l, d M Y', strtotime($payment->created_at)) }}</td>
          </tr>
          <tr>
            <td>Method</td>
            <td class="right">{{ $payment->PAYMENT_METHOD }}</td>
          </tr>
        </table>
        <br>
        <br>
        <table class="text-receipt">
          <tr>
            <td>Bill Amount</td>
            <td class="right">@money($invoice->INVOICE_AMOUNT)</td>
          </tr>
          <tr>
            <td>Amount Paid</td>
            <td class="right">@money($payment->AMOUNT_PAID)</td>
          </tr>
          <tr>
            <td>Exchange</td>
            <td class="right">@money($payment->EXCHANGE)</td>
          </tr>
        </table>
      </div>
    </div>
    <br>
    <div class="row">
      <p class="center"><i>"May the Lord bless you and Heal you"</i></p>
    </div>

  </body>
</html>