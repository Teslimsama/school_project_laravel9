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
                            <li class="breadcrumb-item active">General Settings</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="settings-menu-links">
                <ul class="nav nav-tabs menu-tabs">
                    <li class="nav-item ">
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/sociallinks') }}">Social Links</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/seosettings') }}">SEO Settings</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('setting/othersettings') }}">Others</a>
                    </li>
                </ul>
            </div>

            {{-- --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Enable Google Analytics</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_1" class="check" checked="" />
                                <label for="status_1" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/googleanalytics') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label>Google Analytics
                                            <span class="star-red">*</span></label>
                                        <textarea class="form-control"
                                            value="{{ $SeosettingsDetails->google_analytics }}"name="googleanalytics"placeholder="{{ $SeosettingsDetails->google_analytics }}"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Enable Google Adsense Code</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_2" class="check" checked="" />
                                <label for="status_2" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/googleadsensecode') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label>Google Adsense Code
                                            <span class="star-red">*</span></label>
                                        <textarea class="form-control" value="{{ $SeosettingsDetails->google_adsense_code }}" name="googleadsensecode"
                                            placeholder="{{ $SeosettingsDetails->google_adsense_code }}"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Display Facebook Messenger</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_3" class="check" checked="" />
                                <label for="status_3" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/facebookmessenger') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label>Facebook Messenger
                                            <span class="star-red">*</span></label>
                                        <textarea class="form-control"value="{{ $SeosettingsDetails->facebook_messenger }}" name="facebookmessenger"
                                            placeholder="{{ $SeosettingsDetails->facebook_messenger }}"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Display Facebook Pixel</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_4" class="check" checked="" />
                                <label for="status_4" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/facebookpixel') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label>Google Adsense Code
                                            <span class="star-red">*</span></label>
                                        <textarea class="form-control"value="{{ $SeosettingsDetails->facebook_pixel }}" name="facebookpixel"
                                            placeholder="{{ $SeosettingsDetails->facebook_pixel }}"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card w-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Display Google Recaptcha</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_5" class="check" checked="" />
                                <label for="status_5" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/googlerecaptcha') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group form-placeholder">
                                        <label>Google Rechaptcha Site Key
                                            <span class="star-red">*</span></label>
                                        <input type="text"
                                            name="googlerecaptcha_1"value="{{ $SeosettingsDetails->google_recaptcha_1 }}"
                                            class="form-control" placeholder="6LcnPoEaAAAAAF6QhKPZ8V4744yiEnr41li3SYDn" />
                                    </div>
                                    <div class="form-group form-placeholder">
                                        <label>Google Rechaptcha Secret Key
                                            <span class="star-red">*</span></label>
                                        <input type="text"
                                            name="googlerecaptcha_2" value="{{ $SeosettingsDetails->google_recaptcha_2 }}"
                                            class="form-control" placeholder="6LcnPoEaAAAAACV_xC4jdPqumaYKBnxz9Sj6y0zk" />
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card w-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Cookies Agreement</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_6" class="check" checked="" />
                                <label for="status_6" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/cookiesagreement') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label>Cookies Agreement Text
                                            <span class="star-red">*</span></label>
                                        <div id="">
                                            <textarea name="cookiesagreement" value="{{ $SeosettingsDetails->cookies_agreement }}"id="editor" cols="30"
                                                rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
