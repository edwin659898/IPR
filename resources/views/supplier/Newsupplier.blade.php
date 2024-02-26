@extends('layouts.main')
@section('content')
<div class="row">
   <!-- [ Invoice ] start -->
   <div class="container" id="printTable">
      <div>
         <form action="{{route('sup.storeSupplier')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('layouts.flash')
            <div class="card">
               <div class="card-header">
                  <p class="text-green-800 font-bold text-xl">Introduce Supplier</p>
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
                        <h2 class="text-xl text-blue-600 font-semibold">New Supplier Form</p>
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
                        <textarea class="form-control" name="company" rows="3" required="required"></textarea>
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">P.O Box</label>
                        <input name="box" class="form-control" value="" required="required">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Code</label>
                        <input name="code" class="form-control" value="" required="required">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">City/Town</label>
                        <input name="city" class="form-control" value="" required="required">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Telephone/Cell Number</label>
                        <input type="tel" name="tel" class="form-control" value="" required="required">
                     </div>
                  </div>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Website</label>
                        <input type="text" name="web" class="form-control" value="" required="required">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">E mail</label>
                        <input type="email" name="mail" class="form-control" value="" required="required">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Contact Person</label>
                        <input type="text" name="contact" class="form-control" value="" required="required">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Nature of Business</label>
                        <input type="text" name="nature" class="form-control" value="" required="required">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Physical Location</label>
                        <input type="text" name="location" class="form-control" value="" required="required">
                     </div>
                  </div>

                  <p class="mt-4 mb-4 font-bold text-green-800">EFT/RTGS Payments</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Account No.</label>
                        <input name="account" class="form-control" value="">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Bank</label>
                        <input name="bank" class="form-control" value="">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Branch</label>
                        <input name="branch" class="form-control" value="">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Swift</label>
                        <input name="swift" class="form-control" value="">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Sort Code</label>
                        <input type="number" class="form-control" name="Scode" value="">
                     </div>
                  </div>
                  <p class="mt-4 mb-4 font-bold text-green-800">Mpesa Payments</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Mobile No.</label>
                        <input name="number" class="form-control" value="">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Till Number</label>
                        <input name="till" class="form-control" value="">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Pay Bill</label>
                        <input name="bill" class="form-control" value="">
                     </div>
                  </div>
                  <p class="mt-4 mb-4 font-bold text-green-800">Other Information</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Credit Duration</label>
                        <input name="Cduration" class="form-control" value="">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Credit Limit</label>
                        <input name="Climit" class="form-control" value="">
                     </div>
                     <div class="col" <label class="h8 mb-0  text-green-800">Introduced By</label>
                        <input type="text" name="intro" readonly class="form-control" value="{{auth()->user()->name}}">
                     </div>
                     <div class="col">
                        <label class="h8 mb-0  text-green-800">Site</label>
                        <input type="text" readonly name="site" class="form-control" value="{{auth()->user()->site}}">
                     </div>
                  </div>



                  <!-- [ file-upload ] start -->
                  <div class="col-sm-12 mt-5">
                     <div class="card">
                        <div class="card-header">
                           <h5>File Upload</h5>
                        </div>
                        <div class="card-body e">
                           <div class="fallback dropzon float-left">
                              <input type="file" name="image" />
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="text-center m-t-20">
                     <button class="btn btn-primary btn-sm rounded-md" type="submit">Submit</button>
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