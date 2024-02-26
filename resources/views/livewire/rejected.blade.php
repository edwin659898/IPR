
<div>
   <div class="card shadow mb-4">
   <div class="card-body">
   <a href="{{route('home')}}" class="navbar-nav ml-auto">
    <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>&larr; Go back</b> </span>
  </a>
   <div class="table-responsive h9 mb-0 font-weight-bold text-red-700">
   <table class="table table-bordered"  width="100%" cellspacing="0">
   <thead class="text-success m-0 font-weight-bold">
   <td>Item</td>
   <td>Description</td>
   <td>UOM</td>
   <td>Required Qty</td>
   <td>Unit Price</td>
   <td>Total Price</td>
   <td>Budget Code</td>
   </thead>
   @foreach($steps as $step)
   @if($step->decision == 'reject')
   <div wire:key="{{$step}}">
   <tr>
   <td><textarea  name="itemN[]"  placeholder="Item" rows="3" required="required">{{$step->step}}</textarea></td>
   <td><textarea  name="itemD[]"  placeholder="Description" rows="3" required="required">{{$step->description}}</textarea></td>
   <td><select  name="UOM[]"  required="required">
	  <option>{{$step->uom}}</option>
		<option>Dozen</option><option>Feet</option><option>Grams</option><option>Ml</option><option>module</option><option>Page</option>
    <option>Inch</option><option>Kg</option><option>Ltrs</option><option>mm</option><option>Mtr</option>	<option>Package</option>
    <option>Pair</option><option>Piece</option><option>Packet</option><option>Ream</option>	<option>Service</option><option>Set</option>
		<option>Box</option><option>Days</option><option>Can</option><option>Hours</option>	<option>Files</option>  <option>Tonnes</option>
    <option>Trees</option></select></td>
    <td><input type="number" step=0.1 name="quantityR[]" id="B{{$loop->index+1}}" oninput="calculate{{$loop->index+1}}();" value="{{$step->quantityR}}" placeholder="Required Quantity" required="required"></td>
    <td><input type="number" step=0.01 id="B{{$loop->index+16}}"  oninput="calculate{{$loop->index+1}}();" name="unitP[]" value="{{$step->unitP}}" placeholder="Unit Price"></td>
    <td><input  type="number" step=0.01 id="B{{$loop->index+33}}"  name="answer[]" value="{{$step->totalP}}" class="txt" onkeyup='update_sum()' placeholder="Total Price"></td>
    <td><input  type="text" name="budget[]" placeholder="Budget Code" value="{{$step->budget}}"></td>
    <tr>
    </div>
    @endif
    @endforeach
    </table>
    </div>
    </div>
    </div>
 </div>
