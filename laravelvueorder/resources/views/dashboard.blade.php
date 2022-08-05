@extends('layout.app')
@section('title','KgKrunch Shop')
@section('content') 
    <div class="content-page">
        <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col-12">
                                <div class="card widget-inline">
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="alert alert-success alert-dismissible" id="success_msg_area" style="display:none;" role="alert">
                                            <div class="alert-message" id="success_msg_action">
                                            </div>
                                    </div>
                                    <div class="alert alert-danger alert-dismissible" id="error_msg_area" style="display:none;" role="alert">
                                            <div class="alert-message" id="error_msg_action">
                                            </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6 col-xl-12">
                                            <div class="p-2 text-center">
                                            <h1>
                                                Welcome To KgKrunch
                                            </h1> 
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <!-- container -->
        </div>
        <!-- content -->
    </div>
@endsection