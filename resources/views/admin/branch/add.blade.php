@extends('admin.template')

@section('content')
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Branch <small></small>
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Branch</li>
                        <li><a class="link-effect" href="/admin/branch">All Branches</a></li>
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

                        {{-- <div class="block-header">
                            <ul class="block-options">
                                <li>
                                    <button type="button"><i class="si si-user"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">User Form</h3>
                        </div> --}}
                        
                        <div class="block-content block-content-narrow">
                            <x:notify-messages />
                            <!-- jQuery Validation (.js-validation-material class is initialized in js/pages/base_forms_validation.js) -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-material form-horizontal push-10-t" action="/admin/branch" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <div class="form-material">
                                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="val-name" name="name" placeholder="Enter branch name"value="{{ old('name') }}" required autocomplete="name">
                                            <label for="val-name">Branch Name</label>
                                            @error('name')
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
                                            <select class="form-control" id="val-constituency-type" name="constituency_id" required>
                                                <option value="">Please select</option>
                                                @foreach ($constituencies as $constituency)
                                                    <option  value="{{ $constituency->id }}">{{ $constituency->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="val-constituency-type">Select a constituency*</label>
                                        </div>
                                    </div>
                                </div>
                             
                              
                                <div class="form-group">
                                    <div class="col-xs-12 text-right">
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