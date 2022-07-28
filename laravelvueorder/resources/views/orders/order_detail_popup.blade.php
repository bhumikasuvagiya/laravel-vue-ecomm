
    <div class="modal-dialog order-detail-popup">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {{-- <p>{{ $order_data}}</p> --}}
                <div class="row">
                    <div class="col-lg-6"> <p class="order_item_title">Item</p></div>
                    <div class="col-lg-3"><p class="order_item_qty_title">Quantity</p></div>
                    <div class="col-lg-3"><p class="order_item_price_title">Price</p></div>
                </div>
                @foreach($order_data as $order_item)
                        {{-- <p>{{ $order_item}}</p> --}}
                        <div class="row">
                            <div class="col-lg-6"> <p class="order_item_text">{{ $order_item->product_name}}</p></div>
                            <div class="col-lg-3"><p class="order_item_qty">{{ $order_item->product_quantity}}</p></div>
                            <div class="col-lg-3"><p class="order_item_price">${{ $order_item->amount}}</p></div>
                        </div>
                @endforeach
                <hr>
                <div class="row">
                    {{-- <div class="col-lg-8 order_total_title">
                            <p class="">Total:</p>
                    </div> --}}
                    <div class="col-lg-12 order_total">
                            <p class="total_title">Total:</p>
                            <p class="">${{$order_details->order_total}}</p>
                    </div>
                </div>
               
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-dark" href="javascript:void(0);"
                class="close" data-dismiss="modal" aria-hidden="true"   role="button">Close</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
