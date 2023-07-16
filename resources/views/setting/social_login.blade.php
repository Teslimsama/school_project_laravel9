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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/page') }}">General Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/payment') }}">Payment Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting/email') }}">Email Settings</a>
                    </li>
                    <li class="nav-item active">
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

           {{--  --}}
         <div class="row">
								<div class="col-md-6">
									<div class="card">
										<div
											class="card-header d-flex justify-content-between align-items-center">
											<h5 class="card-title">Google Login Credential</h5>
											<div
												class="status-toggle d-flex justify-content-between align-items-center">
												<input
													type="checkbox"
													id="status_1"
													class="check"
													checked="" />
												<label for="status_1" class="checktoggle"
													>checkbox</label
												>
											</div>
										</div>
										<div class="card-body pt-0">
											<form>
												<div class="settings-form">
													<div class="form-group form-placeholder">
														<label
															>Client ID <span class="star-red">*</span></label
														>
														<input type="text" class="form-control" />
													</div>
													<div class="form-group form-placeholder">
														<label
															>Client Secret
															<span class="star-red">*</span></label
														>
														<input type="text" class="form-control" />
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
										<div
											class="card-header d-flex justify-content-between align-items-center">
											<h5 class="card-title">Facebook</h5>
											<div
												class="status-toggle d-flex justify-content-between align-items-center">
												<input
													type="checkbox"
													id="status_2"
													class="check"
													checked="" />
												<label for="status_2" class="checktoggle"
													>checkbox</label
												>
											</div>
										</div>
										<div class="card-body pt-0">
											<form>
												<div class="settings-form">
													<div class="form-group form-placeholder">
														<label
															>App ID <span class="star-red">*</span></label
														>
														<input type="text" class="form-control" />
													</div>
													<div class="form-group form-placeholder">
														<label
															>App Secret <span class="star-red">*</span></label
														>
														<input type="text" class="form-control" />
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
										<div
											class="card-header d-flex justify-content-between align-items-center">
											<h5 class="card-title">Twiter Login Credential</h5>
											<div
												class="status-toggle d-flex justify-content-between align-items-center">
												<input type="checkbox" id="status_3" class="check" />
												<label for="status_3" class="checktoggle"
													>checkbox</label
												>
											</div>
										</div>
										<div class="card-body pt-0">
											<form>
												<div class="settings-form">
													<div class="form-group form-placeholder">
														<label
															>Client ID <span class="star-red">*</span></label
														>
														<input type="text" class="form-control" />
													</div>
													<div class="form-group form-placeholder">
														<label
															>Client Secret
															<span class="star-red">*</span></label
														>
														<input type="text" class="form-control" />
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
@endsection