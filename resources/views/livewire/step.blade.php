<div id="wrapper">
<div id="form_div">
  <a href="{{route('home')}}" class="navbar-nav ml-auto">
      <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>&larr; Go back</b> </span>
    </a>
    <input type="button" class="btn btn-primary" onclick="add_row();" value="ADD ROW">
  <table id="employee_table" class="table table-bordered"  width="100%" cellspacing="0">
    <thead class="text-success m-0 font-weight-bold">
    <td>Item</td>
    <td>Description</td>
    <td>UOM</td>
    <td>Required Qty</td>
    <td>Unit Price</td>
    <td>Total Price</td>
    <td>Budget Code</td>
    </thead>
  </table>
</div>

</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
 '<option>Pair</option><option>Piece</option><option>Packet</option><option>Ream</option> <option>Service</option><option>Set</option>'\
 '<option>Box</option><option>Days</option><option>Can</option><option>Hours</option> <option>Files</option><option>number</option><option>Minutes</option><option>GB</option><option>m3</option><option>bundles</option><option>PAX</option><option>Tonnes</option>'\
 '<option>Trees</option></select></td>'\
 '<td><input type='number'step=0.1 name='quantityR[]' onkeyup='calculate_total()' class='form-control' placeholder='Required Quantity' required='required'></td>'\
 '<td><input type='number' step=0.01 name='unitP[]' onkeyup='calculate_total()' class='form-control' placeholder='Unit Price'></td>'\
 '<td><input  type='number'  step=0.01 id='total_field"+ $rowno + "' onkeyup='update_sum()' readonly class='txt' name='answer[]'' placeholder='Total Price'></td>'\
 '<td><input  type='text' class='form-control' name='budget[]' placeholder='Budget Code'> <input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row"+ $rowno + "')></td>'</tr>");
}
function delete_row(rowno) {
  $('#' + rowno).remove();
}

function calculate_total() {
  let parent = $("#employee_table tr[id^=row]");
  parent.each(function () {
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
