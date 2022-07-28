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
                                    <li class="breadcrumb-item"><a href="{{ route('users') }}">User</a></li>
                                    <li class="breadcrumb-item active">User List</li>
                                </ol>
                                @php
                                    if (!empty($user)) {
                                        $saveurl = route('update_user', $user->id);
                                    } else {
                                        $saveurl = route('save_user');
                                    }
                                @endphp
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title mb-4">User</h5>
                                        <form class="jqvform" novalidate name="user_form" id="user_form"
                                            method="post" action="{{ $saveurl }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id ?? '' }}">
                                            <div class="form-group">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control required" name="firstname"
                                                    value="{{ $user->first_name ?? '' }}" id="firstname">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control required" name="lastname"
                                                    value="{{ $user->last_name ?? '' }}" id="lastname">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control required" name="email"
                                                    value="{{ $user->email ?? '' }}" id="email">
                                            </div>
                                            @if (!empty($user))
                                                @if ($user->id)
                                                    <div class="form-group mb-1">
                                                        <label class="custom-checkbox">
                                                            <input type="checkbox" id="password_chk" name="password_chk"
                                                                class="" value="1">
                                                            Change Password
                                                        </label>
                                                    </div>
                                                @endif
                                            @endif
                                            <div id="user_password_div"
                                                @if (!empty($user)) @if ($user->id)  style="display:none;" @endif
                                                @endif>
                                                <div class="form-group">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" id="password" name="password"
                                                        class="form-control required" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Telephone</label>
                                                <input type="text" class="form-control required" name="telephone"
                                                    value="{{ $user->telephone ?? '' }}" id="telephone">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select class="form-control required" name="user_status" id="user_status">
                                                    <option value="">Select</option>
                                                    <option value="0"
                                                        @if (!empty($user) && $user->status == 0) selected="selected" @endif>
                                                        Inactive</option>
                                                    <option value="1"
                                                        @if (!empty($user) && $user->status == 1) selected="selected" @endif>Active
                                                    </option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>

                                            <a class="btn btn-outline-dark" href="{{ route('users') }}"
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
        $('#user_form').validate({
                    rules: {

                        email: {
                            remote: {
                                url: '{{ route('ajax_check_users_email') }}',
                                type: "POST",
                                data: {
                                    user_id: function(){
                                        return $('#user_id').val();
                                    }
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
                });
    </script>
@endsection
