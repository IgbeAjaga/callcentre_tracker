@extends('products.layout')

@section('content')
<div class="card mt-5">
  <h2 class="card-header text-center text-primary"><strong>INCOMING CALLS REPORT</strong></h2>
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
      <a class="btn btn-success btn-sm" href="{{ route('addincoming') }}">
        <i class="fa fa-plus"></i> Add New Report
      </a>   
      <a class="btn btn-secondary btn-sm" href="{{ route('incomingcalls.export') }}">
        <i class="fa fa-file-excel"></i> Export to Excel
      </a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('searchin') }}" method="GET" class="mb-4">
      <div class="row">

        <div class="mb-3">
          <label for="inputBranchcalled" class="form-label"><strong>Branch Called To:</strong></label>
          <select name="branchcalled" id="inputBranchcalled" class="form-select @error('branchcalled') is-invalid @enderror">
            <option value="">Select Branch Name</option>
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
            <option value="Wholesale">Wholesale</option>                               
          </select>
          @error('branchcalled')
            <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-3">
          <input type="text" name="drug" class="form-control" placeholder="Enter drug">
        </div>

        <div class="mb-3">
          <label for="inputResponse" class="form-label"><strong>Response:</strong></label>
          <select name="response" id="inputResponse" class="form-select @error('response') is-invalid @enderror">
            <option value="">All Responses</option>
            <option value="in_stock">in_stock</option>
            <option value="out_of_stock">out_of_stock</option>                         
          </select>
          @error('response')
            <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="inputBranchthatcalled" class="form-label"><strong>Branch Called From:</strong></label>
          <select name="branchthatcalled" id="inputBranchthatcalled" class="form-select @error('branchthatcalled') is-invalid @enderror">
            <option value="">Select Branch Name</option>
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
            <option value="Wholesale">Wholesale</option>
          </select>
          @error('branchthatcalled')
            <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-3">
          Date From:<input type="date" name="date_from" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-3">
          Date To:<input type="date" name="date_to" class="form-control" placeholder="To Date">
        </div>
        <div class="col-md-3">
          Time From:<input type="time" name="time_from" class="form-control" placeholder="From Time">
        </div>
        <div class="col-md-3">
          Time To:<input type="time" name="time_to" class="form-control" placeholder="To Time">
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
        </div>
      </div>
    </form>    

    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>
          <th width="80px">SN</th>
          <th>Branch Called From</th>
          <th>Branch Called To</th>
          <th>Drug Requested</th>
          <th>Response</th>        
          <th>Date</th>
          <th width="250px">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($incomingcalls as $incomingcall)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $incomingcall->branchthatcalled }}</td>
            <td>{{ $incomingcall->branchcalled }}</td>
            <td>{{ $incomingcall->drug }}</td>
            <td>{{ $incomingcall->response }}</td>           
            <td>{{ $incomingcall->created_at->format('Y-m-d H:i:s') }}</td>
            <td>
              <form action="{{ route('incomingcalls.destroy', $incomingcall->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('incomingcalls.show', $incomingcall->id) }}">
                  <i class="fa-solid fa-list"></i> Show
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('incomingcalls.edit', $incomingcall->id) }}">
                  <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7">There are no data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {!! $incomingcalls->links() !!}   
  </div>
</div>
@endsection
