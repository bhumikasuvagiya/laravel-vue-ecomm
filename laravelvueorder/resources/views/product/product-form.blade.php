@extends('layout.app')
@section('title', 'Dev Hub - Add/Update User')
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
                                    <li class="breadcrumb-item"><a href="{{ route('users') }}">Dev Guide</a></li>
                                    <li class="breadcrumb-item active">Dev Guide List</li>
                                </ol>
                                @php
                                    if (!empty($product)) {
                                        $saveurl = route('update_product', $product->product_id);
                                    } else {
                                        $saveurl = route('save_product');
                                    }
                                @endphp
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title mb-4">Dev Guide</h5>
                                        <form class="jqvform" novalidate name="product_form" id="product_form"
                                            method="post" action="{{ $saveurl }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="product_id" id="product_id"
                                                value="{{ $product->product_id ?? '' }}">
                                            <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <select class="form-control required" name="category" id="category">
                                                    <option value="">Select</option>
                                                    @foreach ($category as $cat)
                                                        <option value="{{ $cat->category_id }}"
                                                            @if (!empty($product) && $cat->category_id == $product->category_id) selected="selected" @endif>
                                                            {{ $cat->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Subcategory</label>
                                                <select class="form-control required" name="subcategory" id="subcategory">
                                                    <option value="">Select</option>
                                                    @if (!empty($product))
                                                        @foreach ($subcategory as $subcat)
                                                            <option value="{{ $subcat->subcategory_id }}"
                                                                @if (!empty($product) && $subcat->subcategory_id == $product->subcategory_id) selected="selected" @endif>
                                                                {{ $subcat->subcategory_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control required" name="product_name"
                                                    value="{{ $product->product_name ?? '' }}" id="product_name">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Sku</label>
                                                <input type="text" class="form-control required" name="product_sku"
                                                    value="{{ $product->product_sku ?? '' }}" id="product_sku">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">amount</label>
                                                <input type="text" class="form-control required" name="amount"
                                                    value="{{ $product->amount ?? '' }}" id="amount">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control required" id="description">{{ $product->description ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control required" name="product_status"
                                                    id="product_status">
                                                    <option value="">Select</option>
                                                    <option value="0"
                                                        @if (!empty($product) && $product->status == 0) selected="selected" @endif>
                                                        Inactive</option>
                                                    <option value="1"
                                                        @if (!empty($product) && $product->status == 1) selected="selected" @endif>Active
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group increment">
                                                <label class="form-label">Attachment</label>
                                                <input type="file" name="product_image" class="form-control"
                                                    id="product_image">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-outline-dark" href="{{ route('product') }}"
                                                role="button">Cancel</a>
                                        </form>
                                    </div>
                                    <!-- end card-body-->
                                </div>
                                <!-- end card-->
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script type="text/javascript">
        $('#product_form').validate({
            rules: {

                product_name: {
                    remote: {
                        url: '{{ route('ajax_check_product_name') }}',
                        type: "POST",
                        data: {
                            product_id: function() {
                                return $('#product_id').val();
                            },
                            subcategory: function() {
                                return $('#subcategory').val();
                            },
                            category: function() {
                                return $('#category').val();
                            },
                        }

                    },
                },
                product_sku: {
                    remote: {
                        url: '{{ route('ajax_check_sku_name') }}',
                        type: "POST",
                        data: {
                            product_id: function() {
                                return $('#product_id').val();
                            },
                        }

                    },
                },
            },
            submitHandler: function(form) {
                form.submit();
                //$("#loading").hide();
            }
        });


        $(document).ready(function() {
            $('#user_type_id').on('change', function() {
                var user_type_id = $('#user_type_id').val();
                if (user_type_id == '3') //staff
                {
                    $('#team_leader_block').show();
                } else {
                    $('#team_leader_block').hide();
                }
            });

            $("#password_chk").click(function() {
                if ($(this).is(":checked")) {
                    $("#user_password_div").show();
                } else {
                    $("#user_password_div").hide();
                }
            });

            $('#category').change(function() {
                var category_id = $(this).val();

                // AJAX request
                $.ajax({
                    url: '{{ route('ajax_subcategory') }}',
                    method: 'post',
                    data: {
                        category_id: category_id
                    },
                    dataType: 'json',
                    success: function(response) {

                        $('#subcategory').find('option').not(':first').remove();

                        // Add options
                        $.each(response, function(index, data) {
                            $('#subcategory').append('<option value="' + data[
                                'subcategory_id'] + '">' + data[
                                'subcategory_name'] + '</option>');
                        });
                    }
                });
            });
        });
    </script>


@endsection
