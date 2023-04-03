@extends('admin.template')

@section('content')
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        User  <small></small>
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
              
                <div class="col-lg-8">
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
                            <form class="js-validation-material form-horizontal push-10-t" action="/admin/user/{{ $user->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <div class="form-material">
                                            <input class="form-control @error('username') is-invalid @enderror" type="text" id="val-username2" name="username" placeholder="Choose a nice username.." value="{{ $user->username }}" required>
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
                                            <input class="form-control @error('email') is-invalid @enderror" type="text" id="val-email2" name="email" placeholder="Enter your valid email.." value="{{ $user->email }}"  required>
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
                                            <input class="form-control" type="text" id="" name="phone_number" placeholder="enter a user phone number" value="{{ $user->phone_number }}" >
                                            <label for="">Phone Number</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <textarea class="form-control" id="" name="bio" rows="3" placeholder="Enter a User Bio ">{{ $user->bio }}</textarea>
                                            <label for="">Bio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <select class="form-control" id="val-user-type" name="user_type" required>
                                                <option value="">Please select</option>
                                                <option @if($user->type == "user") selected  @endif value="user">User</option>
                                                <option @if($user->type == "administrator") selected  @endif value="administrator">Administrator</option>
                                                <option @if($user->type == "super administrator") selected  @endif value="super administrator">Super Administrator</option>
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
                                                <option  @if($user->status == "active") selected  @endif value="active">Active</option>
                                                <option @if($user->status == "inactive") selected  @endif value="inactive">Inactive</option>
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
                                        @if($user->pic == "")
                                            <img src="/profile" alt="{{ $user->username }}" style="width:100px; height:100px">
                                        @else 
                                            <img src="{{ $user->pic }}" alt="{{ $user->username }}" style="width:100px; height:100px">
                                        @endif
                                    </div>
                                </div>

                                <input name="_method" type="hidden" value="PUT">

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