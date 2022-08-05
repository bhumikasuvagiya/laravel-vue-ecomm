<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="KgKrunch">
    <meta name="author" content="KgKrunch">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/kg_custom.css?v=03022022') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <!-----External css---------->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fancybox/jquery.fancybox.css') }}" media="screen" />
    <!--------------------------->

    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/kg_custom.js') }}"></script>
    <script>
        var hide_msg_time = 3000;
    </script>
</head>

<body data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    @include('partial.header')
    @yield('content')
    @include('partial.footer')

    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.min.js') }}"></script>


    <!--Multi select Dropdown-->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.lazyload.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/fancybox/jquery.fancybox.pack.js') }}"></script>
    <!------------------------->



    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
    <!--------------------->

    <script type="text/javascript">
        $(document).ready(function(e) {
            $(".toggle-password")
                .mousedown(function() {
                    $(this).prevAll().attr("type", "text");
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                })
                .mouseup(function() {
                    $(this).prevAll().attr("type", "password");
                    $(this).addClass("fa-eye-slash");
                });

            //Form validation
            //$("#users_form").validate();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $("#password_div").hide();
            $("#password_chk").click(function () {
                if ($(this).is(":checked")) {
                    $("#password_div").show();
                } else {
                    $("#password_div").hide();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: { 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });            
            $('#admin_update_form').validate({
                rules: {
                    old_password: {
                        remote: {
                            url: '{{ route('ajax_check_admin_password') }}',
                            type: 'post'
                        }
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#new_password"
                    },
                    user_email:
                    {
                        remote:
                        {
                            url : '{{ route('ajax_check_users_email') }}',
                            type : 'post',
                            data: {id:'<?php echo !empty($user_data['user_id']) ? $user_data['user_id'] : null ?>'}
                        }
                    },
                    user_name:
                    {
                        remote:
                        {
                            url : '{{ route('ajax_check_user_name') }}',
                            type : 'post',
                            data: {id:'<?php echo !empty($user_data['user_id']) ? $user_data['user_id'] : null ?>'}
                        }
                    }
                },
                messages: {
                    confirm_password: "New Password Or Re-enter Password are wrong.",
                },
                submitHandler: function(form) {
                    event.preventDefault();
                    $('#sizedModalLg').modal('hide');
                    $.ajax
                    ({
                        url: "{{ route('admin_update_details') }}",
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(data) 
                        {
                            $("#user-form-date").html(data);
                        }
                        
                    });					
                }
            });
        });	
        
    function common_loader(status)
    {
        if(status == 'show')
            $('.common_loader_area').html('<img src="{{ asset('assets/img/loader.svg') }}">');
        else if(status == 'hide')
            $('.common_loader_area').html('');
        
        $('.common_loader_area').toggleClass("common_loader");
    }

    function common_submit_loader(status)
    {
        if(status == 'show')
            $('.common_submit_loader_area').html('<img src="{{ asset('assets/img/loader.svg') }}">');
        else if(status == 'hide')
            $('.common_submit_loader_area').html('');
        
        $('.common_submit_loader_area').toggleClass("common_submit_loader");
    } 	

    function user_profile_form_popup()
        {
            $.ajax
            ({
                url: '{{ route('user_profile_form') }}',
                success: function(msg)
                {
                    // // console.log(response_data);
                    $('#user_profile_popup').html(msg);
                    // //$('#save_complaint_popup').modal('show');
                    $('#user_profile_popup').modal({backdrop: 'static', keyboard: false});
                }
            });

            //$("#sizedModalLg").model('show');
        }
        $( document ).ready(function() {
          
     
        function user_profile_form()
        {
            $.ajax
            ({
                url: '{{ route('ajax_get_user_data') }}',
                success: function(msg)
                {
                    console.log(msg);
                    var response_data=jQuery.parseJSON(msg);
                }
            });
        }
        
    });
    </script>
    @yield('custom_script')
</body>

</html>