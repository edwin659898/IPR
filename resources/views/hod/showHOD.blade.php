@extends('layouts.main')

@section('content')
<div class="col-sm-12">
  <div class="card">

    <div class="card-header">
      <h5>View IPR</h5>
      <div class="card-header-right">
        <div class="btn-group card-option">
          <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="feather icon-more-horizontal"></i>
          </button>
          <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card-body">
      <form action="{{route('dept.updateHOD',$todos->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="flex justify-center items-center pb-4">
          <img class="w-12 rounded-full" src="/storage/logo.png" alt="Alex" />
          <div class="ml-3">
            <h2 class="text-xl text-green-800 font-semibold">Internal Purchase Requisition</p>
          </div>
        </div>
        <hr>

        <div class="form-row space-x-4 m-4 font-bold">
          <div class="flex space-x-2">
            <label class="text-green-800">Ref No:</label>
            <p>{{$todos->id}}</p>
          </div>
          <div class="flex space-x-2">
            <label class="text-green-800">Site:</label>
            <p>{{$todos->initiator_site}}</p>
          </div>
          <div class="flex space-x-2">
            <label class="text-green-800">Created By:</label>
            <p>{{$todos->initiator}}</p>
          </div>
          <div class="flex space-x-2">
            <label class="text-green-800">Date Initiated:</label>
            <p>{{$todos->date_initiated}}</p>
          </div>
        </div>
        @livewire('edit-hod',['steps' => $todos->step])

        <hr>
        <div class="flex justify-end space-x-2 px-56 mt-2">
          <label class="text-green-800 font-bold">Total</label>
          <span class="text-danger" id="sum-field">0</span>
        </div>

        <div class="form-row mt-3 flex justify-around">
          <div class="mb-3">
            <label class="text-green-800 font-bold">VAT</label>
            <div>
              {{$todos->vat}}
            </div>
          </div>
          <div class="mb-3">
            <label class="text-green-800 font-bold">Currency</label>
            <div>
              {{$todos->currency}}
            </div>
          </div>

        </div>

        <div class="form-row mt-3">
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold">Expected lead Time</label>
            <div>
              {{$todos->leadT}}
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationCustom02" class="text-green-800 font-bold">Explanation if Urgent</label>
            <div>
              {{$todos->explanation}}
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold">Department</label>
            <div>
              {{$todos->department}}
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold">Site</label>
            <div>
              {{$todos->initiator_site}}
            </div>
          </div>
        </div>

        @if($todos->slmN != "")
        <div class="form-row mt-3">
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">SLM Date Review:</label>
            <div>
              {{$todos->slmD}}
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">SLM Name:</label>
            <div>
              {{$todos->slmN}}
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">SLM Comments:</label>
            <div>
              {{$todos->slmC}}
            </div>
          </div>
        </div>
        @endif

        <div class="form-row mt-3">
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">HOD Decision:</label>
            <select class="form-control" name="status" required="required">
              <option value="">Select Status</option>
              <option value="HOD approved">HOD approved</option>
              <option value="HOD declined">HOD declined</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">HOD Date Review:</label>
            <input type="date" readonly name="hodD" value="{{ date('Y-m-d') }}" class="form-control" required="required">
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">HOD Name:</label>
            <input type="text" name="hodN" readonly value="{{auth()->user()->name}}" class="form-control">
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">HOD Comments:</label>
            <textarea name="hodC" class="form-control">{{$todos->hodC}}</textarea>
          </div>
        </div>


        <div class="form-row mt-3">
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">OP Date Review:</label>
            <div>
              {{$todos->opD}}
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">OP Name:</label>
            <div>
              {{$todos->opN}}
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">OP Comments:</label>
            <div>
              {{$todos->opC}}
            </div>
          </div>
        </div>

        <div class="form-row mt-3">
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">MD/DFO Date Review:</label>
            <div>
              {{$todos->mdD}}
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">MD/DFO Name:</label>
            <div>
              {{$todos->mdN}}
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">MD/DFO Comments:</label>
            <div>
              {{$todos->mdC}}
            </div>
          </div>
        </div>

        <div class="col-sm-12 mt-5">
          <div class="card">
            <div class="card-header">
              <h5>File Upload</h5>
            </div>
            <div class="card-body">
              <div class="fallback dropzon float-left">
                <input type="file" name="image[]" multiple='multiple' />
              </div>
              <div class="float-right mt-4 md:mt-0">
                @livewire('image',['images' => $todos->image])
              </div>
            </div>
          </div>
        </div>

        <div class="text-center m-t-20">
          <button class="btn btn-primary btn-sm rounded-md" type="submit">Update</button>
        </div>



      </form>
    </div>
  </div>
</div>
@endsection