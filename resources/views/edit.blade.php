@extends('products.layout')
    
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header text-primary" style="text-align: center;">Edit Report</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('alloutgoing') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <form action="{{ route('outgoingcalls.update', $outgoingcall->id) }}" method="POST">
        @csrf
        @method('PUT')
  
        <div class="mb-3">
            <label for="inputBranchcalled" class="form-label"><strong>Branch Called:</strong></label>
            <select name="branchcalled" id="inputBranchcalled" class="form-select @error('branchcalled') is-invalid @enderror">
                <option value="">Select Branch</option>
                <option value="Asokoro" {{ $outgoingcall->branchcalled == 'Asokoro' ? 'selected' : '' }}>Asokoro</option>
                <option value="Guzape" {{ $outgoingcall->branchcalled == 'Guzape' ? 'selected' : '' }}>Guzape</option>
                <option value="New Garki" {{ $outgoingcall->branchcalled == 'New Garki' ? 'selected' : '' }}>New Garki</option>
                <option value="Gimbiya" {{ $outgoingcall->branchcalled == 'Gimbiya' ? 'selected' : '' }}>Gimbiya</option>
                <option value="New Ademola" {{ $outgoingcall->branchcalled == 'New Ademola' ? 'selected' : '' }}>New Ademola</option>
                <option value="Old Ademola" {{ $outgoingcall->branchcalled == 'Old Ademola' ? 'selected' : '' }}>Old Ademola</option>
                <option value="Gwarinpa 1" {{ $outgoingcall->branchcalled == 'Gwarinpa 1' ? 'selected' : '' }}>Gwarinpa 1</option>
                <option value="Gwarinpa 2" {{ $outgoingcall->branchcalled == 'Gwarinpa 2' ? 'selected' : '' }}>Gwarinpa 2</option>
                <option value="Gwarinpa 3" {{ $outgoingcall->branchcalled == 'Gwarinpa 3' ? 'selected' : '' }}>Gwarinpa 3</option>
                <option value="Gana" {{ $outgoingcall->branchcalled == 'Gana' ? 'selected' : '' }}>Gana</option>
                <option value="Wuse 2" {{ $outgoingcall->branchcalled == 'Wuse 2' ? 'selected' : '' }}>Wuse 2</option>                               
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
                value="{{ $outgoingcall->drug }}"
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
                <option value="in_stock" {{ $outgoingcall->response == 'in_stock' ? 'selected' : '' }}>in_stock</option>
                <option value="out_of_stock" {{ $outgoingcall->response == 'out_of_stock' ? 'selected' : '' }}>out_of_stock</option>
                <option value="no_response" {{ $outgoingcall->response == 'no_response' ? 'selected' : '' }}>no_response</option>              
            </select>
            @error('response')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>       

        <div class="mb-3">
            <label for="inputBranchthatcalled" class="form-label"><strong>Branch called from:</strong></label>
            <select name="branchthatcalled" id="inputBranchthatcalled" class="form-select @error('branchthatcalled') is-invalid @enderror">
                <option value="">Select Branch</option>
                <option value="Asokoro" {{ $outgoingcall->branchthatcalled == 'Asokoro' ? 'selected' : '' }}>Asokoro</option>
                <option value="Guzape" {{ $outgoingcall->branchthatcalled == 'Guzape' ? 'selected' : '' }}>Guzape</option>
                <option value="New Garki" {{ $outgoingcall->branchthatcalled == 'New Garki' ? 'selected' : '' }}>New Garki</option>
                <option value="Gimbiya" {{ $outgoingcall->branchthatcalled == 'Gimbiya' ? 'selected' : '' }}>Gimbiya</option>
                <option value="New Ademola" {{ $outgoingcall->branchthatcalled == 'New Ademola' ? 'selected' : '' }}>New Ademola</option>
                <option value="Old Ademola" {{ $outgoingcall->branchthatcalled == 'Old Ademola' ? 'selected' : '' }}>Old Ademola</option>
                <option value="Gwarinpa 1" {{ $outgoingcall->branchthatcalled == 'Old Gwarinpa' ? 'selected' : '' }}>Old Gwarinpa</option>
                <option value="Gwarinpa 2" {{ $outgoingcall->branchthatcalled == 'Gwarinpa 2' ? 'selected' : '' }}>Gwarinpa 2</option>
                <option value="Gwarinpa 3" {{ $outgoingcall->branchthatcalled == 'Gwarinpa 3' ? 'selected' : '' }}>Gwarinpa 3</option>
                <option value="Gana" {{ $outgoingcall->branchthatcalled == 'Gana' ? 'selected' : '' }}>Gana</option>
                <option value="Wuse 2" {{ $outgoingcall->branchthatcalled == 'Wuse 2' ? 'selected' : '' }}>Wuse 2</option>                
            </select>
            @error('branchthatcalled')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
    </form>
  
  </div>
</div>
@endsection
