<div class="row justify-content-between mb-3"
    style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
    {{-- <!-- <img src="{{ url('theam/Images/logo.png') }}"  class="mt-0 mb-3" style="width: 200px;">      --> --}}
    {{-- <img src="https://fastly.picsum.photos/id/142/200/200.jpg?hmac=L8yY8tFPavTj32ZpuPiqsLsfWgDvW1jvoJ0ETDOUMGg"
        class="mt-0 mb-3" style="width: 200px;"> --}}
    <img src="{{ public_path() . '\theam\Images\logo.png' }}" class="mt-0 mb-3 d-none" style="width: 200px;">
    {{-- <img src="/theam/Images/logo.png" class="mt-0 mb-3" style="width: 200px;"> --}}
    <h6 class="mb-0" style="color: #5d596c; font-weight: 600; margin-bottom:0; font-size:18px;margin-top:0;">RECEIPT
    </h6>
    <p class="mb-0" style="color: #5d596c;margin-bottom:0;font-size:16px; margin-top:0;">Mega Solutions</p>
    <p class="mb-0" style="color: #5d596c;margin-bottom:0; font-size:16px;margin-top:0;"> 373, Block B, C Road, Jodhpur, Jodhpur,
        Rajasthan, 342003
    </p>
    <p class="mb-0" style="color: #5d596c;margin-bottom:0; font-size:16px;margin-top:0;">GST: 08BQFPA2674G2ZZ</p>
    <hr style="margin-bottom:10px;margin-top:10px;"/>
    <h6 class="mb-0" style="color: #5d596c;margin-bottom:0; font-size:18px;margin-top:0;">Order Id: {{ $order->order_number }}</h6>
    <p class="mb-0" style="color: #5d596c;margin-bottom:0;font-size:16px; margin-top:0;">Date & Time: {{ $order->order_date }}
        {{ $order->order_time }}
    </p>
    <hr style="margin-bottom:10px;margin-top:10px;"/>
    <p class="mb-0" style="color: #5d596c;margin-bottom:0;font-size:16px; margin-top:0;">Bill To:</p>
    <p  style="color: #5d596c; font-weight: 600; font-size:16px;margin-bottom:0;margin-top:0;">{{ $order->user->name }}</p>
    <p  style="color: #5d596c; font-weight: 600; font-size:16px;margin-bottom:0;margin-top:0;">Mo: {{ $order->user->mobile }}</p>
    <hr style="margin-bottom:10px;margin-top:10px;"/>
    <div style="clear: both;"></div>
    <div class="table-responsive">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border-bottom:0.5px solid #5d596c !important ; text-align: left; padding-bottom:10px; padding-top:10px">
                        Code</th>
                    <th style="border-bottom:0.5px solid #5d596c !important ; text-align: left; padding-bottom:10px; padding-top:10px">Pc
                    </th>
                    {{-- <th style="min-width: auto;">Qnt.</th> --}}
                    <th style="border-bottom:0.5px solid #5d596c !important ; text-align: left; padding-bottom:10px; padding-top:10px">
                        Description</th>
                    <th style="border-bottom:0.5px solid #5d596c !important ; text-align: left; padding-bottom:10px; padding-top:10px">
                        Rate</th>
                    {{-- <th style="min-width: auto;">Discount</th> --}}
                    <th style="border-bottom:0.5px solid #5d596c !important ; text-align: left; padding-bottom:10px; padding-top:10px">
                        Price</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td style=" border-bottom:0.5px solid #5d596c; text-align: left; padding-bottom:10px; padding-top:10px">
                            {{ $loop->iteration }}N
                        </td>
                        <td style=" border-bottom:0.5px solid #5d596c; text-align: left; padding-bottom:10px; padding-top:10px">
                            {{ $item->quantity }}
                        </td>
                        {{-- <td style="min-width: auto;">{{ $item->quantity }}</td> --}}
                        <td style=" border-bottom:0.5px solid #5d596c; text-align: left; padding-bottom:10px; padding-top:10px">
                            {{ $item->productItem->name }}
                            [{{ $item->productCategory->name }}]
                        </td>
                        <td style=" border-bottom:0.5px solid #5d596c; text-align: left; padding-bottom:10px; padding-top:10px">
                            {{ $item->operation_price }}
                        </td>
                        {{-- <td style=""></td> --}}
                        <td style=" border-bottom:0.5px solid #5d596c; text-align: left; padding-bottom:10px; padding-top:10px">
                            {{ $item->quantity * $item->operation_price }}
                        </td>
                    </tr>
                @endforeach
                        </tbody>
        </table>

    </div>

