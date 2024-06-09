@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-scrollable">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Order Products</h4>
                        <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#addProductModal">
                            <i class="fa fa-plus"></i> Add New Product
                        </a>
                    </div>
                    <form action=" {{route('orders.store')}} " method="post">
                        @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Disc (%)</th>
                                    <th>Total</th>
                                    <th><a href="#" class="btn btn-sm btn-success add_more rounded-circle"><i class="fa fa-plus"></i></a></th>
                                </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <select name="product_id[]" id="product_id" class="form-control product_id">
                                            <option value="">Select Item</option>
                                            @foreach ($products as $product)
                                            <option data-price="{{ $product->price }}" value="{{ $product->id }}">
                                                {{ $product->product_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" id="quantity" class="form-control quantity">
                                    </td>
                                    <td>
                                        <input type="number" name="price[]" id="price" class="form-control price">
                                    </td>
                                    <td>
                                        <input type="number" name="discount[]" id="discount" class="form-control discount">
                                    </td>
                                    <td>
                                        <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount" readonly>
                                    </td>
                                    <td><a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Total <b class="total">0,00</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="btn-group">
                            <button type="button" 
                            onclick="PrintReceiptContent('print')" 
                            class="btn btn-dark"><i class="fa fa-print" ></i>Print
                        </button>
                        <button type="button" 
                            onclick="PrintReceiptContent('print')" 
                            class="btn btn-primary"><i class="fa fa-print" ></i>History
                        </button>
                        <button type="button" 
                            onclick="PrintReceiptContent('print')" 
                            class="btn btn-danger"><i class="fa fa-print" ></i>Report
                        </button>
                        </div>
                        <div class="panel">
                            <div class="row">
                                <table class="table table-striped">
                                    <tr>
                                        <td>
                                            <label for="customer_name">Customer Name</label>
                                                <input type="text" name="customer_name" class="form-control" id="customer_name">
                                        </td>
                                        <td>
                                            <label for="customer_phone">Customer Phone</label>
                                                <input type="number" name="customer_phone" class="form-control" id="customer_phone">
                                        </td>
                                    </tr>
                                </table>

                                <td> Payment Method <br>
                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" 
                                        class="true" value="cash" checked="checked">
                                        <label for="payment_method"> <i class="fa fa-money-bill text-success"></i> Cash</label>
                                    </span>

                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" 
                                        class="true" value="bank transfer" >
                                        <label for="payment_method"> <i class="fa fa-university text-danger"></i> Bank Transfer</label>
                                    </span>

                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_method" 
                                        class="true" value="credit card" >
                                        <label for="payment_method"> <i class="fa fa-credit-card text-info"></i> Credit Card</label>
                                    </span>
                                </td><br>
                                
                                <td>
                                    Payment 
                                    <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                </td>
                                <td>
                                    Returning Change 
                                    <input type="number" readonly name="balance" id="balance" class="form-control">
                                </td>
                                <td>
                                    <button class="btn-primary brn-lg btn-block mt-3">Save</button>
                                </td>
                                <div class="text-center" style="text-allign: center !important">
                                    <a href="#" class="text-danger text-center"><i class="fa fa-sign-out-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal right fade" id="addProductModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addProductModalLabel">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="alert_stock">Alert Stock</label>
                        <input type="number" name="alert_stock" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="2" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal">
    <div id="print">
        @include('reports.receipt')
    </div>
</div>

<style>
    .modal.right .modal-dialog {
        top: 0;
        right: 0;
        margin-right: 19vh;
    }
    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate 3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
    .radio-item input[type="radio"]{
        visibility: hidden;
        width: 20px;
        height: 20px;
        margin: 0 5px 0;
        padding: 0;
        cursor: pointer;
    }
    /* before style */
    .radio-item input[type="radio"]:before{
        position: realtive;
        margin: 4px -25px -4px 0;
        display: inline-block;
        visibility: visible;
        width: 20px;
        height: 20px;
        border-radius: 10px;
        border: 2px inset rgb(150, 150, 150, 0.75);
        background: radial-gradient(ellipse at top left, rgb(255, 255, 255) 0%, 
                rgb(250, 250, 250) 5%, rgb(230, 230, 230) 95%, rgb(225, 225, 225) 100%);
        content: '';
        cursor: pointer;
    }
    /* checked after style */
    .radio-item input[type="radio"]:checked:after{
        position: realtive;
        top: 0;
        left: 9px;
        display: inline-block;
        border-radius: 6px;
        visibility: visible;
        width: 12px;
        height: 12px;
        background: radial-gradient(ellipse at top left, rgb(240, 255, 220) 0%, 
                rgb(225, 250, 100) 5%, rgb(75, 75, 0) 95%, rgb(25, 100, 0) 100%);
        content: '';
        cursor: pointer;
    }
    /* after style */
    .radio-item input[type="radio"].true:checked:after{
        background: radial-gradient(ellipse at top left, rgb(240, 255, 220) 0%, 
                rgb(225, 250, 100) 5%, rgb(75, 75, 0) 95%, rgb(25, 100, 0) 100%);
    }
    .radio-item input[type="radio"].false:checked:after{
        background: radial-gradient(ellipse at top left, rgb(255, 255, 255) 0%, 
                rgb(250, 250, 250) 5%, rgb(230, 230, 230) 95%, rgb(225, 225, 225) 100%);
    }
    .radio-item label{
        display: inline-block;
        margin: 0;
        padding: 0;
        line-height: 25px;
        height: 25px;
        cursor: pointer;
    }
    .card-scrollable {
        max-height: 80vh;
        overflow-y: auto;
    }
    .table-responsive {
        max-height: 70vh;
        overflow-y: auto;
    }
</style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.add_more').on('click', function(){
                var product = $('.product_id').html();
                var numberofrow = $('.addMoreProduct tr').length + 1;
                var tr = '<tr><td class="no">' + numberofrow + '</td>' +
                    '<td><select class="form-control product_id" name="product_id[]">' + product + 
                    '</select></td>' + 
                    '<td><input type="number" name="quantity[]" class="form-control quantity"></td>'+
                    '<td><input type="number" name="price[]" class="form-control price"></td>'+
                    '<td><input type="number" name="discount[]" class="form-control discount"></td>'+
                    '<td><input type="number" name="total_amount[]" class="form-control total_amount" readonly></td>'+
                    '<td><a class="btn btn-sm btn-danger rounded-circle delete"><i class="fa fa-times"></i></a></td></tr>';
                $('.addMoreProduct').append(tr);
                TotalAmount();
            });

            $('.addMoreProduct').delegate('.delete', 'click', function(){
                $(this).closest('tr').remove();
                TotalAmount();
            });

            function formatRupiah(amount){
                return 'Rp' + numeral(amount).format('0,0.00');
            }

            function TotalAmount(){
                var total = 0;
                $('.total_amount').each(function(){
                    total += parseFloat($(this).val() || 0);
                });
                $('.total').html(formatRupiah(total));
            }

            $('.addMoreProduct').delegate('.product_id, .quantity, .price, .discount', 'change keyup', function(){
                var tr = $(this).closest('tr');
                var qty = tr.find('.quantity').val() || 0;
                var disc = tr.find('.discount').val() || 0;
                var price = tr.find('.price').val() || 0;
                var total_amount = (qty * price) - ((qty * price * disc) / 100);
                tr.find('.total_amount').val(total_amount);
                TotalAmount();
            });

            $('.addMoreProduct').delegate('.product_id', 'change', function(){
                var tr = $(this).closest('tr');
                var price = tr.find('.product_id option:selected').data('price') || 0;
                tr.find('.price').val(price);
                var qty = tr.find('.quantity').val() || 0;
                var disc = tr.find('.discount').val() || 0;
                var total_amount = (qty * price) - ((qty * price * disc) / 100);
                tr.find('.total_amount').val(total_amount);
                TotalAmount();
            });

            $('#paid_amount').on('keyup', function(){
                var total = numeral($('.total').text().replace('Rp', '')).value() || 0;
                var paid_amount = parseFloat($(this).val()) || 0;
                var tot = paid_amount - total;
                $('#balance').val(tot.toFixed(2));
            });
        });

        // Print Section
        function PrintReceiptContent(el) {
            // var data = '<input type="button" id="printPageButton" class="printPageButton" style="display: block; width: 100%; border: none; background-color: #008B8B; color: #fff; padding: 14px 28px; font-size: 16px; cursor: pointer; text-align: center;" value="Print Receipt" onClick="window.print()">';
            // data += document.getElementById(el).innerHTML;

            var data = document.getElementById(el).innerHTML;
            
            var myReceipt = window.open("", "myWin", "left=150, top=130, width=400, height=400");
            myReceipt.screenX = 0;
            myReceipt.screenY = 0;
            myReceipt.document.write(data);
            myReceipt.document.title = "Print Receipt";
            myReceipt.focus();
            setTimeout(() => {
                myReceipt.close();
            }, 80000);
}

    </script>
@endsection
