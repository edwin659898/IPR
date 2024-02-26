<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div id="wrapper">
   <div id="form_div">
      <div class="table-responsive">
         <table id="employee_table" class="table invoice-detail-table">
            <thead>
               <tr class="thead-default">
                  <th>Item</th>
                  <th>Description</th>
                  <th>UOM</th>
                  <th>Required Qty</th>
                  <th>Unit Price</th>
                  <th>Total Price</th>
                  <th>Budget code</th>
                  <th>Supplier</th>
                  <th>Decision</th>
               </tr>
            </thead>
            @foreach($steps as $step)
            @if($step->decision == 'accept')
            <div>
               <tr>
                  <td>{{$step->step}}
                     <input type="hidden" name="stepId[]" value="{{$step->id}}">
                  </td>
                  <td>{{$step->description}}</td>
                  <td>{{$step->uom}}</td>
                  <td><input type="number" class="auto-calc unit-price" step=0.1 name="quantityR[]" value="{{$step->quantityR}}" readonly></td>
                  <td><input type="number" class="auto-calc amount" step=0.01 name="unitP[]" value="{{$step->unitP}}" readonly></td>
                  <td><input type="number" class="txt total-cost" step=0.01 name="answer[]" onkeyup='update_sum()' value="{{$step->totalP}}" readonly></td>
                  <td>{{$step->budget}}</td>
                  <td>
                     {{$step->supplier}}
                  </td>
                  <td><select name="decision[]">
                        <option value="accept">Accept</option>
                        <option value="reject">Reject</option>
                     </select>
                  </td>
               <tr>
            </div>
            @endif
            @endforeach
         </table>
      </div>
   </div>
</div>

<script>
   $(document).on("keyup change paste", "td > input.auto-calc", function() {
      row = $(this).closest("tr");
      first = row.find("td input.unit-price").val();
      second = row.find("td input.amount").val();
      row.find(".total-cost").val(first * second);
   });
</script>