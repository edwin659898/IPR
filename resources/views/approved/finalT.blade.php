@extends('layouts.main')

@section('content')

<!-- [ Main Content ] start -->
<div class="row">
  <!-- [ sample-page ] start -->
  <div class="col-sm-12">
    <div class="card">

      <div class="card-header">
        <h5>Approved IPRs</h5>
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
          <p>No Iprs Available check later</p>
        </center>
        @else
        <div class="dt-responsive table-responsive">
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead class="text-white bg-green-800">
              <tr>
                <th>Created By</th>
                <th>Date Approved</th>
                <th>Status</th>
                <th>Ref No</th>
                <th>View</th>
                <th>Attachments</th>
                <th>HOD comment</th>
                <th>Op Comment</th>
                <th>MD/DFO Comment</th>
                <th>Print Status</th>
              </tr>
            </thead>
            @foreach($todos as $t)
            <tr class="{{!$t->printed ? 'bg-warning' : ''}}">
              <td>{{ $t->owner->name }}</td>
              <td>{{ $t->mdD}}</td>
              <td>{{ $t->status }}</td>
              <td>{{ $t->id }}</td>
              <td><a href="{{route('approved.showFinal',$t->id)}}"><i class="fas fa-eye text-green-800"></i></a></td>
              <td><a href="{{route('approved.attachment',$t->id)}}"><i class="fas fa-paperclip text-green-800"></i></a></td>
              <td>{{ Str::limit($t->hodC,25) }}</td>
              <td>{{ Str::limit($t->opC,25) }}</td>
              <td>{{ Str::limit($t->mdC,25) }}</td>
              <td>
                @if($t->printed)
                <span class="text-primary" role="button" onclick="event.preventDefault();document.getElementById('form-incomplete-{{$t->id}}').submit()">Printed<span />
                  <form style="hidden" method="post" id="{{'form-incomplete-'.$t->id}}" action="{{route('approved.incomplete',$t->id)}}">
                    @csrf
                    @method('patch')
                  </form>
                  @else
                  <span class="text-primary" role="button" onclick="event.preventDefault();document.getElementById('form-complete-{{$t->id}}').submit()" class="text-danger">
                    Not Printed<span />
                    <form style="hidden" method="post" id="{{'form-complete-'.$t->id}}" action="{{route('approved.complete',$t->id)}}">
                      @csrf
                      @method('patch')
                    </form>
                    @endif
              </td>
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