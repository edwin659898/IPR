@extends('layouts.main')
@section('content')
<!-- [ Main Content ] start -->
<div class="row">
    <!-- [ Invoice ] start -->
    <div class="container" id="printTable">
        <div>
            <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('layouts.flash')
                <div class="card">
                    <div class="card-header">
                        <p class="text-green-800 font-bold text-xl">New IPR</p>
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
                                <h2 class="text-xl text-green-800 font-semibold">Internal Purchase Requisition Form</p>
                            </div>
                        </div>
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
                                    </table>
                                </div>
                            </div>
                        </div>

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
                                <input type="text" class="form-control" name="initiatedDate" readonly value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-green-800 font-bold">VAT</label>
                                <select class="form-control" name="VAT">
                                    <option value="">VAT status</option>
                                    <option value="VAT Inclusive">VAT Inclusive</option>
                                    <option value="VAT Excluded">VAT Excluded</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-green-800 font-bold">Currency</label>
                                <select class="form-control" name="currency">
                                    <option value="">Select Currency</option>
                                    <option value="EURO">EURO</option>
                                    <option value="KSHS">KSHS</option>
                                    <option value="TZS">TZS</option>
                                    <option value="UGX">UGX </option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-row mt-3">
                            <div class="col-md-3 mb-3">
                                <label class="text-green-800 font-bold">Expected lead Time</label>
                                <input class="form-control" type="number" name="leadT" placeholder="In days">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom02" class="text-green-800 font-bold">Explanation if Urgent</label>
                                <textarea class="form-control" name="urgencyE" placeholder="Message" rows="2"></textarea>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-green-800 font-bold">Department</label>
                                @if(!auth()->user()->slm)
                                <input type="text" class="form-control" readonly name="department" value="{{auth()->user()->department}}">
                                @else
                                <select class="form-control" name="department" required>
                                    <option value="">Select Department</option>
                                    <option value="Accounts">Accounts </option>
                                    <option value="Communications">Communications</option>
                                    <option value="Forestry">Forestry</option>
                                    <option value="HR">HR</option>
                                    <option value="IT">IT</option>
                                    <option value="Miti Magazines">Miti Magazine</option>
                                    <option value="Operations">Operations</option>
                                    <option value="M&E">M&E</option>
                                </select>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-green-800 font-bold">Site</label>
                                @if(auth()->user()->special)
                                <td>
                                    <select class="form-control" name="site" required>
                                        <option value="{{auth()->user()->site}}">{{auth()->user()->site}}</option>
                                        <option value="7 Forks">7 Forks</option>
                                        <option value="Kampala HO">Kampala HO</option>
                                    </select>
                                </td>
                                @else
                                <td>
                                    <input type="text" class="form-control" readonly name="site" value="{{auth()->user()->site}}">
                                </td>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-green-800 font-bold">Type</label>
                                <td>
                                    <select class="form-control" name="type" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="construction" title="Related to the UG office building">Building</option>
                                        <option value="normal" title="Normal covers both opex and capex">Normal</option>
                                        <option value="softwares" title="Related to software computer licenses only">Software and Licences</option>
                                    </select>
                                </td>
                            </div>
                        </div>

                        <div class="form-group">
                            @if(auth()->user()->site == 'Nyongoro' || auth()->user()->site == 'Kiambere' || auth()->user()->site == '7 Forks')
                            <div class="col-md-3 mb-1">
                                <label class="text-green-800 font-bold">Site Reviewer</label>
                                <select class="form-control" name="site_inspector" required>
                                    <option value="SLM">SLM</option>
                                    <option value="SLO">SLO</option>
                                </select>
                            </div>
                            @else
                            <input type="hidden" name="site_inspector" value="0">
                            @endif
                        </div>

                        <!-- [ file-upload ] start -->
                        <div class="col-sm-12 mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5>File Upload</h5>
                                </div>
                                <div class="card-body e">
                                    <div class="fallback dropzon float-left">
                                        <input type="file" name="image[]" multiple='multiple' />
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
<!-- [ Main Content ] end -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    add_row()

    function add_row() {
        $rowno = $("#employee_table tr").length;
        $rowno = $rowno + 1;
        $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><textarea  name='itemN[]' class='form-control' placeholder='Item'  rows='3' required></textarea></td>'\
 '<td><textarea  name='itemD[]' class='form-control' placeholder='Description' rows='3' required></textarea></td>'\
 '<td><select  name='UOM[]' class='form-control' required>'\
 '<option value=''>UOM</option><option value='Dozen'>Dozen</option><option value='Feet'>Feet</option><option value='Grams'>Grams</option><option value='Ml'>Ml</option><option value='module'>Module</option><option value='minutes'>Minutes</option>'\
 '<option value='Page'>Page</option><option value='Inch'>Inch</option><option value='Kg'>Kg</option><option value='Ltrs'>Ltrs</option><option value='mm'>mm</option><option value='Mtr'>Mtr</option> <option value='Package'>Package</option>'\
 '<option value='Pair'>Pair</option><option value='Piece'>Piece</option><option value='Packet'>Packet</option><option value='Ream'>Ream</option> <option value='Service'>Service</option><option value='Set'>Set</option>'\
 '<option value='Box'>Box</option><option value='Days'>Days</option><option value='Can'>Can</option><option value='Hours'>Hours</option> <option value='Files'>Files</option><option value='number'>Number</option><option value='GB'>GB</option><option value='m3'>m3</option><option value='bundles'>Bundles</option><option value='PAX'>PAX</option><option value='Tonnes'>Tonnes</option>'\
 '<option value='Trees'>Trees</option></select></td>'\
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
@endsection