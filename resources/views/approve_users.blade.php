@extends('products.layout')
@section('content')
<div class="card mt-5">
  <h2 class="card-header text-center text-primary"><strong>APPROVE/DISAPPROVE USERS</strong></h2>
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

    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>          
          <th>Name</th>
          <th>Email</th>          
          <th width="250px">Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($users as $user)
                <tr>
                
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('profile.approve', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('profile.disapprove', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">Disapprove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
  </div>
</div>
@endsection

