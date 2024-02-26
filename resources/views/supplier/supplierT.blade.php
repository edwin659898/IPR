@extends('layouts.main')

@section('content')

<!-- [ Main Content ] start -->
<div class="row">
  <!-- [ sample-page ] start -->
  <div class="col-sm-12">
    <div class="card">

      <div class="card-header">
        <h5>Suppliers pending</h5>
        <div class="card-header-right">
          <div class="btn-group card-option">
            <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="feather icon-more-horizontal"></i>
            </button>
            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
              <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
          </div>
        </div>
      </div>
      <div class="card-body">
        @if($todos->count()==0)
        <center>
          <p>No Suppliers Available check later</p>
        </center>
        @else
        <div class="dt-responsive table-responsive">
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead class="text-white bg-green-800">
              <tr>
                <th>Introduced By</th>
                <th>Date Introduced</th>
                <th>Site</th>
                <th>Company Name</th>
                <th>Status</th>
                <th>View</th>
              </tr>
            </thead>
            @foreach($todos as $t)
            <tr>
              <td>{{ $t->user->name }}</td>
              <td>{{ $t->created_at->format('d-m-Y')}}</td>
              <td>{{ $t->site }}</td>
              <td>{{ $t->company }}</td>
              <td>{{ $t->level }}</td>
              <td><a href="{{route('sup.showSupplier',$t->id)}}"><i class="fas fa-eye text-green-800"></i></a></td>
            </tr>
            @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->

@endsection