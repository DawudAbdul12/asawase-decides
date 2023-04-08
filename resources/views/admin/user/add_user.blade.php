@extends('admin.template')

@section('content')
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        User <small></small>
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>User</li>
                        <li><a class="link-effect" href="/admin/user">All Users</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->`

        <!-- Page Content -->
        <div class="content content-narrow">
            <!-- Forms Row -->
            <div class="row">
              
                <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-3 col-lg-8 col-lg-offset-2">
                    <h2 class="content-heading"></h2>
                    <div class="block">
                        <div class="block-header">
                            <ul class="block-options">
                                <li>
                                    <button type="button"><i class="si si-user"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">User Form</h3>
                        </div>
                        
                        <div class="block-content block-content-narrow">
                            <x:notify-messages />
                            <!-- jQuery Validation (.js-validation-material class is initialized in js/pages/base_forms_validation.js) -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-material form-horizontal push-10-t" action="/admin/user" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <div class="form-material">
                                            <input class="form-control @error('username') is-invalid @enderror" type="text" id="val-username2" name="username" placeholder="Choose a nice username.."value="{{ old('username') }}" required autocomplete="email">
                                            <label for="val-username2">Username*</label>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control @error('email') is-invalid @enderror" type="text" id="val-email2" name="email" placeholder="Enter your valid email.." value="{{ old('email') }}" required autocomplete="email">
                                            <label for="val-email2">Email*</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control" type="password" id="val-password2" name="password" placeholder="Choose a good one.." required>
                                            <label for="val-password2">Password</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control" type="password" id="val-confirm-password2" name="password_confirmation" placeholder="..and confirm it to be safe!" required>
                                            <label for="val-confirm-password2">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>
                           
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control" type="text" id="" name="phone_number" placeholder="enter a user phone number" value="" >
                                            <label for="">Phone Number</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <textarea class="form-control" id=""  name="bio" rows="3" placeholder="Enter a User Bio "></textarea>
                                            <label for="">Bio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <select class="form-control" id="val-user-type" name="user_type" required>
                                                <option value="">Please select</option>
                                                <option  value="user">User</option>
                                                <option  value="administrator">Administrator</option>
                                                <option  value="super administrator">Super Administrator</option>
                                            </select>
                                            <label for="val-user-type">User Type*</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <select class="form-control" id="val-user-status" name="user_status" required>
                                                <option value="">Please select</option>
                                                <option   value="active">Active</option>
                                                <option  value="inactive">Inactive</option>
                                            </select>
                                            <label for="val-user-status">Account Status*</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control" type="file"  name="profile_img" >
                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END  Forms Validation -->
                </div>
            </div>
            <!-- END Forms Row -->
        </div>
        <!-- END Page Content -->
    </main>
@endsection