@extends('layout.app')
@section('title', 'KgKrunch - Setting')
@section('content')


<div class="wrapper">
    <div class="main kg-setting">
        <div class="content-page">
        <main class="content">
            
            <div class="container-fluid p-0">
                <div class="row mt-4">
                    <div class="col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                            <li class="breadcrumb-item active">User List</li>
                        </ol>
                        <div class="card">
                            
                            <div class="card-body">

                            <div class="alert alert-success alert-dismissible success_msg" id="success_msg" style="display:none;" role="alert">
                                <div class="alert-message" id="success_msg_action">
                                </div>
                            </div>
                            <div class="alert alert-danger alert-dismissible" id="error_msg_area" style="display:none;" role="alert">
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
                            <form class="jqvform" novalidate name="product_form" id="product_form"
                                            method="post" action="{{ route('setting_change')}}" enctype="multipart/form-data">     
                                            @csrf                 
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">Settings</h4>
            
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist"
                                                    aria-orientation="vertical">
                                                    {{-- <a class="nav-link active show mb-1" id="v-pills-home-tab" data-toggle="pill"
                                                        href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                                        aria-selected="true">
                                                        Home</a> --}}
                                                    <a class="nav-link active show mb-1" id="v-pills-settings-tab" data-toggle="pill"
                                                        href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                                        aria-selected="false">
                                                        Settings</a>
                                                    <a class="nav-link mb-1" id="v-pills-profile-tab" data-toggle="pill"
                                                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                                        aria-selected="false">
                                                        Profile</a>
                                                    {{-- <a class="nav-link mb-1" id="v-pills-messages-tab" data-toggle="pill"
                                                        href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                                        aria-selected="false">
                                                        Messages</a> --}}
                                                   
                                                </div>
                                            </div> <!-- end col-->
                                            
                                            <div class="col-lg-9">
                                                <div class="tab-content pt-0">
                                                    
                                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                        aria-labelledby="v-pills-profile-tab">
                                                        <div class="form-group">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" name="description"
                                                               id="description">{{ $setting->description ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade active show" id="v-pills-settings" role="tabpanel"
                                                        aria-labelledby="v-pills-settings-tab">
                                                        <div class="form-group">
                                                            <label class="form-label">Website Name</label>
                                                            <input type="text" class="form-control" name="website_name" value="{{ $setting->website_name ?? '' }}"
                                                                value="" id="website_name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Contact</label>
                                                            <input type="text" class="form-control" name="contact_details" value="{{ $setting->contact_details ?? '' }}"
                                                                value="" id="contact_details">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" class="form-control" name="email" value="{{ $setting->email ?? '' }}"
                                                                value="" id="email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Address</label>
                                                            <textarea class="form-control" name="address"
                                                            id="address">{{ $setting->address ?? '' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Phone</label>
                                                            <input type="text" class="form-control" name="phone" value="{{ $setting->phone ?? '' }}"
                                                                value="" id="phone">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Logo</label>
                                                            <input type="file" class="form-control" name="logo" 
                                                                id="logo">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Favicon</label>
                                                            <input type="file" class="form-control" name="favicon"
                                                                id="favicon">
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                        {{-- <a class="btn btn-outline-dark" href="#" role="button">Cancel</a> --}}
                                            </div> <!-- end col-->
                                        </div> <!-- end row-->
            
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                            </div>
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
    @endsection
