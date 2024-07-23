@extends('products.layout')
  
@section('content')

<div class="card mt-5">
  <h2 class="card-header text-primary" style="text-align: center;">Single Report</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('alloutgoing') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Branch Called:</strong> <br/>
                {{ $outgoingcall->branchcalled }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Drug Requested:</strong> <br/>
                {{ $outgoingcall->drug }}
            </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Response:</strong> <br/>
                {{ $outgoingcall->response }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Number of Call:</strong> <br/>
                {{ $outgoingcall->call }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Branch Called From:</strong> <br/>
                {{ $outgoingcall->branchthatcalled }}
            </div>
        </div>
    </div>
  
  </div>
</div>
@endsection
