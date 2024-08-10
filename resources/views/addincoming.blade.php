@extends('products.layout')
    
@section('content')
  
<div class="card mt-5">
  <h2 class="card-header text-primary text-center">Add New Incoming Report</h2>
  <div class="card-body">

  @if(session('success'))
      <div class="alert alert-success mt-3">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger mt-3">
        {{ session('error') }}
      </div>
    @endif
    
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a class="btn btn-success btn-sm" href="{{ route('dashboard') }}">
        <i class="fa fa-home"></i> Dashboard
      </a>
</div>    

    <form action="{{ route('incomingcalls.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="inputBranchcalled" class="form-label"><strong>Your Branch:</strong></label>
            <select name="branchcalled" id="inputBranchcalled" class="form-select @error('branchcalled') is-invalid @enderror">
            <option value="">Select Only Your Branch Name</option>
                <option value="Asokoro">Asokoro</option>
                <option value="Gana">Gana</option>
                <option value="Gimbiya">Gimbiya</option>
                <option value="Gwarinpa 1">Gwarinpa 1</option>
                <option value="Gwarinpa 2">Gwarinpa 2</option>
                <option value="Gwarinpa 3">Gwarinpa 3</option>
                <option value="Guzape">Guzape</option>
                <option value="New Ademola">New Ademola</option>
                <option value="New Garki">New Garki</option>
                <option value="New Wuse">New Wuse</option>
                <option value="Old Ademola">Old Ademola</option>                                  
                <option value="Omega">Omega</option>
                             
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
                class="form-control @error('drug') is-invalid @enderror" 
                id="inputDrug" 
                placeholder="Name of Drug Requested e.g Amoksiklav 1g">
            @error('drug')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputResponse" class="form-label"><strong>Your Response:</strong></label>
            <select name="response" id="inputResponse" class="form-select @error('response') is-invalid @enderror">
                <option value="">Select Response</option>
                <option value="in_stock">in_stock</option>
                <option value="out_of_stock">out_of_stock</option>                           
            </select>
            @error('response')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

  
        <div class="mb-3">
    <label for="inputBranchthatcalled" class="form-label"><strong>Branch(es) that Called You:</strong></label>
    <div id="inputBranchthatcalled" class="@error('branchthatcalled') is-invalid @enderror">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Asokoro" id="branchcalledAsokoro">
            <label class="form-check-label" for="branchcalledAsokoro">Asokoro</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Gana" id="branchcalledGana">
            <label class="form-check-label" for="branchcalledGana">Gana</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Gimbiya" id="branchcalledGimbiya">
            <label class="form-check-label" for="branchcalledGimbiya">Gimbiya</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Gwarinpa 1" id="branchcalledGwarinpa1">
            <label class="form-check-label" for="branchcalledGwarinpa1">Gwarinpa 1</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Gwarinpa 2" id="branchcalledGwarinpa2">
            <label class="form-check-label" for="branchcalledGwarinpa2">Gwarinpa 2</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Gwarinpa 3" id="branchcalledGwarinpa3">
            <label class="form-check-label" for="branchcalledGwarinpa3">Gwarinpa 3</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Guzape" id="branchcalledGuzape">
            <label class="form-check-label" for="branchcalledGuzape">Guzape</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="New Ademola" id="branchcalledNewAdemola">
            <label class="form-check-label" for="branchcalledNewAdemola">New Ademola</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="New Garki" id="branchcalledNewGarki">
            <label class="form-check-label" for="branchcalledNewGarki">New Garki</label>
        </div>
        
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="New Wuse" id="branchcalledNewWuse">
            <label class="form-check-label" for="branchcalledNewWuse">New Wuse</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Old Ademola" id="branchcalledOldAdemola">
            <label class="form-check-label" for="branchcalledOldAdemola">Old Ademola</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="branchthatcalled[]" value="Omega" id="branchcalledOmega">
            <label class="form-check-label" for="branchcalledOmega">Omega</label>
        </div>
               
    
    </div>
    @error('branchthatcalled')
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
</div>
    </form>  
 
</div>
@endsection
