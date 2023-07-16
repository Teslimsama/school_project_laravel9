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
                    <li class="nav-item active">
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/othersettings') }}">Others</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Website Basic Details</h5>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/update') }}" method="post" enctype="multipart/form-data">
                               @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label>Website Name <span class="star-red">*</span></label>
                                        <input type="text" class="form-control"name="name" placeholder="Enter Website Name" value="{{ $settingsDetails->name }}">
                                    </div>
                                    <div class="form-group">
                                        <p class="settings-label">Logo <span class="star-red">*</span></p>
                                        <div class="settings-btn">
                                            <input type="file" accept="image/*" name="logo" id="file"
                                                onchange="loadFile(event)" class="hide-input">
                                            <label for="file" class="upload">
                                                <i class="feather-upload"></i>
                                            </label>
                                        </div>
                                        <h6 class="settings-size">Recommended image size is <span>150px x
                                                150px</span></h6>
                                        <div class="upload-images">
                                            <img src="{{ Storage::url('photos/'.$settingsDetails->favicon) }}" alt="logo">
                                            <input type="hidden"name="image_hidden1" value="{{ $settingsDetails->logo }}">
                                            <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                <i class="feather-x-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p class="settings-label">Favicon <span class="star-red">*</span></p>
                                        <div class="settings-btn">
                                            <input type="file" accept="image/*" name="favicon" id="file"
                                                onchange="loadFile(event)" class="hide-input">
                                            <label for="file" class="upload">
                                                <i class="feather-upload"></i>
                                            </label>
                                        </div>
                                        <h6 class="settings-size">
                                            Recommended image size is <span>16px x 16px or 32px x 32px</span>
                                        </h6>
                                        <h6 class="settings-size mt-1">Accepted formats: only png and ico</h6>
                                        <div class="upload-images upload-size">
                                            <input type="hidden" name="image_hidden2" value="{{ $settingsDetails->favicon }}">
                                            <img src="{{ Storage::url('photos/'.$settingsDetails->favicon) }}" alt="favicon">
                                            <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                <i class="feather-x-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="form-group">
                                                <div
                                                    class="status-toggle d-flex justify-content-between align-items-center">
                                                    <p class="mb-0">RTL</p>
                                                    <input type="checkbox" id="status_1" class="check">
                                                    <label for="status_1" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">Update</button>
                                            <button type="submit" class="btn btn-grey">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Address Details</h5>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/address') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label>Address Line 1 <span class="star-red">*</span></label>
                                        <input type="text" class="form-control" value="{{ $settingsDetails->address1 }}"name="address1" placeholder="Enter Address Line 1">
                                    </div>
                                    <div class="form-group">
                                        <label>Address Line 2 <span class="star-red">*</span></label>
                                        <input type="text" class="form-control" name="address2" placeholder="Enter Address Line 2"value="{{ $settingsDetails->address2 }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City <span class="star-red">*</span></label>
                                                <input type="text" class="form-control" name="city" value="{{ $settingsDetails->city }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State/Province <span class="star-red">*</span></label>
                                                <select class="select form-control" name="state">
                                                    <option selected="selected">Select</option>
                                                    <option value="california">California</option>
                                                    <option>Tasmania</option>
                                                    <option>Auckland</option>
                                                    <option>Marlborough</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Zip/Postal Code <span class="star-red">*</span></label>
                                                <input type="text" class="form-control" name="zip" value="{{ $settingsDetails->zip }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country <span class="star-red">*</span></label>
                                                <select class="select form-control" name="country">
                                                    <option selected="selected">Select</option>
                                                    <option value="india">India</option>
                                                    <option>London</option>
                                                    <option>France</option>
                                                    <option>USA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">Update</button>
                                            <button type="submit" class="btn btn-grey">Cancel</button>
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