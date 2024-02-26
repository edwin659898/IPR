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
      <form action="{{route('operation.updateOP',$todos->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="flex justify-center items-center pb-4">
          <img class="w-12 rounded-full" src="/storage/logo.png" alt="Alex" />
          <div class="ml-3">
            <h2 class="text-xl text-green-800 font-semibold">Internal Purchase Requisition</p>
          </div>
        </div>
        <hr>

        @if($errors->any())
        <div class="alert alert-danger">
          <p><strong>Opps Something went wrong</strong></p>
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <div class="form-row space-x-4 m-4 font-bold">
          <div class="flex space-x-2">
            <label class="text-green-800">Ref No:</label>
            <p>{{$todos->id}}</p>
          </div>
          <div class="flex space-x-2">
            <label class="text-green-800">Created By:</label>
            <p>{{$todos->initiator}}</p>
          </div>
          <div class="flex space-x-2">
            <label class="text-green-800">Site:</label>
            <p>{{$todos->initiator_site}}</p>
          </div>
          <div class="flex space-x-2">
            <label class="text-green-800">Date Initiated:</label>
            <p>{{$todos->date_initiated}}</p>
          </div>
        </div>
        @livewire('editadmin',['steps' => $todos->step])

        <hr>
        <div class="flex justify-end space-x-2 px-56 mt-2">
          <label class="text-green-800 font-bold">Total</label>
          <span class="text-danger" id="sum-field">0</span>
        </div>

        <div class="form-row mt-3">
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold">Person To Review</label>
            <select class="form-control" name="reviewer" required>
              <option value="{{auth()->user()->supervisor}}">{{auth()->user()->supervisor}}</option>
              <option value="{{auth()->user()->secondSup}}">{{auth()->user()->secondSup}}</option>
            </select>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold">VAT</label>
            <select class="form-control" name="VAT">
              <option>{{$todos->vat}}</option>
              <option value="">VAT status</option>
              <option value="VAT Inclusive">VAT Inclusive</option>
              <option value="VAT Excluded">VAT Excluded</option>
            </select>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold">Currency</label>
            <select class="form-control" name="currency">
              <option>{{$todos->currency}}</option>
              <option value="">Select Currency</option>
              <option value="Kshs">Kshs</option>
              <option value="UGX">UGX </option>
              <option value="TZS">TZS</option>
              <option value="USD">USD</option>
              <option value="Euro">Euro</option>
            </select>
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
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">HOD Date Review:</label>
            <div>
              {{$todos->hodD}}
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">HOD Name:</label>
            <div>
              {{$todos->hodN}}
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">HOD Comments:</label>
            <div>
              {{$todos->hodC}}
            </div>
          </div>
        </div>


        <div class="form-row mt-3">
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">Review decision:</label>
            <select class="form-control" name="status">
              <option value="">Select Status</option>
              <option value="OP approved">OP approved</option>
              <option value="OP declined">OP declined</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">IPR Type:</label>
            <select class="form-control" name="type">
              <option value="">Select Type</option>
              <option value="opex">Opex</option>
              <option value="capex">Capex</option>
              <option value="software">Software and Licence</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">OP Date Review:</label>
            <input type="date" readonly name="opD" value="{{ date('Y-m-d') }}" class="form-control">
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">OP Name:</label>
            <input type="text" name="opN" readonly value="{{auth()->user()->name}}" class="form-control">
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold mr-1">OP Comments:</label>
            <textarea name="opC" class="form-control">{{$todos->opC}}</textarea>
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
          <button class="btn btn-info btn-sm rounded-md" type="submit" name="action" value="save">Save</button>
          <button class="btn btn-primary btn-sm rounded-md" type="submit" name="action" value="authorize">Authorize</button>
        </div>



      </form>
    </div>
  </div>
</div>
@endsection