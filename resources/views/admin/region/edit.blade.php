@extends('admin.template')

@section('content')
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Region <small></small>
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Region</li>
                        <li><a class="link-effect" href="/admin/region">All Regions</a></li>
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
                            <form class="js-validation-material form-horizontal push-10-t" action="/admin/region/{{ $region->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <div class="form-material">
                                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="val-name" name="name" placeholder="Enter region name" value="{{ $region->name }}" required autocomplete="name">
                                            <label for="val-name">Region Name</label>
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
                                            <textarea class="form-control" id=""  name="description" rows="3" placeholder="Enter a description ">{!! $region->description !!}</textarea>
                                            <label for="">Description</label>
                                        </div>
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