@extends('admin.template')

@section('content')
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Member <small></small>
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Member</li>
                        <li><a class="link-effect" href="/admin/member">All Members</a></li>
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
                      
                        <div class="block-content block-content-narrow">
                            <x:notify-messages />
                            <!-- jQuery Validation (.js-validation-material class is initialized in js/pages/base_forms_validation.js) -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-material form-horizontal push-10-t" action="/admin/member/{{ $member->id }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <div class="form-material">
                                            <input class="form-control @error('fname') is-invalid @enderror" type="text" id="val-fname" name="fname" placeholder="Enter First name.."value="{{ ucwords($member->fname) }}" required autocomplete="fname">
                                            <label for="val-fname">First name*</label>
                                            @error('fname')
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
                                            <input class="form-control @error('sname') is-invalid @enderror" type="text" id="val-sname" name="sname" placeholder="Enter Middle name.."value="{{ $member->sname }}"  autocomplete="sname">
                                            <label for="val-sname">Middle name</label>
                                            @error('sname')
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
                                            <input class="form-control @error('lname') is-invalid @enderror" type="text" id="val-lname" name="lname" placeholder="Enter Last name.."value="{{ $member->lname }}" required autocomplete="lname">
                                            <label for="val-lname">Last name*</label>
                                            @error('lname')
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
                                            <select class="form-control" id="val-gender-type" name="gender" required>
                                                <option value="">Please select Gender</option>
                                                <option {{ $member->gender == "Female" ? "selected": ""}} value="female">Female</option>
                                                <option {{ $member->gender == "Male" ? "selected": ""}} value="Male">Male</option>
                                            </select>
                                            <label for="val-gender-type">Gender*</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <div class="form-material">
                                            <input class="form-control @error('address') is-invalid @enderror" type="text" id="val-address" name="address" placeholder="Enter address"value="{{ $member->address }}" required autocomplete="address">
                                            <label for="val-address"> Digital Address*</label>
                                            @error('address')
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
                                            <input class="form-control @error('location') is-invalid @enderror" type="text" id="val-location" name="location" placeholder="Enter location. eg. Kumasi - Aboaboa no.2 "value="{{ $member->location }}"  autocomplete="location">
                                            <label for="val-location"> Location</label>
                                            @error('location')
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
                                            <input class="form-control @error('phone_number') is-invalid @enderror" type="text" id="val-phone_number" name="phone_number" placeholder="Enter Phone Number "value="{{ $member->phone_number }}"  autocomplete="phone_number" required>
                                            <label for="val-phone_number"> Phone Number*</label>
                                            @error('phone_number')
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
                                            <input class="form-control @error('email') is-invalid @enderror" type="text" id="val-email2" name="email" placeholder="Enter your valid email.." value="{{ $member->email }}"  autocomplete="email">
                                            <label for="val-email2">Email</label>
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
                                            <input class="form-control @error('dob') is-invalid @enderror" type="date" id="val-dob" name="dob" value="{{ $member->dob }}"  autocomplete="phone_number" required>
                                            <label for="val-phone_number"> Select Date of Birth</label>
                                            @error('dob')
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
                                            <input class="form-control @error('occupation') is-invalid @enderror" type="text" id="val-occupation" name="occupation" value="{{ $member->occupation }}" placeholder="Enter occupation"  autocomplete="occupation">
                                            <label for="val-occupation"> Occupation </label>
                                            @error('occupation')
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
                                            <select class="form-control" id="val-education" name="education" required>
                                                <option value="">Please select</option>
                                                <option {{ $member->education == "JHS" ? "selected": ""}} value="JHS">JHS</option>
                                                <option {{ $member->education == "SHS" ? "selected": ""}}  value="SHS">SHS</option>
                                                <option {{ $member->education == "Diploma" ? "selected": ""}} value="Diploma">Diploma</option>
                                                <option {{ $member->education == "Degree" ? "selected": ""}} value="Degree">Degree</option>
                                                <option {{ $member->education == "Master" ? "selected": ""}} value="Master">Master</option>
                                                <option {{ $member->education == "PHD" ? "selected": ""}} value="PHD">PHD</option>
                                                <option {{ $member->education == "Other" ? "selected": ""}} value="Other">Other</option>
                                            </select>
                                            <label for="val-education">Education*</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <select class="form-control" id="val-branch_id" name="branch_id" required>
                                                <option value="">Please select</option>
                                                @foreach ($branches as $branch)
                                                    <option  {{ $member->branch_id == $branch->id ? "selected": ""}}  value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="val-branch_id">Select a Branch*</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <select class="form-control" id="val-status" name="status" required>
                                                <option value="">Please select</option>
                                                <option {{ $member->status == "approved" ? "selected": ""}} value="approved">Approved</option>
                                                <option {{ $member->status == "pending" ? "selected": ""}} value="pending">Pending</option>
                                                <option {{ $member->status == "suspension" ? "selected": ""}} value="suspension">Suspension</option>
                                                <option {{ $member->status == "dead" ? "selected": ""}} value="dead">Dead</option>
                                                <option {{ $member->status == "others" ? "selected": ""}} value="others">Others</option>
                                            </select>
                                            <label for="val-status"> Status*</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <textarea class="form-control" id=""  name="note" rows="3" placeholder="Enter a note. if any ">{!! $member->note !!}</textarea>
                                            <label for="">Note. if any</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control" type="file"  name="profile_pic" >
                                        </div>

                                        @if($member->profile_pic == "")
                                            <img src="/assets/img/avatars/avatar6.jpg" alt="{{ $member->fname }}" style="width:100px; height:100px">
                                        @else 
                                            <img src="{{ $member->profile_pic }}" alt="{{ $member->fname }}" style="width:100px; height:100px">
                                        @endif

                                    </div>
                                </div>

                                <input name="_method" type="hidden" value="PUT">

                                <div class="form-group">
                                    <div class="col-xs-12 text-right">
                                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
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