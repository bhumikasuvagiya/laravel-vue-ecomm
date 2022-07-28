<?php // $session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bookingsystem">
    <meta name="author" content="Bookingsystem">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon/mcg-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon/mcg-logo.png') }}" />

    <title>Sign In - Dev Hub</title>

    <!-- Plugins css -->

    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/kg_custom.css') }}" />

    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/kg_custom.js') }}"></script>

</head>
@php

if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    $isremembered = 'checked';
} else {
    $email = '';
    $password = '';
    $isremembered = '';
}
@endphp

<body>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="alert alert-success alert-dismissible" id="send_mail_success_msg" role="alert"
                        style="display:none">
                        <div class="alert-message">
                            <strong>Change Password Link Successfully Send !!!</strong>
                        </div>
                    </div>
                    <div class="display-message"></div>
                    <div class="card bg-pattern">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="{{ route('dashboard') }}" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('images/kgkruch.png') }}" alt="" width="139px" height="76px">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <form class="mt-3" name="login_form" id="login_form" method="post"
                                action="{{ route('login') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Email</label>
                                    <input class="form-control required" type="text" id="email" name="email"
                                        value="{{ $email }}" placeholder="Enter your Email">
                                    <div class="email-error"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" value="{{ $password }}"
                                        placeholder="Enter your password" class="form-control required">
                                    <div class="password-error"></div>
                                </div>
                                <div class="form-group mb-3">
                                    {{--  --}}
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value=""
                                            {{ $isremembered }} name="rememberme" id="rememberme">
                                        <label class="custom-control-label" for="rememberme">Remember me next
                                            time</label>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" class="btn btn-primary btn-block" id="login_form_btn">Sign
                                        in</button>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p> <a href="javascript:void(0)" data-toggle="modal" data-target="#sizedModalMd"
                                    class="text-black-50">Forgot your password?</a></p>
                        </div> <!-- end col -->
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    <!-- BEGIN  modal -->
    <div class="modal fade" id="sizedModalMd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-top pt-3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="forgot_password_form" id="forgot_password_form" method="post" action=""
                        enctype="multipart/form-data">
                        <div class="modal-body p-0">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control required" type="text" id="admin_email" name="admin_email"
                                    placeholder="Enter your Email">
                            </div>
                            <div class="alert alert-success alert-dismissible" id="success_msg_area"
                                style="display:none;" role="alert">
                                <div class="alert-message" id="success_msg_action">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="forgot_password_form_btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END  modal -->

    <style>
        .login_error {
            font-size: 12pt;
            font-weight: bold;
            padding: 15px;
        }
    </style>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/kg_custom.js') }}"></script>
    <script>
        setTimeout(function() {
            jQuery(".alert.alert-danger").slideUp("slow");
        }, 3000);
    </script>
    <script>
        $(document).ready(function() {
            if ($('[type="checkbox"]:checked').is(':checked')) {
                $("#rememberme").val('1');
            }
            $('[name="rememberme"]').change(function() {
                if ($(this).is(':checked')) {
                    $("#rememberme").val('1');
                } else {
                    $("#rememberme").val('');
                }
            });
            $(document).on("submit", "#login_form", function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();
                var rememberme = $("#rememberme").val();
                console.log(rememberme);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('ajaxlogin') }}",
                    method: 'POST',
                    data: {
                        email: email,
                        password: password,
                        rememberme: rememberme
                    },
                    success: function(response) {
                        if (response.errors) {
                            $.each(response.errors, function(key, value) {
                                $("." + key + "-error").addClass("alert alert-danger")
                                    .text(value).show();
                            });
                        }
                        if (response.invalidemail) {
                            $(".display-message").addClass("alert alert-danger").text(response
                                .invalidemail).show();
                        }
                        if (response.success == true) {
                            $(".display-message").removeClass("alert alert-danger");
                            $(".display-message").addClass("alert alert-success").text(
                                "Login succesfull").show();
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }else {

                        }
                        setTimeout(function() {
                            $(".alert.alert-danger").slideUp(500);
                        }, 2000);
                    },
                    error: function(response) {

                    }
                });
            });
        });
    </script>
</body>

</html>
