@extends('products.layout')

@section('content')
<div class="card mt-5">
  <h2 class="card-header text-center text-primary"><strong>All Users</strong></h2>
  <div class="card-body">

    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a class="btn btn-success btn-sm" href="{{ route('dashboard') }}">
        <i class="fa fa-home"></i> Dashboard
      </a>
</div>
<br>  

    <table class="table table-bordered table-striped mt-4">
      <thead>
        <tr>
          <th width="80px">SN</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>           
          <th>Date</th>
          <th width="250px">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->is_approved }}</td>            
            <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
            <td>
              <form action="{{ route('profile.destroy', $user->id) }}" method="POST">
                
                <a class="btn btn-primary btn-sm" href="{{ route('profile.edit', $user->id) }}">
                  <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>                
              </form>
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
        @empty
          <tr>
            <td colspan="6">There are no data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {!! $users->links() !!}   
  </div>
</div>
@endsection
