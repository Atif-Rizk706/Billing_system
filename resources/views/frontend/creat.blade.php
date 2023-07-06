@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Create invoice
                </div>
                <div class="card-body">
                    <form action="{{route('invoice.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class='form-group'>
                                    <label for="customer_name" >Customer name</label>
                                    <input type="text" name="customer_name" class="form-control">
                                    @error('customer_name')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                </div>

                            </div>
                            <div class="col-4">
                                <div class='form-group'>
                                    <label for="customer_email" >Customer email</label>
                                    <input type="text" name="customer_email" class="form-control">
                                    @error('customer_email')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                </div>

                            </div>
                            <div class="col-4">
                                <div class='form-group'>
                                    <label for="Company_name" >Company name</label>
                                    <input type="text" name="Company_name" class="form-control">
                                    @error('Company_name')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                </div>

                            </div>
                            <div class="col-4">
                                <div class='form-group'>
                                    <label for="Invoice_number" >Invoice number</label>
                                    <input type="text" name="Invoice_number" class="form-control">
                                    @error('Invoice_number')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                </div>

                            </div>
                            <div class="col-4">
                                <div class='form-group'>
                                    <label for="Invoice_date" >Invoice date</label>
                                    <input type="text" name="Invoice_date" class="form-control">
                                    @error('Invoice_date')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                </div>

                            </div>
                            <div class="table-responsive">
                               <table class="table" id="invoice_detales">
                                   <thead>
                                      <tr>
                                          <th></th>
                                          <th>Product name</th>
                                          <th>Unit</th>
                                          <th>Quantity</th>
                                          <th>Unit price </th>
                                          <th>Subtotal</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                   <tr>
                                       <th> </th>
                                       <th>
                                           <input type="text" name="product_name[]" class="product_name form-control" id="product_name">
                                           @error('product_name')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                       </th>
                                       <th>
                                           <select name="unit[]" id="unit" class="unit form-control">
                                               <option></option>
                                               <option value="piece">Piece</option>
                                               <option value="g">Gram</option>
                                               <option value="kgram">K gram</option>
                                           </select>
                                           @error('unit')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                       </th>
                                       <th>
                                           <input type="number" step="0.1" name="Quantity[]" class="Quantity form-control" id="Quantity">
                                           @error('Quantity')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                       </th>
                                       <th>
                                           <input type="number" step="0.1" name="unit_price[]" class="unit_price form-control" id="unit_price">
                                           @error('unit_price')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                       </th>
                                       <th>
                                           <input type="number" step="0.1" name="subtotal[]" class="subtotal form-control" id="subtotal" readonly="readonly">
                                           @error('subtotal')<span class="help-block text-danger" >{{$message}}</span>@enderror
                                       </th>
                                   </tr>
                                   </tbody>
                                   <tfoot>
                                     <tr>
                                         <td colspan="6">
                                             <button type="button" class="btn_add btn btn-primary">Add another product</button>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td colspan="3"></td>
                                         <td colspan="2">Sub total</td>
                                         <td> <input type="number" name="sub_total" id="subtaotalS" class="sub_total form-control" readonly="readonly"></td>
                                     </tr>
                                     <tr>
                                         <td colspan="3"></td>
                                         <td colspan="2">Discount</td>
                                         <td>
                                             <div class="input-group mb-3">
                                                 <select name="discount_type" id="discount_type" class="discount_type custom-select">
                                                     <option value="fixed">SR</option>
                                                     <option value="percentage">Percentage</option>
                                                 </select>
                                                 <div class="input-group-append">
                                                     <input type="number" step="0.1" name="discount_value" id="discount_value" class="discount_value form-control" value="00.0">
                                                 </div>
                                             </div>
                                         </td>

                                     </tr>
                                     <tr>
                                         <td colspan="3"></td>
                                         <td colspan="2">VAT (5%)</td>
                                         <td> <input type="number" step="0.1" name="sub_total" id="vat_val" class="vat_total form-control" readonly="readonly"></td>
                                     </tr>
                                     <tr>
                                         <td colspan="3"></td>
                                         <td colspan="2">Shipping</td>
                                         <td> <input type="number" step="0.1"  id="shipping" name="shipping" class="shipping form-control" ></td>
                                     </tr>
                                     <tr>
                                         <td colspan="3"></td>
                                         <td colspan="2">Total Due</td>
                                         <td> <input type="number" step="0.1"  id="total_due" name="total_due" class="total_due form-control" ></td>
                                     </tr>
                                   </tfoot>

                               </table>
                            </div>
                            <div class="text-right pt-3">
                                  <button type="submit" name="save" class="btn btn-primary"> Save </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        let countity = document.getElementById('Quantity');
        let pric_of_pice = document.getElementById('unit_price');
        function compute_total() {
            document.getElementById('subtotal').value = (countity.value || 0) * (pric_of_pice.value ||0);
            document.getElementById('subtaotalS').value = (countity.value || 0) * (pric_of_pice.value ||0);
            document.getElementById('vat_val').value = calculate_vet();
            document.getElementById('total_due').value = sum_duetotal();
        }
        countity.addEventListener('keyup',compute_total);
        countity.addEventListener('blur',compute_total);
        pric_of_pice.addEventListener('keyup',compute_total);
        pric_of_pice.addEventListener('blur',compute_total);


        let calculate_vet=function (){
            let subtoatal= document.getElementById('subtaotalS').value || 0;
            let descount_type = document.getElementById('discount_type').value;
            let disount_val=parseFloat(document.getElementById('discount_value').value) ||0;
            console.log(descount_type);
            let discount_value=disount_val !=0 ? descount_type=='percentage' ? subtoatal*(disount_val/100) : disount_val : 0;
            let vet = (subtoatal-discount_value) * 0.05;
            console.log(vet);
            return vet.toFixed(2);
        }

        let sum_duetotal=function (){
            let sum=0;
            let subtoatal=$('.sub_total').val() || 0;
            let descount_type=$('.discount_type').value();
            let disount_val=parseFloat($('.discount_value').val()) ||0;

            let discount_value=disount_val !=0 ? descount_type=='percentage' ? subtoatal*(disount_val/100) : disount_val : 0;
            let vat_val = parseFloat($('.vat_total').val()) ||0;
            let shoping= parseFloat($('.shipping').val()) || 0;

            sum+=(subtoatal-discount_value+vat_val+shoping);
            return sum.toFixed(2);
        }


    </script>

@endsection
