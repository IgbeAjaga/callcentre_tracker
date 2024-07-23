@extends('products.layout')

@section('content')

<div class="card mt-5" style="width: 100% !important;">
  <div class="card-body" style="width: 100% !important;">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
      <a class="btn btn-primary btn-sm" href="{{ route('alloutgoing') }}">
        <i class="fa fa-arrow-left"></i> Back
      </a>
      <button class="btn btn-success btn-sm" onclick="window.print()">
        <i class="fa fa-print"></i> Print
      </button>
    </div>

    <!-- Small Table to show aggregated data -->
    <h2 class="card-header text-center text-primary" style="width: 100%;"><strong>SUMMARY OF:</strong> 
    @if(request('drug')) Where {{ request('drug') }} @endif
    @if(request('response')) is {{ request('response') }} - @endif
    @if(request('branchcalled')) {{ request('branchcalled') }} branch @endif
    @if(request('branchthatcalled')) {{ request('branchthatcalled') }} branch @endif
    @if(request('date_from')) from {{ request('date_from') }} @endif
    @if(request('date_to')) to {{ request('date_to') }} @endif
    </h2>
    <table class="table table-bordered mb-4" style="width: 100% !important;">
      <thead>
        <tr>
          <th>Drug</th>
          <th>Asokoro</th>
          <th>Gana</th>
          <th>Gimbiya</th>
          <th>Gwarinpa 1</th>
          <th>Gwarinpa 2</th>
          <th>Gwarinpa 3</th>
          <th>Guzape</th>                                        
          <th>New Ademola</th>
          <th>New Garki</th>
          <th>New Wuse</th>
          <th>Old Ademola</th>               
          <th>Omega</th>
          <th>Wholesale</th>
        </tr>
        <tr>
          <th>Total</th>
          @php
            $totals = [
              'Asokoro' => 0,
              'Gana' => 0,
              'Gimbiya' => 0,
              'Gwarinpa 1' => 0,
              'Gwarinpa 2' => 0,
              'Gwarinpa 3' => 0,
              'Guzape' => 0,
              'New Ademola' => 0,
              'New Garki' => 0,
              'New Wuse' => 0,
              'Old Ademola' => 0,
              'Omega' => 0,
              'Wholesale' => 0,
            ];
            foreach ($drugData as $drug => $branches) {
              foreach ($branches as $branch => $count) {
                $totals[$branch] += $count;
              }
            }
          @endphp
          @foreach($totals as $total)
            <th>{{ $total }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($drugData as $drug => $branches)
          <tr>
            <td>{{ $drug }}</td>
            @foreach($branches as $branch => $count)
              @php
                $remarkClass = '';
                if (request('response') === 'out_of_stock') {
                  $remarkClass = ($count > 0) ? 'text-danger' : 'text-success'; // Red if out of stock, Green if in stock
                } elseif (request('response') === 'in_stock') {
                  $remarkClass = ($count > 0) ? 'text-success' : 'text-danger'; // Green if in stock, Red if out of stock
                } elseif (request('response') === 'no_response') {
                  $remarkClass = ($count > 0) ? 'text-warning' : 'text-success'; // Yellow if inconclusive, Green if conclusive
                }
              @endphp
              <td class="{{ $remarkClass }}">{{ $count }}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<style>
  @media print {
    body {
      margin: 0;
    }
    .card {
      width: 100% !important;
      box-shadow: none !important; /* Remove card shadow when printing */
    }
    .card-body {
      padding: 10px !important; /* Adjust padding for printing */
    }
    .table {
      width: 100% !important;
      font-size: 10px; /* Adjust font size for printing */
      border-collapse: collapse !important; /* Ensure borders collapse */
    }
    .table th, .table td {
      padding: 5px !important; /* Reduce padding */
      border: 1px solid black !important; /* Ensure borders are printed */
    }
    .btn {
      display: none !important; /* Hide buttons when printing */
    }
    .card-header {
      font-size: 14px; /* Adjust header font size for printing */
    }
    .text-primary {
      color: #000 !important; /* Print headers in black */
    }
    h2.card-header {
      margin-bottom: 10px; /* Reduce margin for printing */
    }
    /* Ensure the content fits within the printable area */
    @page {
      size: auto; /* auto is the initial value */
      margin: 0mm; /* this affects the margin in the printer settings */
    }
  }
</style>

@endsection
