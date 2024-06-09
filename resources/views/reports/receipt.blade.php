<?php
date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan zona waktu yang sesuai
?>

<div id="invoice-POS">
    <!-- {{-- Print Section --}} -->
    <div class="printed_content">
        <center id="logo">
            <div class="logo"></div>
            <div class="info"></div>
                <h2>Dapur Bu Noenk</h2>
        </center>
    </div>
    
    <div class="mid">
        <div class="info">
            <h2>Contact Us</h2>
            <p>
                Alamat: Jl. Danau Singkarak E4 E-14, Sawojajar, Kota Malang<br>
                No. Telp: 089514372717<br>
                Instagram: dapur_bunoenk
            </p>
        </div>
        <div class="buyer-info">
            <h2>Buyer Information</h2>
            <p>
                Name: {{ $buyerName }}<br>
                Phone: {{ $buyerPhone }}
            </p>
        </div>
    </div>
    <!-- End of Receipt Mid -->
    <div class="bot">
        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item"><h2>Item</h2></td>
                    <td class="Hours"><h2>Qty</h2></td>
                    <td class="Rate"><h2>Unit</h2></td>
                    <td class="Rate"><h2>Discount</h2></td>
                    <td class="Rate"><h2>Sub Total</h2></td>
                </tr>
                @php
                    $totalDiscount = 0;
                    $totalAmount = 0;
                @endphp

                @if($order_receipt->isNotEmpty())
                @foreach ($order_receipt as $receipt)
    @if ($receipt->product)
        <tr class="service">
            <td class="tableitem"><p class="itemtext">{{ $receipt->product->product_name }}</p></td>
            <td class="tableitem"><p class="itemtext">{{ number_format($receipt->unitprice, 2) }}</p></td>
            <td class="tableitem"><p class="itemtext">{{ $receipt->quantity }}</p></td>
            <td class="tableitem"><p class="itemtext">{{ $receipt->discount }}%</p></td>
            <td class="tableitem"><p class="itemtext">{{ number_format($receipt->unitprice * $receipt->quantity, 2) }}</p></td>
        </tr>
        @php
            $totalDiscount += $receipt->discount;
            $totalAmount += $receipt->amount;
        @endphp
    @endif
@endforeach
                @else
                    <tr class="service">
                        <td colspan="5">No items found</td>
                    </tr>
                @endif

                <tr class="tabletitle">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="Rate"><p class="itemtext">Total Disc</p></td>
                    <td class="Payment"><p class="itemtext">Rp. {{ number_format($totalDiscount, 2) }}</p></td>
                </tr>

                <tr class="tabletitle">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="Rate">Total</td>
                    <td class="Payment"><h2>Rp. {{ number_format($totalAmount, 2) }}</h2></td>
                </tr>
            </table>
            <div class="legalcopy">
                <p class="legal"><strong>
                    ** Thank You **
                </strong><br>
                    Semoga Bermanfaat
                </p>
            </div>
            <div class="serial-number">
                Serial : <span class="serial">
                    1234567890<br>
                </span>
                <span><?php echo date('d/m/Y'); ?> &nbsp; &nbsp; <?php echo date('H:i'); ?></span>
            </div>
        </div>
    </div>
</div>

<style>
    #invoice-POS{
        box-shadow: 0 0 1in -0.25in rgb(0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 58mm;
        background: #fff;
    }

    #invoice-POS::selection{
        background: #34495E;
        color: #fff;
    }

    #invoice-POS ::-moz-selection{
        background: #34495E;
        color: #fff;
    }

    #invoice-POS h1{
        font-size: 1.5em;
        color: #222;
    }

    #invoice-POS h2{
        font-size: 0.5em;
    }

    #invoice-POS h3{
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
    }

    #invoice-POS p{
        font-size: 0.7em;
        font-weight: 300;
        line-height: 1.2em;
        color: #666;
    }

    #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot{
        border-bottom: 1px solid #eee;
    }
    #invoice-POS #top{
        min-height: 100px;
    }
    #invoice-POS #mid{
        min-height: 80px;
    }
    #invoice-POS #bot{
        min-height: 50px;
    }
    #invoice-POS #top .logo{
        height: 60px;
        width: 60px;
        background-image: url('D:\logo.png') no-repeat;
        background-size: 60px 60px;
        border-radius: 50px;
    }
    #invoice-POS .info{
        display: block;
        margin-left: 0;
        text-align: center;
    }
    #invoice-POS .title{
        float: right;
    }
    #invoice-POS .title p{
        text-align: right;
    }
    #invoice-POS .table{
        width: 100%;
        border-collapse: collapse;
    }
    #invoice-POS .tabletitle{
        font-size: 0.75em;
        background: #eee;
    }
    #invoice-POS .service{
        border-bottom: 1px solid #eee;
    }
    #invoice-POS .item{
        width: 24mm;
    }
    #invoice-POS .itemtext{
        font-size: 0.75em;
    }
    #invoice-POS .legalcopy{
        margin-top: 5mm;
        text-align: center;
    }
    
    .serial-number{
        margin-top: 5mm;
        margin-bottom: 2mm;
        text-align: center;
        font: 10px;
    }
    .serial{
        font-size: 12x !important;
    }

</style>
