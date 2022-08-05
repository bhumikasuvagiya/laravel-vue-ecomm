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
                                    <li class="breadcrumb-item"><a href="{{ route('categories') }}">Category</a></li>
                                    <li class="breadcrumb-item active">Category List</li>
                                </ol>
                                @php
                                    if (!empty($category)) {
                                        $saveurl = route('update_category', $category->category_id);
                                    } else {
                                        $saveurl = route('save_category');
                                    }
                                @endphp
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title mb-4">Category</h5>
                                        <form class="jqvform" novalidate name="category_form" id="category_form"
                                            method="post" action="{{ $saveurl }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="category_id"
                                                    value="{{ $category->category_id ?? '' }}" id="category_id">
                                            <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <input type="text" class="form-control required" name="category_name"
                                                    value="{{ $category->category_name ?? '' }}" id="category_name">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control required" name="category_status"
                                                    id="category_status">
                                                    <option value="">Select</option>
                                                    <option value="0"
                                                        @if (!empty($category) && $category->status == 0) selected="selected" @endif>
                                                        Inactive</option>
                                                    <option value="1"
                                                        @if (!empty($category) && $category->status == 1) selected="selected" @endif>Active
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Image</label>
                                                <input type="file" class="form-control" name="category_image" id="category_image">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit</button>

                                            <a class="btn btn-outline-dark" href="{{ route('categories') }}"
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
        $('#category_form').validate({
            rules: {

                category_name: {
                    remote: {
                        url: '{{ route('ajax_check_category') }}',
                        type: "POST",
                        data: {
                            category_id: function() {
                                return $('#category_id').val();
                            }
                        }

                    },
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
