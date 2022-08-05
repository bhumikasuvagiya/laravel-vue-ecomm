@extends('layout.app')
@section('title', 'KgKrunch - Add/Update Category')
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
                                    <li class="breadcrumb-item"><a href="{{ route('subcategories') }}">Subcategory</a></li>
                                    <li class="breadcrumb-item active">Subcategory List</li>
                                </ol>
                                @php
                                    if (!empty($subcategory)) {
                                        $saveurl = route('update_subcategory', $subcategory->subcategory_id);
                                    } else {
                                        $saveurl = route('save_subcategory');
                                    }
                                @endphp
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title mb-4">Subcategory</h5>
                                        <form class="jqvform" novalidate name="subcategory_form" id="subcategory_form"
                                            method="post" action="{{ $saveurl }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="subcategory_id"
                                                    value="{{ $subcategory->subcategory_id ?? '' }}"
                                                    id="subcategory_id">
                                            <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <select class="form-control required" name="category" id="category">
                                                    <option value="">Select</option>

                                                    @foreach ($category as $cat)
                                                        <option value="{{ $cat->category_id }}"
                                                            @if (!empty($subcategory) && $cat->category_id == $subcategory->category_id) selected="selected" @endif>
                                                            {{ $cat->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label class="form-label">Subcategory</label>
                                                <input type="text" class="form-control required" name="subcategory_name"
                                                    value="{{ $subcategory->subcategory_name ?? '' }}"
                                                    id="subcategory_name">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Image</label>
                                                <input type="file" class="form-control" name="subcategory_image" id="subcategory_image">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control required" name="subcategory_status"
                                                    id="subcategory_status">
                                                    <option value="">Select</option>
                                                    <option value="0"
                                                        @if (!empty($subcategory) && $subcategory->status == 0) selected="selected" @endif>
                                                        Inactive</option>
                                                    <option value="1"
                                                        @if (!empty($subcategory) && $subcategory->status == 1) selected="selected" @endif>Active
                                                    </option>
                                                </select>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Submit</button>

                                            <a class="btn btn-outline-dark" href="{{ route('subcategories') }}"
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
        $('#subcategory_form').validate({
            rules: {

                subcategory_name: {
                    remote: {
                        url: '{{ route('ajax_check_subcategory_by_category') }}',
                        type: "POST",
                        data: {
                            subcategory_id: function() {
                                return $('#subcategory_id').val();
                            },
                            category_id: function() {
                                return $('#category').val();
                            },
                        },

                    },
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
