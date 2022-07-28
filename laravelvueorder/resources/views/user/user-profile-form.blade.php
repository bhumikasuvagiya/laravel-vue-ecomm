<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Change Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form novalidate name="user_profile_form" id="user_profile_form" method="post" action=""
            enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id ?? '' }}">
                <div class="form-group">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control required" name="firstname" id="firstname"
                        value="{{ $user->first_name ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control required" name="lastname" id="lastname"
                        value="{{ $user->last_name ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control required" name="email" id="email"
                        value="{{ $user->email ?? '' }}">
                </div>
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" id="password_chk" class="custom-control-input">
                    <span class="custom-control-label">Change Password</span>
                </label>
                <div id="password_div">
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Old Pasword</label>
                        <input type="password" class="form-control required" name="old_password" id="old_password">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control required" name="new_password" id="new_password">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control required" name="confirm_password"
                            id="confirm_password">
                        <span class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="user_profile_btn" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<style>
    #user_profile_form .modal-body {
        height: auto;
        overflow-y: hidden;
    }
</style>
<script type="text/javascript">
    $('#user_profile_form').validate({
        rules: {
            old_password: {
                remote: {
                    url: '{{ route('ajax_check_password') }}',
                    type: 'post'
                }
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password"
            },

            email: {
                remote: {
                    url: '{{ route('ajax_check_users_email') }}',
                    type: "POST",
                    data: {
                        user_id: function() {
                            return $('#user_id').val();
                        }
                    }

                },
            },
        },
        messages: {
            confirm_password: "New Password Or Re-enter Password are wrong.",
        },
        submitHandler: function(form) {

            var FormData_data = new FormData($("#user_profile_form")[0]);
            $('#user_profile_btn').attr("disabled", "disabled");
            $.ajax({
                url: '{{ route('ajax_save_user_profile') }}',
                type: 'POST',
                data: FormData_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(msg) {

                    $("#user_profile_popup").modal('toggle');
                    if (msg) {
                        var response_data = jQuery.parseJSON(msg);
                        if (response_data == 1) {}

                    } else {
                        $('#common_error_msg_action').html(
                            'Something Problem With Saved Data.');
                        $('#common_error_msg_area').css('display', 'block');
                        setTimeout(function() {
                            $('#common_error_msg_area').stop().slideUp('slow');
                        }, 4000);
                    }

                }
            });
        }

    });
    $(document).ready(function() {
        $("#password_div").hide();
        $("#password_chk").click(function() {
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
        $(".toggle-password")
            .mousedown(function() {
                $(this).prevAll().attr("type", "text");
                $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            })
            .mouseup(function() {
                $(this).prevAll().attr("type", "password");
                $(this).addClass("fa-eye-slash");
            });
    });
</script>
