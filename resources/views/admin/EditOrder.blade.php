@extends('backend.layouts.app')
@section('content')
    <style>
        .disabled {
            pointer-events: none;
        }

        .btn-danger {
            display: none;
            /* Ensure it's hidden by default */
        }

        .dev-hide {
            display: none !important;
        }
    </style>
    <div class="content-wrapper page_content_section_hp">
        <div class="container-xxl">
            <div class="client_list_area_hp Add_order_page_section">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="client_list_heading_area">
                                    <h4>
                                        {{-- @if (isset($order))
                                            Edit
                                        @else
                                            Add
                                        @endif Order --}}
                                        Add Order
                                    </h4>
                                </div>
                            </div>

                        </div>
                        {{-- @if (isset($order))
                            <form action="{{ route('order.update', $order->order_id) }}" method="POST"
                                enctype="multipart/form-data" id="orderForm">
                                @method('PUT')
                            @else --}}
                                <form action="{{ route('add.order') }}" method="POST" id="addOrderFormValidation"
                                    enctype="multipart/form-data">
                        {{-- @endif --}}
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-2">
                                <!-- Form Inputs for Client and Order Details -->
                                <div class="row">
                                    <!-- Client Number -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="client_num" class="form-label">Client Number</label>
                                            <input type="text" value="{{ old('mobile', $order->mobile ?? '') }}"
                                                id="number" name="client_num" class="form-control"
                                                placeholder="Client Number">
                                        </div>
                                    </div>
                                    <!-- Client Name -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="client_name" class="form-label">Client Name</label>
                                            <input type="text" id="client_name"
                                                value="{{ old('name', $order->name ?? '') }}" name="client_name"
                                                class="form-control" placeholder="Client Name">
                                        </div>
                                    </div>
                                    <!-- Booking Date -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="booking_date" class="form-label">Booking Date</label>
                                            <input type="date" id="booking_date"
                                                value="{{ old('order_date', $order->order_date ?? '') }}"
                                                name="booking_date" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Booking Time -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="booking_time" class="form-label">Booking Time</label>
                                            <input type="time" id="booking_time"
                                                value="{{ old('order_time', $order->order_time ?? '') }}"
                                                name="booking_time" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Delivery Date -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="delivery_date" class="form-label">Delivery Date</label>
                                            <input type="date" id="delivery_date"
                                                value="{{ old('delivery_date', $order->delivery_date ?? '') }}"
                                                name="delivery_date" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Delivery Time -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="delivery_time" class="form-label">Delivery Time</label>
                                            <input type="time" id="delivery_time"
                                                value="{{ old('delivery_time', $order->delivery_time ?? '') }}"
                                                name="delivery_time" class="form-control">
                                        </div>
                                    </div>
                                    <!-- Discount Offer -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="discount" class="form-label">Discount Offer</label>
                                            <select name="discount" id="discount" class="form-select">
                                                <option value="0" selected>Select Discount Offer</option>
                                                @foreach ($discounts as $discount)
                                                    <option value="{{ $discount->amount }}">{{ $discount->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr />
                                    <!-- Gross Total Section -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-3">
                                        <div class="row justify-content-between">
                                            <input type="hidden" name="gross_total" id="gross_total" />
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                                <h6>Gross Total:</h6>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-end">
                                                <h6 id="grossTotal">0.0</h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                                <h6>Discount Amount:</h6>
                                            </div>
                                            <div id="discountAmount" class="col-xl-4 col-lg-4 col-md-4 col-12 text-end">
                                                <h6>0.0</h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                                <h6>Express Amount:</h6>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-end">
                                                <div class="form-check form-switch float-end">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="express_charge" value="0"
                                                        onchange="toggleCheckbox()">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <input type="hidden" name="total_qty" id="total_qty" />
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                                <h6>Total Count:</h6>
                                            </div>
                                            <div id="totalQty" class="col-xl-4 col-lg-4 col-md-4 col-12 text-end">
                                                <h6>0 pc</h6>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                                <h6>Total Amount:</h6>
                                            </div>
                                            <div id="totalAmount" class="col-xl-4 col-lg-4 col-md-4 col-12 text-end">
                                                <h6>0</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="Add_order_btn_area text-end">
                                            <button class="btn w-100" type="button" data-bs-toggle="modal"
                                                data-bs-target="#CreateOrder">Save</button>
                                        </div>
                                    </div>
                                    <!-- Create Order Model -->
                                    <div class="modal fade" id="CreateOrder" tabindex="-1"
                                        aria-labelledby="CreateOrderLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="CreateOrderLabel">Create Order</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h5>Would you like to Create a New Order?</h5>
                                                    <button type="submit" class="btn btn-primary" id="yesButton"
                                                        data-bs-toggle="modal" data-bs-target="#yes">Yes</button>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end -->

                                    <!-- Print Order Model -->
                                    {{-- <div class="modal fade" id="yes" tabindex="-1" aria-labelledby="yesLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h5>Please Select from the Following Options</h5>
                                                        <a type="button" class="btn btn-success" id="sendWhatsAppMessage" href="{{ url('/send-wh-message') }}">
                                                            <i class="fab fa-whatsapp me-2"></i> Send On WhatsApp
                                                        </a>
                                                        <a type="button" class="btn btn-primary" href="{{ url('/admin/receipt/'. Session::get('orderId') ) }}">
                                                            <i class="fa-solid fa-file-invoice me-2"></i> Print Receipt
                                                        </a>

                                                        <button type="button" class="btn btn-success"><i class="fa-solid fa-tag me-2"></i> Print Tag</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    <!-- end -->
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-2">
                                <!-- Product Items Section -->
                                <div class="client_list_area_hp">
                                    <div class="client_list_heading_area w-100">
                                        <div class="client_list_heading_search_area w-100">
                                            <i class="menu-icon tf-icons ti ti-search"></i>
                                            <input type="search" class="form-control" placeholder="Searching ...">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div id="productItemError" class="alert alert-danger" style="display: none;">
                                        Please add at least one product item.
                                    </div>
                                    @foreach ($groupedProductItems as $groupedProductItem)
                                        @php
                                            // dd($groupedProductItems);
                                            $productItem = $groupedProductItem['product_item'];
                                            $uniqueCategories = $groupedProductItem['unique_categories'];
                                        @endphp

                                        <div class="border rounded p-2 mb-2">
                                            <div class="row">
                                                <div class="col-lg-9 col-md-9 mainopdiv">
                                                    <h6 class="mb-2 text-dark">{{ $productItem->name }}</h6>
                                                    <div class="categorysection">
                                                            <span onclick="categoryItem('', this)" class="badge text-dark mb-2 subcategory bg-light">test</span>

                                                    </div>
                                                    <div class="oprationData disabled">
                                                        test
                                                    </div>

                                                </div>
                                                <div class="col-lg-3 col-md-3 text-center">
                                                    <img class="mb-2"
                                                        src="{{ url('images/categories_img/' . $productItem->image) }}"
                                                        alt="{{ $productItem->name }}" style="width: 50px;">
                                                    <div class="Add_order_btn_area">
                                                        <button type="button" id="addbtnpreview"
                                                            class="btn add-product-btn" data-bs-toggle="offcanvas"
                                                            data-bs-target="#offcanvasRight"
                                                            aria-controls="offcanvasRight"
                                                            data-product-name="{{ $productItem->name }}"
                                                            data-images="{{ url('images/categories_img/' . $productItem->image) }}">Add</button>
                                                        <button class="btn btn-danger dev-hide"
                                                            id="productId{{ $productItem->id }}" type="button"
                                                            onclick="removeProductItem('{{ $productItem->id }}')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                                        aria-labelledby="offcanvasRightLabel">
                                        <div class="offcanvas-header">
                                            <h5 id="offcanvasRightLabel">Curtain Panel</h5>
                                            <button id="addOrderModel" type="button" class="btn-close text-reset"
                                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body mainopdiv">
                                            <div class="border-bottom mb-3">
                                                <h6 class="mb-2 text-dark" id="categoryPreviewItemName">Chudidar/Payjama
                                                </h6>
                                            </div>
                                            <div class="border-bottom mb-3">
                                                <div>
                                                    <span id="categoryPreviewCategName"></span>
                                                </div>
                                            </div>
                                            <div class="border-bottom mb-3">
                                                <div>
                                                    <span id="categoryPreviewServiceName"
                                                        class="mb-2 oprationData"></span>
                                                </div>
                                            </div>

                                            <div class="offcanvas-footer px-4 pb-2">

                                                <div class="input-group mb-3">
                                                    <button type="button" class="input-group-text decrease"><i
                                                            class="fa-solid fa-minus"></i></button>
                                                    <input type="text" class="form-control text-center piece-count"
                                                        value="0" id="qtyPlsMns" name="qty" placeholder="Pc"
                                                        aria-label="Amount (to the nearest dollar)">
                                                    <button type="button" class="input-group-text increase"><i
                                                            class="fa-solid fa-plus"></i></button>
                                                </div>
                                                <div class="Add_order_btn_area">
                                                    <button type="button" id="addRightOdrbtn"
                                                        class="btn w-100">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Create Order Modal -->
                        <div class="modal fade" id="CreateOrder" tabindex="-1" aria-labelledby="CreateOrderLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="CreateOrderLabel">Create Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h5>Would you like to create a new order?</h5>
                                        <button type="submit" class="btn btn-primary" id="yesButton"
                                            data-bs-toggle="modal" data-bs-target="#yes">Yes</button>
                                        <button type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Print Order Modal -->
                        {{-- <div class="modal fade" id="yes" tabindex="-1" aria-labelledby="yesLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h5>Please select from the following options:</h5>
                                            <a class="btn btn-primary" href="{{ url('/admin/receipt' . $order->id) }}">
                                                <i class="fa-solid fa-file-invoice me-2"></i> Print Receipt
                                            </a>
                                            <button type="button" class="btn btn-success">
                                                <i class="fa-solid fa-tag me-2"></i> Print Tag
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
