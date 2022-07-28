@extends('layout.app')
@section('title', 'Dev Hub - Category List')
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                                    <li class="breadcrumb-item active">Category List</li>
                                </ol>
                                <div class="card">
                                    <div class="toast-header mt-2 mb-2">
                                        <h5 class="header-title">Category</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="alert alert-success alert-dismissible success_msg"
                                            id="success_msg" style="display:none;" role="alert">
                                            <div class="alert-message" id="success_msg_action">
                                            </div>
                                        </div>
                                        <div class="alert alert-danger alert-dismissible" id="error_msg_area"
                                            style="display:none;" role="alert">
                                            <div class="alert-message" id="error_msg_action">
                                            </div>
                                        </div>
                                        @if ($message = Session('success'))
                                            <div class="alert alert-success alert-block success_msg_area">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif
                                        @if ($message = Session('error'))
                                            <div class="alert alert-danger alert-block error_msg_area">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @endif
                                        <form id="category_list_form" class="kg-table-card" method="post"
                                            action="{{ route('del_category') }}" onSubmit="return giveNotation();">
                                            @csrf
                                            <div class="mb-3">
                                                <a href="{{ route('new-category') }}" class="btn btn-success">Add</a>

                                                <a href="javascript:void(0);"
                                                    onclick="javascript:$('#del_btn').trigger('click');"
                                                    class="btn btn-danger">Delete</a>
                                                <input type="submit" name="submit" id="del_btn" value="Delete"
                                                    style="display:none;">
                                            </div>
                                            <table id="tbl_user_list"
                                                class="table table-striped table-bordered dataTable no-footer dtr-inline w-100">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="">
                                                                <input type="checkbox" id="del_chk"
                                                                    class="" />
                                                            </div>
                                                        </th>
                                                        <th>Id</th>
                                                        <th>Category</th>
                                                        {{-- <th>Image</th> --}}
                                                        <th>Status</th>
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

@endsection
@section('custom_script')
    <script>
        $(document).ready(function(e) {
            master = $('#tbl_user_list').DataTable({
                responsive: true,
                bServerSide: true,
                processing: true,
                autoWidth: true,
                pageLength: 10,
                sAjaxSource: "{{ route('ajax_get_category_list') }}",
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
                            var id = o['category_id'];
                            var act_html = '-';

                            act_html =
                                '<div class="flat-grey single-row">	<input type="checkbox" name="categories[]" class="all_del" value="' +
                                id + '">	</div>'

                            return act_html;
                        }
                    },
                    {
                        mData: "category_id",
                        bSortable: false
                    },
                    {
                        mData: "category_name",
                        bSortable: false
                    },
                    // {
                    //     mData: "category_image",
                    //     bSortable: false,
                    //     mRender: function(v, t, o) {
                            
                    //         var category_image = "<img src='"+ o['category_image'] +"' height='100' width='100'/>";
                            
                    //         return category_image;
                    //     }
                    // },
                    {
                        mData: null,
                        bSortable: false,
                        mRender: function(v, t, o) {
                            ;
                            if (o['status'] == 0) {
                                var status = "Inactive";
                            } else {
                                var status = "Active";
                            }
                            return status;
                        }
                    },
                    {
                        mData: null,
                        bSortable: false,
                        mRender: function(v, t, o) {
                            var id = o['category_id'];
                            var act_html = '-';
                            // console.log(id);
                            var edit_path = "{{ route('update_category', ':id') }}";
                            edit_path = edit_path.replace(':id', id);
                            view_btn = '<a onclick="get_order_line_items(' + id +
                                ');" href="javascript:void(0)" class="btn btn-primary text-light"><i class="fa fa-eye" aria-hidden="true"></i> View</a> ';
                            delete_btn =
                                '<a href="javascript:void(0);" class="btn btn-danger width-sm waves-effect waves-light" title="Delete" onClick="return del_category(' +
                                id + ')"><i class="fas fa-trash-alt"></i> Delete </a>';
                            act_html =
                                '<a class="btn btn-success width-sm waves-effect waves-light" href="' +
                                edit_path +
                                '" title="Edit" data-placement="top"><i class="fas fa-pencil-alt" ></i> Edit </a>' +
                                '&nbsp;' + delete_btn;

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
        /*===========================================================
    							Delete Users Type
    	============================================================*/
        function del_category(category_id) {
            if (confirm("Are You Sure?")) {
                $.ajax({
                    url: "del_single_category/" + category_id,
                    success: function(msg) {
                        master.row($('#row_').category_id).remove().draw(false);

                        $('#success_msg_action').html('Category Delete successfully.');
                        $('.success_msg').css('display', 'block');
                        setTimeout(function() {
                            $('.success_msg').slideUp('slow');
                        }, 3000);
                    }
                });
            }
        }
        setTimeout(function() {
            $('.success_msg_area').slideUp('slow');
        }, 3000);
    </script>

@endsection
