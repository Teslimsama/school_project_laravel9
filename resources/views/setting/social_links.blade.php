@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Settings</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('setting/page') }}">Settings</a></li>
                            <li class="breadcrumb-item active">Social Links</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="settings-menu-links">
                <ul class="nav nav-tabs menu-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/page') }}">General Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/payment') }}">Payment Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/email') }}">Email Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/sociallogin') }}">Social Media Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('setting/sociallinks') }}">Social Links</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/seosettings') }}">SEO Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/othersettings') }}">Others</a>
                    </li>
                </ul>
            </div>

            {{--  --}}
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Social Link Settings</h5>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/updatesociallinks') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="links-info">
                                        <div class="row form-row links-cont">
                                            <div class="form-group form-placeholder d-flex">
                                                <button class="btn social-icon">
                                                    <i class="feather-facebook"></i>
                                                </button>
                                                <input type="text" class="form-control" name="facebook"
                                                    value="{{ $settingsDetails->facebook }}"
                                                    placeholder="https://www.facebook.com" />
                                                <div>
                                                    {{-- <a href="#" class="btn trash">
																		<i class="feather-trash-2"></i>
																	</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="links-info">
                                        <div class="row form-row links-cont">
                                            <div class="form-group form-placeholder d-flex">
                                                <button class="btn social-icon">
                                                    <i class="feather-twitter"></i>
                                                </button>
                                                <input type="text" class="form-control" name="twitter"
                                                    value="{{ $settingsDetails->twitter }}"
                                                    placeholder="https://www.twitter.com" />
                                                <div>
                                                    {{-- <a href="#" class="btn trash">
																		<i class="feather-trash-2"></i>
																	</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="links-info">
                                        <div class="row form-row links-cont">
                                            <div class="form-group form-placeholder d-flex">
                                                <button class="btn social-icon">
                                                    <i class="feather-youtube"></i>
                                                </button>
                                                <input type="text" class="form-control" name="youtube"
                                                    value="{{ $settingsDetails->youtube }}"
                                                    placeholder="https://www.youtube.com" />
                                                <div>
                                                    {{-- <a href="#" class="btn trash">
																		<i class="feather-trash-2"></i>
																	</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="links-info">
                                        <div class="row form-row links-cont">
                                            <div class="form-group form-placeholder d-flex">
                                                <button class="btn social-icon">
                                                    <i class="feather-linkedin"></i>
                                                </button>
                                                <input type="text" class="form-control" name="linkedin"
                                                    value="{{ $settingsDetails->linkedin }}"
                                                    placeholder="https://www.linkedin.com" />
                                                <div>
                                                    {{-- <a href="#" class="btn trash">
																		<i class="feather-trash-2"></i>
																	</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
													<a href="javascript:void(0);" class="btn add-links">
														<i class="fas fa-plus me-1"></i> Add More
													</a>
												</div> --}}
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-orange">
                                            Submit
                                        </button>
                                        <button type="submit" class="btn btn-grey">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
