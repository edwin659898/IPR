@extends('layouts.main')
@section('content')
<div class="row">
   <!-- [ Invoice ] start -->
   <div class="container" id="printTable">
      <div>
         <form action="{{route('sup.updateSupplier',$todos->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            @include('layouts.flash')
            <div class="card">
               <div class="card-header">
                  <p class="text-green-800 font-bold text-xl">Supplier Review & Approval</p>
                  <div class="card-header-right">
                     <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="feather icon-maximize"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                           <li class="dropdown-item full-card"><a href="#"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                        </ul>
                     </div>
                  </div>
               </div>

               <div class="card-body">
                  <div class="flex justify-center items-center pb-4">
                     <img class="w-12 rounded-full" src="/storage/logo.png" alt="Alex" />
                     <div class="ml-3">
                        <h2 class="text-xl text-blue-600 font-semibold">Supplier Information</p>
                     </div>
                  </div>
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
                  <hr>
                  <p class="mt-4 mb-4 font-bold text-green-800">Company Details</p>

                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h6 mb-0  text-green-800">Company Name</label>
                        <div class="mt-1">
                           {{$todos->company}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">P.O Box</label>
                        <div class="mt-1">
                           {{$todos->box}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Code</label>
                        <div class="mt-1">
                           {{$todos->code}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">City/Town</label>
                        <div class="mt-1">
                        {{$todos->city}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Telephone/Cell Number</label>
                        <div class="mt-1">
                           {{$todos->tel}}
                        </div>
                     </div>
                  </div>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Website</label>
                        <div class="mt-1">
                           {{$todos->web}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">E mail</label>
                        <div class="mt-1">
                           {{$todos->mail}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Contact Person</label>
                        <div class="mt-1">
                           {{$todos->contact}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Nature of Business</label>
                        <div class="mt-1">
                           {{$todos->nature}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Physical Location</label>
                        <div class="mt-1">
                           {{$todos->location}}
                        </div>
                     </div>
                  </div>

                  <p class="mt-4 mb-4 font-bold text-green-800">EFT/RTGS Payments</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Account No.</label>
                        <div class="mt-1">
                           {{$todos->account}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Bank</label>
                        <div class="mt-1">
                           {{$todos->bank}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Branch</label>
                        <div class="mt-1">
                           {{$todos->branch}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Swift</label>
                        <div class="mt-1">
                           {{$todos->swift}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Sort Code</label>
                        <div class="mt-1">
                           {{$todos->Scode}}
                        </div>
                     </div>
                  </div>
                  <p class="mt-4 mb-4 font-bold text-green-800">Mpesa Payments</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Mobile No.</label>
                        <div class="mt-1">
                           {{$todos->number}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Till Number</label>
                        <div class="mt-1">
                           {{$todos->till}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Pay Bill</label>
                        <div class="mt-1">
                           {{$todos->bill}}
                        </div>
                     </div>
                  </div>
                  <p class="mt-4 mb-4 font-bold text-green-800">Other Information</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Credit Duration</label>
                        <div class="mt-1">
                           {{$todos->Cduration}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Credit Limit</label>
                        <div class="mt-1">
                           {{$todos->Climit}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Introduced By</label>
                        <div class="mt-1">
                           {{$todos->user->name}}
                        </div>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Site</label>
                        <div class="mt-1">
                           {{$todos->user->site}}
                        </div>
                     </div>
                  </div>



                  <!-- [ file-upload ] start -->
                  <div class="col-sm-12 mt-5">
                     <div class="card">
                        <div class="card-header">
                           <h5>File Attached</h5>
                        </div>
                        <div class="card-body e">
                           <div class="fallback dropzon float-left">
                              <p><a href="{{route('sup.supplierdoc',$todos->id)}}" target="_blank">{{$todos->file}}</a></p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="text-center m-t-20">
                     <button class="btn btn-primary btn-sm rounded-md" type="submit" name="action" value="approve">Authorize</button>
                     <button class="btn btn-danger btn-sm rounded-md" type="submit" name="action" value="reject">Reject</button>
                  </div>
                  <!-- [ file-upload ] end -->

               </div>
            </div>
         </form>
      </div>
   </div>
   <!-- [ Invoice ] end -->
</div>
@endsection