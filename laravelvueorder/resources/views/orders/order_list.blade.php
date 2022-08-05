@extends('layout.app')
@section('title','KgKrunch - User List') 
@section('content') 
<div class="wrapper">
    <div class="main">
        <div class="content-page">
        <main class="content">
            
            <div class="container-fluid p-0">
                <div class="row mt-4">
                    <div class="col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                            <li class="breadcrumb-item active">Order List</li>
                        </ol>
                        <div class="card">
                            <div class="toast-header mt-2 mb-2">
                                <h5 class="header-title">Orders</h5>
                            </div>
                            <div class="card-body">
                            <form id="user_list_form" class="kg-table-card" method="post" action="{{ route('del_product')}}" onSubmit="return giveNotation();">
                                @csrf
                                <div class="mb-3">
                                    <a href="javascript:void(0);" onclick="javascript:$('#del_btn').trigger('click');" class="btn btn-danger">Delete</a>
                                    <input type="submit" name="submit" id="del_btn" value="Delete" style="display:none;">
                                </div>
                                <table id="tbl_order_list" class="table table-striped table-bordered dataTable no-footer dtr-inline w-100">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="">
                                                    <input type="checkbox" id="del_chk" class="" />
                                                </div>
                                            </th>
                                            <th>Id</th>
                                            <th>Date/Time</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Customer Phone</th>
                                            <th>Deliver to</th>
                                            <th>Payment Method</th>
                                            <th>Customer Note</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
    </div>
</div>
<div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
															
@endsection
@section('custom_script') 
<script>
	$(document).ready(function(e) {
        master = $('#tbl_order_list').DataTable({
            responsive: true,
            bServerSide: true,
            processing: true,
            autoWidth: true,
            pageLength: 10,
            sAjaxSource: "{{ route('ajax_get_order_list') }}",
            language: {
                search: "",
                searchPlaceholder: "Search",
                sLengthMenu: "_MENU_items"
            },
            aaSorting: [
                [0, "desc"]
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                ['10', '25', '50', '100']
            ],
            aoColumns: [{
                    mData: null,
                    bSortable: false,
                    mRender: function(v, t, o) {
                        var id = o['order_id'];
                        var act_html = '-';

                        act_html = '<div class="flat-grey single-row">	<input type="checkbox" name="product_data[]" class="all_del" value="' + id +'">	</div>'

                        return act_html;
                    }
				},
                {
                    mData: "order_id",
                    bSortable: false
                },
                {
                    mData: "creation_datetime",
                    bSortable: false
                },
                {
                    mData: "customer_name",
                    bSortable: false
                },
                {
                    mData: "customer_email",
                    bSortable: false
                },
                {
                    mData: "customer_phone_number",
                    bSortable: false
                },
                {
                    mData: "shipping_address",
                    bSortable: false
                },
                {
                    mData: "payment_method_type",
                    bSortable: false
                },
                {
                    mData: "order_note",
                    bSortable: false
                },
                {
                    mData: "order_total",
                    bSortable: false
                },
                // {
                //     mData: null,
                //     bSortable: false,
                //     mRender: function(v, t, o) {;
                //         if(o['status'] == 0)
                //         {
                //             var status = "Inactive";
                //         }else {
                //             var status = "Active";
                //         }
                //         return status;
                //     }  
                // },
                {
                    mData: null,
                    bSortable: false,
                    mRender: function(v, t, o) {
                        var id = o['order_id'];
                        var act_html = '-';
                        // console.log(id);
                        var edit_path = "{{ route('update_product', ':id') }}";
                        edit_path = edit_path.replace(':id', id);
                        view_btn = '<a  href="javascript:void(0)" class="btn btn-primary text-light" onclick="order_details_form_popup('+ id +')"><i class="fa fa-eye" aria-hidden="true"></i> View</a> ';
                        delete_btn = '<a href="javascript:void(0);" class="btn btn-danger width-sm waves-effect waves-light" title="Delete" onClick="return del_product('+ id +')"><i class="fas fa-trash-alt"></i> Delete </a>';
                        act_html =  '&nbsp;' + view_btn;

                        return act_html;
                    }                    
                },
            ],
            fnPreDrawCallback: function() {},
            fnDrawCallback: function(oSettings) {}
        });
	});
</script>
<script type="text/javascript">
	function del_product(order_id) {        
		if (confirm("Are You Sure?")) {
			$.ajax({
				url: "del_single_product/" + order_id,
				success: function(msg) {
					master.row($('#row_').order_id).remove().draw(false);
					
					$('#success_msg_action').html('Dev Guide Delete successfully.');
					$('.success_msg').css('display','block');
                    setTimeout(function(){
                        $('.success_msg').slideUp('slow');
                    }, 3000);                        
				}
			});
		}
	}
    setTimeout(function(){
        $('.success_msg_area').slideUp('slow');
    }, 3000);   
    
    function order_details_form_popup(order_id) {
        $.ajax({
            url: "order_details_form_popup/" + order_id,
            success: function(msg) {
                // console.log(msg.order_view);

                $('#standard-modal').html(msg.order_view);
                // $('#save_complaint_popup').modal('show');
                $('#standard-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });

        //$("#sizedModalLg").model('show');
    }
	
</script>

@endsection