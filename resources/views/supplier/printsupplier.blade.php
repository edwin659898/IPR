<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>BGF | Supplier Information</title>
   <link rel="icon" type="img/ico" href="{{asset('/storage/images/logo.png')}}" />
   <!-- vendor css -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
   <div class="row">
      <!-- [ Invoice ] start -->
      <div class="container" id="printTable">
         <div>
            <div class="card">
               <div class="card-body">
                  <div class="flex justify-center items-center pb-4">
                     <img class="w-12 rounded-full" src="/storage/logo.png" alt="Alex" />
                     <div class="ml-3">
                        <h2 class="text-xl text-blue-600 font-bold">Supplier Information</p>
                     </div>
                  </div>
                  <hr>
                  <p class="mt-4 mb-4 font-bold text-green-800">Company Details</p>

                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class=" mb-0  text-green-800">Company Name</label>
                        <div class="mt-1">
                           {{$todos->company}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">P.O Box</label>
                        <div class="mt-1">
                           {{$todos->box}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Code</label>
                        <div class="mt-1">
                           {{$todos->code}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">City/Town</label>
                        <div class="mt-1">
                           {{$todos->city}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Telephone/Cell Number</label>
                        <div class="mt-1">
                           {{$todos->tel}}
                        </div>
                     </div>
                  </div>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class=" mb-0  text-green-800">Website</label>
                        <div class="mt-1">
                           {{$todos->web}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">E mail</label>
                        <div class="mt-1">
                           {{$todos->mail}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Contact Person</label>
                        <div class="mt-1">
                           {{$todos->contact}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Nature of Business</label>
                        <div class="mt-1">
                           {{$todos->nature}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Physical Location</label>
                        <div class="mt-1">
                           {{$todos->location}}
                        </div>
                     </div>
                  </div>

                  <p class="mt-4 mb-4 font-bold text-green-800">EFT/RTGS Payments</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class=" mb-0  text-green-800">Account No.</label>
                        <div class="mt-1">
                           {{$todos->account}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Bank</label>
                        <div class="mt-1">
                           {{$todos->bank}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Branch</label>
                        <div class="mt-1">
                           {{$todos->branch}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Swift</label>
                        <div class="mt-1">
                           {{$todos->swift}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Sort Code</label>
                        <div class="mt-1">
                           {{$todos->Scode}}
                        </div>
                     </div>
                  </div>
                  <p class="mt-4 mb-4 font-bold text-green-800">Mpesa Payments</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class=" mb-0  text-green-800">Mobile No.</label>
                        <div class="mt-1">
                           {{$todos->number}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Till Number</label>
                        <div class="mt-1">
                           {{$todos->till}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Pay Bill</label>
                        <div class="mt-1">
                           {{$todos->bill}}
                        </div>
                     </div>
                  </div>
                  <p class="mt-4 mb-4 font-bold text-green-800">Other Information</p>
                  <div class="form-row px-3 py-2">
                     <div class="col">
                        <label class=" mb-0  text-green-800">Credit Duration</label>
                        <div class="mt-1">
                           {{$todos->Cduration}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Credit Limit</label>
                        <div class="mt-1">
                           {{$todos->Climit}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Introduced By</label>
                        <div class="mt-1">
                           {{$todos->user->name}}
                        </div>
                     </div>
                     <div class="col">
                        <label class=" mb-0  text-green-800">Site</label>
                        <div class="mt-1">
                           {{$todos->user->site}}
                        </div>
                     </div>
                  </div>

               </div>
            </div>

         </div>
      </div>
      <!-- [ Invoice ] end -->
   </div>
</body>

</html>