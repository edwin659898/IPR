@extends('todos.layout')

@section('content')

<h1 class="h3 mb-2 text-success">My IPRs</h1>
@include('layouts.flash')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">IPRs Sent</h6>
    <a href="{{route('todo.mysuppliers')}}" class="navbar-nav ml-auto">
      <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>My Suppliers</b> </span>
    </a>
  </div>

  <div class="card-body">
    @if($todos->count()==0)
    <center>
      <p>No Iprs Available Kindly Create One</p>
    </center>
    @else
    <div class="table-responsive">
      <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead class="text-white" style="background-color:#007e33">
          <tr>
            <th>Ref No</th>
            <th>Date Created</th>
            <th>Status</th>
            <th>Message</th>
            <th>SLM comment </th>
            <th>HOD comment</th>
            <th>Op Comment</th>
            <th>MD Comment</th>
          </tr>
        </thead>
        @foreach($todos as $t)
        <tr>
          <td>{{ $t->id}}</td>
          <td data-order='desc'>{{ $t->date_initiated}}</td>
          <td>{{ $t->status }}</td>
          <td><a href="{{route('todo.show',$t->id)}}">View</a></td>
          <td>{{ $t->slmC }}</td>
          <td>{{ $t->hodC }}</td>
          <td>{{ $t->opC }}</td>
          <td>{{ $t->mdC }}</td>

        </tr>
        @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
</div>
@endsection