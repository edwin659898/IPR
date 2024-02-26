<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IPR | Better Globe Forestry</title>
  <link rel="icon" href="{{asset('storage/logo.png')}}" type="image/x-icon">

  
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
  <div class="mx-auto max-w-7xl p-16">
    <div class="flex justify-center items-center pb-4">
      <img class="w-12 rounded-full" src="/storage/logo.png" alt="Alex" />
      <div class="ml-3">
        <h2 class="text-xl text-green-800 font-semibold">Internal Purchase Requisition</p>
      </div>
    </div>

    <hr>

    <div class="flex space-x-4 mt-4 mb-4 font-bold">
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

    <table class="min-w-full divide-y divide-gray-300">
      <thead class="bg-gray-200">
        <tr>
          <th scope="col" class="py-3 px-2 text-left text-xs font-bold text-green-800 uppercase tracking-wider">
            Item
          </th>
          <th scope="col" class="text-left px-2 text-xs font-bold text-green-800 uppercase tracking-wider">
            Description
          </th>
          <th scope="col" class="text-left px-2 text-xs font-bold text-green-800 uppercase tracking-wider">
            UOM
          </th>
          <th scope="col" class="text-left px-2 text-xs font-bold text-green-800 uppercase tracking-wider">
            Required Qty
          </th>
          <th scope="col" class="text-left px-2 text-xs font-bold text-green-800 uppercase tracking-wider">
            Unit Price
          </th>
          <th scope="col" class="text-left px-2 text-xs font-bold text-green-800 uppercase tracking-wider">
            Total Price
          </th>
          </th>
          <th scope="col" class="text-left px-2 text-xs font-bold text-green-800 uppercase tracking-wider">
            Budget code
          </th>
          </th>
          <th scope="col" class="text-left px-2 text-xs font-bold text-green-800 uppercase tracking-wider">
            Supplier
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-300">
        @foreach($todos->step as $step)
        @if($step->decision == 'accept')
        <tr>
          <td class="whitespace-nowrap py-3 px-2">
            {{$step->step}}
          </td>
          <td class="text-wrap px-2">
            {{$step->description}}
          </td>
          <td class="whitespace-nowrap  px-2">
            {{$step->uom}}
          </td>
          <td class="whitespace-nowrap  px-2">
            {{$step->quantityR}}
          </td>
          <td class="whitespace-nowrap px-2">
            {{$step->unitP}}
          </td>
          <td class="whitespace-wrap px-2r">
            <input type="number" class="txt" style="width: 100px;" step=0.01 name="answer[]" onkeyup='update_sum()' value="{{$step->totalP}}" readonly>
          </td>
          <td class="whitespace-wrap mr-5 px-2">
            {{$step->budget}}
          </td>
          <td class="whitespace-nowrap px-2">
            {{$step->supplier}}
          </td>
        </tr>
        @endif
        @endforeach
      </tbody>
    </table>
    <hr>
    <div class="flex justify-end space-x-2 px-56 mt-2">
      <label class="text-green-800 font-bold">Total</label>
      <span class="text-danger" id="sum-field">0</span>
    </div>

    <div class="mt-6 px-10 flex flex-1 justify-between">
      <div class="mb-3">
        <label class="text-green-800 font-bold">Expected lead Time</label>
        <div>
          {{$todos->leadT}}
        </div>
      </div>
      <div class="mb-3">
        <label for="validationCustom02" class="text-green-800 font-bold">Explanation if Urgent</label>
        <div>
          {{$todos->explanation}}
        </div>
      </div>
      <div class="mb-3">
        <label class="text-green-800 font-bold">Department</label>
        <div>
          {{$todos->department}}
        </div>
      </div>
      <div class="mb-3 ml-5">
        <label class="text-green-800 font-bold">VAT</label>
        <div>
          {{$todos->vat}}
        </div>
      </div>
      <div class="mb-3 mr-5">
        <label class="text-green-800 font-bold">Currency</label>
        <div>
          {{$todos->currency}}
        </div>
      </div>

    </div>

    @if($todos->slmN != '')
    <div class="px-10 flex mt-2">
      <div class="mb-3 w-1/4">
        <label class="text-green-800 font-bold">SLM Date Review:</label>
        <div>
          {{$todos->slmD}}
        </div>
      </div>
      <div class="mb-3 w-1/4">
        <label class="text-green-800 font-bold">SLM Name:</label>
        <div>
          {{$todos->slmN}}
        </div>
      </div>
      <div class="mb-3 w-1/2">
        <label class="text-green-800 font-bold">SLM Comments:</label>
        <div>
          {{$todos->slmC}}
        </div>
      </div>
    </div>
    @endif

    @if($todos->hodN != '')
    <div class="px-10 flex mt-2">
      <div class="mb-3 w-1/4">
        <label class="text-green-800 font-bold">HOD Date Review:</label>
        <div>
          {{$todos->hodD}}
        </div>
      </div>
      <div class="mb-3 w-1/4">
        <label class="text-green-800 font-bold">HOD Name:</label>
        <div>
          {{$todos->hodN}}
        </div>
      </div>
      <div class="mb-3 w-1/2">
        <label class="text-green-800 font-bold">HOD Comments:</label>
        <div>
          {{$todos->hodC}}
        </div>
      </div>
    </div>
    @endif

    @if($todos->opN != '')
    <div class="px-10 flex mt-2">
      <div class="mb-3 w-1/4">
        <label class="text-green-800 font-bold">OPM Date Review:</label>
        <div>
          {{$todos->opD}}
        </div>
      </div>
      <div class="mb-3 w-1/4">
        <label class="text-green-800 font-bold">OPM Name:</label>
        <div>
          {{$todos->opN}}
        </div>
      </div>
      <div class="mb-3 w-1/2">
        <label class="text-green-800 font-bold">OPM Comments:</label>
        <div>
          {{$todos->opC}}
        </div>
      </div>
    </div>
    @endif

    <div class="px-10 flex mt-2">
      <div class="mb-3 w-1/4">
        @if($todos->status == 'MD approved')
        <label class="text-green-800 font-bold mr-1">MD Date Review:</label>
        @else
        <label class="text-green-800 font-bold mr-1">DFO Date Review:</label>
        @endif
        <div>
          {{$todos->mdD}}
        </div>
      </div>
      <div class="mb-3 w-1/4">
        @if($todos->status == 'MD approved')
        <label class="text-green-800 font-bold">MD Name:</label>
        @else
        <label class="text-green-800 font-bold">DFO Name:</label>
        @endif
        <div>
          {{$todos->mdN}}
        </div>
      </div>
      <div class="mb-3 w-1/2">
        @if($todos->status == 'MD approved')
        <label class="text-green-800 font-bold">MD Comments:</label>
        @else
        <label class="text-green-800 font-bold">DFO Comments:</label>
        @endif
        <div>
          {{$todos->mdC}}
        </div>
      </div>
    </div>


    <div class="mt-4 float-right">
      <label class="text-gray-500 text-sm">Status: {{$todos->status}}</label>   
    </div>

  </div>



  <script>
    function update_sum() {
      let sum = [...document.querySelectorAll('.txt')].reduce((acc, cur) => {
        return Number(cur.value) + acc
      }, 0);

      document.getElementById("sum-field").textContent = sum;
    }
    update_sum();
  </script>

</body>

</html>