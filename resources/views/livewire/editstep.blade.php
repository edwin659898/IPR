<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div id="wrapper">
  <div id="form_div">
    <div class="flex justify-center mb-1">
      <input type="button" class="btn btn-primary btn-sm rounded-md" onclick="add_row();" value="ADD ROW">
    </div>
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
          </tr>
        </thead>
        @foreach($steps as $step)
        @if($step->decision == 'accept')
        <div>
          <tr>
            <td><textarea name="stepName[]" placeholder="Item" rows="3" required="required">{{$step->step}}</textarea>
              <input type="hidden" name="stepId[]" value="{{$step->id}}"></textarea>
            </td>
            <td><textarea name="itemD2[]" placeholder="Description" rows="3" required="required">{{$step->description}}</textarea></td>
            <td><select name="UOM2[]" required="required">
                <option>{{$step->uom}}</option>
                <option>Dozen</option>
                <option>Feet</option>
                <option>Grams</option>
                <option>Ml</option>
                <option>module</option>
                <option>Page</option>
                <option>Inch</option>
                <option>Kg</option>
                <option>Ltrs</option>
                <option>mm</option>
                <option>Mtr</option>
                <option>Package</option>
                <option>Pair</option>
                <option>Piece</option>
                <option>Packet</option>
                <option>Ream</option>
                <option>Service</option>
                <option>Set</option>
                <option>Box</option>
                <option>Days</option>
                <option>Can</option>
                <option>Hours</option>
                <option>Files</option>
                <option>Tonnes</option>
                <option>Trees</option>
              </select></td>
            <td><input type="number" class="auto-calc unit-price" step=0.1 name="quantityR2[]" value="{{$step->quantityR}}" required="required"></td>
            <td><input type="number" class="auto-calc amount" step=0.01 name="unitP2[]" value="{{$step->unitP}}"></td>
            <td><input type="number" class="txt total-cost" step=0.01 name="answer2[]" onkeyup='update_sum()' value="{{$step->totalP}}" readonly></td>
            <td><input type="text" name="budget2[]" placeholder="Budget Code" value="{{$step->budget}}"></td>
          <tr>
        </div>
        @endif
        @endforeach
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  add_row()

  function add_row() {
    $rowno = $("#employee_table tr").length;
    $rowno = $rowno + 1;
    $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><textarea  name='itemN[]' class='form-control' placeholder='Item'  rows='3' required></textarea></td>'\
 '<td><textarea  name='itemD[]' class='form-control' placeholder='Description' rows='3' required></textarea></td>'\
 '<td><select  name='UOM[]' class='form-control' required='required'>'\
 '<option disabled selected>UOM</option><option>Dozen</option><option>Feet</option><option>Grams</option><option>Ml</option><option>module</option>'\
 '<option>Page</option><option>Inch</option><option>Kg</option><option>Ltrs</option><option>mm</option><option>Mtr</option> <option>Package</option>'\
 '<option>Pair</option><option>Piece</option><option>Packet</option><option>Ream</option> <option>Service</option><option>Minutes</option><option>Set</option>'\
 '<option>Box</option><option>Days</option><option>Can</option><option>Hours</option> <option>Files</option><option>number</option><option>GB</option><option>m3</option><option>bundles</option><option>PAX</option><option>Tonnes</option>'\
 '<option>Trees</option></select></td>'\
 '<td><input type='number'step=0.1 name='quantityR[]' onkeyup='calculate_total()' class='form-control' placeholder='Required Quantity' required='required'></td>'\
 '<td><input type='number' step=0.01 name='unitP[]' onkeyup='calculate_total()' class='form-control' placeholder='Unit Price'></td>'\
 '<td><input  type='number'  step=0.01 id='total_field" + $rowno + "' onkeyup='update_sum()' readonly class='txt form-control' name='answer[]'' placeholder='Total Price'></td>'\
 '<td><input  type='text' class='form-control' name='budget[]' placeholder='Budget Code'> <input type='button' class='btn btn-danger btn-sm mt-1 float-right rounded-md' value='DELETE' onclick=delete_row('row" + $rowno + "')></td>'</tr>");
  }

  function delete_row(rowno) {
    $('#' + rowno).remove();
  }

  function calculate_total() {
    let parent = $("#employee_table tr[id^=row]");
    parent.each(function() {
      let total = 0;
      let units = $(this).find("input[name^=quantityR]");
      let q = $(this).find("input[name^=unitP]");
      total += Number(units.val()) * Number(q.val());
      total = total.toFixed(2) // I added this line
      $(this).find('input[id^=total_field]').val(total);
    });
    return total;
  }
</script>
<script>
  $(document).on("keyup change paste", "td > input.auto-calc", function() {
    row = $(this).closest("tr");
    first = row.find("td input.unit-price").val();
    second = row.find("td input.amount").val();
    row.find(".total-cost").val(first * second);
  });
</script>