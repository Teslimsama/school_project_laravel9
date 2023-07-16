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
                            <li class="breadcrumb-item active">SEO Settings</li>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/sociallinks') }}">Social Links</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('setting/seosettings') }}">SEO Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/othersettings') }}">Others</a>
                    </li>
                </ul>
            </div>

            {{-- --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">SEO Settings</h5>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/updateseosettings') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group form-placeholder">
                                        <label>Meta Title <span class="star-red">*</span></label>
                                        <input type="text" name="title" class="form-control"value="{{ $SeosettingsDetails->meta_title }}" />
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Keywords
                                            <span class="star-red">*</span></label>
                                        <input type="text" data-role="tagsinput" class="input-tags form-control"
                                            placeholder="Meta Keywords" name="services" value="{{ $SeosettingsDetails->meta_keywords }}"
                                            id="services" />
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description
                                            <span class="star-red">*</span></label>
                                        <textarea class="form-control" name="description" value="{{ $SeosettingsDetails->meta_description }}" placeholder="{{ $SeosettingsDetails->meta_description }}"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">
                                                Submit
                                            </button>
                                            {{-- <button type="submit" class="btn btn-grey">
                                                Cancel
                                            </button> --}}
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
