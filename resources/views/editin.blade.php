@extends('products.layout')
    
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header text-primary" style="text-align: center";>Edit Report</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('allincoming') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <form action="{{ route('incomingcalls.update',$incomingcall->id) }}" method="POST">
        @csrf
        @method('PUT')
  
        <div class="mb-3">
            <label for="inputBranchcalled" class="form-label"><strong>Branch Called:</strong></label>
            <select name="branchcalled" id="inputBranchcalled" class="form-select @error('branchcalled') is-invalid @enderror">
                <option value="">Select Branch</option>
                <option value="Asokoro">Asokoro</option>
                <option value="Maitama">Maitama</option>
                <option value="Garki">Garki</option>
                <option value="Gimbiya PX">Gimbiya PX</option>
                <option value="New Ademola">New Ademola</option>
                <option value="Old Ademola">Old Ademola</option>
                <option value="Old Gwarinpa">Old Gwarinpa</option>
                <option value="New Gwarinpa">New Gwarinpa</option>
                <option value="Gwarina 3">Gwarina 3</option>
                <option value="Gana PX">Gana PX</option>
                <option value="Ferma">Ferma</option>                
            </select>
            @error('branchcalled')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
  
        <div class="mb-3">
            <label for="inputDrug" class="form-label"><strong>Drug Requested:</strong></label>
            <input 
                type="text" 
                name="drug" 
                value="{{ $incomingcall->drug }}"
                class="form-control @error('drug') is-invalid @enderror" 
                id="inputDrug" 
                placeholder="Drug Requested">
            @error('drug')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputResponse" class="form-label"><strong>Response:</strong></label>
            <select name="response" id="inputResponse" class="form-select @error('response') is-invalid @enderror">
                <option value="">Select Response</option>
                <option value="in_stock">in_stock</option>
                <option value="out_of_stock">out_of_stock</option>
                <option value="no_response">no_response</option>              
            </select>
            @error('response')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputCall" class="form-label"><strong>Number of Calls:</strong></label>
            <input 
                type="text" 
                name="call" 
                value="{{ $incomingcall->call }}"
                class="form-control @error('call') is-invalid @enderror" 
                id="inputCall" 
                placeholder="Number of Calls">
            @error('call')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputCustomer" class="form-label"><strong>Customer's Name:</strong></label>
            <input 
                type="text" 
                name="customer" 
                value="{{ $incomingcall->customer }}"
                class="form-control @error('customer') is-invalid @enderror" 
                id="inputCustomer" 
                placeholder="Customer Requested">
            @error('customer')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputPhone" class="form-label"><strong>Customer's Phone:</strong></label>
            <input 
                type="text" 
                name="phone" 
                value="{{ $incomingcall->phone }}"
                class="form-control @error('phone') is-invalid @enderror" 
                id="inputPhone" 
                placeholder="Customer's phone">
            @error('phone')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>
  
  </div>
</div>
@endsection