</div>
<div>
    <div style="width:70%;float:left;"></div>
    <table style="width: 30%;float:right;">
        <tr style="margin:0;padding: 0;">
            <td style="margin:0;padding: 0;margin-bottom: 0px; margin-top: 10px; padding:0; padding-bottom: 10px; border-bottom:0.5px solid #5d596c;">
                <h6 style="margin:0;padding: 0;color: #5d596c; font-weight: 600; margin-bottom: 10px; margin-top:10px; font-size: 14px;  ">
                    Total Pcs</h6>
            </td>
            <td style="margin:0;padding: 0;margin-bottom: 0px; margin-top: 10px; padding:0; padding-bottom: 10px; border-bottom:0.5px solid #5d596c;">
                <h6 style="margin:0;padding: 0;color: #5d596c; font-weight: 600; margin-bottom: 10px; margin-top:10px; font-size: 14px; ">
                    {{ $order->orderItems->sum('quantity') }}
                </h6>
            </td>
        </tr>


       <tr style="margin:0;padding: 0;">
            <td style="margin:0;padding: 0;margin-bottom: 0px; margin-top: 10px; padding:0; padding-bottom: 10px; border-bottom:0.5px solid #5d596c;">
                <h6 style="margin:0;padding: 0;color: #5d596c; font-weight: 600; margin-bottom: 10px; margin-top:10px; font-size: 14px;  ">
                    Total Discount
                    ({{$discountPercentage}} %)</h6>
            </td>
            <td style="margin:0;padding: 0;margin-bottom: 0px; margin-top: 10px; padding:0; padding-bottom: 10px; border-bottom:0.5px solid #5d596c;">
                <h6 style="margin:0;padding: 0;color: #5d596c; font-weight: 600; margin-bottom: 10px; margin-top:10px; font-size: 14px; ">
                    {{ $discountAmount }}
                </h6>
            </td>
        </tr>
       <tr style="margin:0;padding: 0;">
            <td style="margin:0;padding: 0;margin-bottom: 0px; margin-top: 10px; padding:0; padding-bottom: 10px; border-bottom:0.5px solid #5d596c;">
                <h6 style="margin:0;padding: 0;color: #5d596c; font-weight: 600; margin-bottom: 10px; margin-top:10px; font-size: 14px;  ">
                    Total Price
                </h6>
            </td>
            <td style="margin:0;padding: 0;margin-bottom: 0px; margin-top: 10px; padding:0; padding-bottom: 10px; border-bottom:0.5px solid #5d596c;">
                <h6 style="margin:0;padding: 0;color: #5d596c; font-weight: 600; margin-bottom: 10px; margin-top:10px; font-size: 14px; ">
                    INR
                    {{ $totalAmount }}
                </h6>
            </td>
        </tr>


    </table>
</div>

<div style="clear: both;"></div>
<div style="width:100%; ">
    <hr style="margin-bottom:10px;margin-top:10px;"/>
    <h6 style="color: #5d596c; font-weight: 600; font-size:18px;margin-bottom:0;">Terms and Conditions </h6>
    <ul>
        <li style="color: #5d596c;">The customer should always show this invoice or the invoice number at the time of delivery .
        </li>
        <li style="color: #5d596c;">The customer should report any discrepancy if found to the store manager within 24 hrs after delivery is made.</li>
        <li style="color: #5d596c;">The customer should show the invoice number received on mobile when reporting the discrepancy to the store manager.
        </li>
        <li style="color: #5d596c;">The company will not entertain any discrepancy of any article after 24 hrs of delivery made .</li>
        <li style="color: #5d596c;"> The company is not responsible for any expensive things( ornaments , jewellery, currency ) is lost when giving cloth to store for processing .
        </li>
        <li style="color: #5d596c;">The company will not be responsible for any cloth color damage / cloth shrinkage . It’s the basic nature of fabric for shrinkage and of color fade.
        </li>
        <li style="color: #5d596c;">Our manpower is doing the work by outmost attention , but afterall it’s a human who is doing work ,therefor company will will not take the responsibility of any damage cause to the garment .
        </li>
        <li style="color: #5d596c;">Some article need special care ,the company held no responsibility to pay special attention to particular garments.
        </li>
        <li style="color: #5d596c;"> The company will not be responsible for the cloth which are leftover for more then 10 days at store.
        </li>
        <li style="color: #5d596c;"> The company holds the right to deny any operations to any clothes which the store manager thinks will got damage in process.
        </li>
        <li style="color: #5d596c;">The customer are requested to count the article at delivery time . The company will not be responsible after the delivery is accepted by the customer.
        </li>
        <li style="color: #5d596c;">The company does not give the guarantee for removing the spots/stains from the garment . Therefore no deductions will be there from the invoice.
        </li>
        <li style="color: #5d596c;">If any dispute occur . The dispute jurisdiction place will be Jodhpur .
        </li>
        <li style="color: #5d596c;"> In case of any force process requested by the customer , the company will not be responsible for any damage of the cloth .
        </li>
    </ul>
</div>
</div>
