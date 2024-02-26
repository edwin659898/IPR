@extends('layouts.main')

@section('content')
<!-- [ sample-page ] start -->
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
      <form action="{{route('user.update',$todos->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="flex justify-center items-center pb-4">
          <img class="w-12 rounded-full" src="/storage/logo.png" alt="Alex" />
          <div class="ml-3">
            <h2 class="text-xl text-green-800 font-semibold">Internal Purchase Requisition</p>
          </div>
        </div>
        <hr>

        <div class="form-row space-x-4 mt-4 font-bold">
          <div class="flex space-x-2">
            <label class="text-green-800">Ref No:</label>
            <p>{{$todos->id}}</p>
          </div>
          <div class="flex space-x-2">
            <label class="text-green-800">Site:</label>
            <p>{{$todos->initiator_site}}</p>
          </div>
        </div>
        @livewire('editstep',['steps' => $todos->step])

        <hr>
        <div class="flex justify-end space-x-2 px-56 mt-2">
          <label class="text-green-800 font-bold">Total</label>
          <span class="text-danger" id="sum-field">0</span>
        </div>

        <div class="form-row mt-3">
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold">Person To Review</label>
            <select class="form-control" name="reviewer">
              <option value="{{auth()->user()->supervisor}}">{{auth()->user()->supervisor}}</option>
              <option value="{{auth()->user()->secondSup}}">{{auth()->user()->secondSup}}</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationCustom02" class="text-green-800 font-bold">Date Initiated</label>
            <input type="text" class="form-control" name="initiatedDate" readonly value="{{$todos->date_initiated}}">
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold">VAT</label>
            <select class="form-control" name="VAT">
              <option>{{$todos->vat}}</option>
              <option value="">VAT status</option>
              <option value="VAT Inclusive">VAT Inclusive</option>
              <option value="VAT Excluded">VAT Excluded</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
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
            <input class="form-control" type="number" name="leadT" value="{{$todos->leadT}}">
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationCustom02" class="text-green-800 font-bold">Explanation if Urgent</label>
            <textarea class="form-control" name="urgencyE" placeholder="Message" rows="2">{{$todos->explanation}}</textarea>
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold">Department</label>
            <select class="form-control" name="department" required>
              <option value="{{$todos->department}}">{{$todos->department}}</option>
              <option value="IT">IT</option>
              <option value="Accounts">Accounts </option>
              <option value="HR">HR</option>
              <option value="Communications">Communications</option>
              <option value="Forestry">Forestry</option>
              <option value="Miti Magazines">Miti Magazine</option>
              <option value="Operations">Operations</option>
              <option value="M&E">M&E</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold">Site</label>
            <input readonly class="form-control" name="site" value="{{$todos->initiator_site}}">
          </div>
          <div class="col-md-3 mb-3">
            <label class="text-green-800 font-bold">Type</label>
            <td>
              <select class="form-control" name="type" required>
                <option value="">-- Select Type --</option>
                <option value="normal">Normal</option>
                <option value="construction">Building</option>
                <option value="software">Softwares and Licences</option>
              </select>
            </td>
          </div>
        </div>

        <div class="form-row mt-3">
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">SLM Date Review:</label>
            {{$todos->slmD}}
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">SLM Name:</label>
            {{$todos->slmN}}
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-green-800 font-bold mr-1">SLM Comments:</label>
            {{$todos->slmC}}
          </div>
        </div>

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
<!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->
@endsection