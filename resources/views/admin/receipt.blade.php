@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper page_content_section_hp">
    <div class="container-xxl">
        <div class="client_list_area_hp Add_order_page_section">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between mb-3 align-items-center">
                        <div class="col-3 mb-2">
                            <a type="button" class="text-primary d-flex align-items-center" id="backButton">
                                <i class="fa-solid fa-arrow-left me-2"></i> Back
                            </a>
                        </div> 
                        <div class="col-lg-3 mb-2 text-end">
                            {{-- <a type="button" class="btn btn-success" id="sendWhatsAppMessage" href="{{ url('/send-wh-message/' . $order->id) }}">
                                <i class="fab fa-whatsapp me-2"></i>
                            </a> --}}
                            <a class="btn btn-primary"  href="{{ url('/admin/download-receipt/' . $order->id) }}" type="button"><i class="fa-solid fa-download"></i></a>
                                               <a class="btn btn-primary" href="{{ url('/admin/receipt-print/' . $order->id) }}"
                                type="button"><i class="fa-solid fa-print me-2"></i></a> 
                        </div> 
                    </div>

                    <img src="{{ url('theam/Images/logo.png') }}" class="mt-0 mb-3" style="width: 200px;">
                     @include('admin.pdf');
                     <input type="hidden" id="referrerUrl" value="">
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            var referrerUrl = document.getElementById('referrerUrl').value;
            if (referrerUrl.includes('/admin/view-order')) {
                window.location.href = referrerUrl;
            } else {
                window.location.href = "{{ url('/admin/invoice') }}";
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var referrer = document.referrer;
            document.getElementById('referrerUrl').value = referrer;
        });
    </script>
    @endsection
    <!-- <style>
        ul {
            counter-reset: list-counter;
            list-style-type: none;
        }

        li::before {
            content: counter(list-counter);
            counter-increment: list-counter;
            margin-right: 0.5em;
        }
    </style> -->