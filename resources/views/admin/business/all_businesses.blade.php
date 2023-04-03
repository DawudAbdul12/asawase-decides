@extends('admin.template')


@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        <i class="si si-home "></i>  Businesses <small></small>
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li><a class="link-effect" href="/admin/dashboard">Dashboard</a></li>
                        <li>All Business ({{ $businesses->total() }})</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            <!-- Full Table -->
            <div class="block">
                {{-- <div class="block-header">
                    <h3 class="block-title">All Businesses</h3>
                </div> --}}
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Business Name</th>
                                    <th style="width: 15%;">Email</th>
                                    <th style="width: 22%;">Address</th>
                                    <th style="width: 18%;">experience</th>
                                    <th style="width: 15%;">Created At</th>
                                    <th class="text-center" style="width: 10%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($businesses as $business)

                                    <tr>
                                      
                                        <td> 
                                            {{ ucwords($business->business_name) }}
                                         </td>

                                         <td>
                                            {{ $business->email }}
                                        </td>

                                        <td>
                                            {{ $business->address }}
                                        </td>

                                        <td>
                                            {{ $business->experience }}
                                        </td>

                                        <td>
                                            {{ $business->created_at }}
                                        </td>
                                       
                                        <td class="text-center">
                                            <div class="btn-group">

                                                {{-- <a href="/admin/blog/{{ $business->id }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="view"><i class="fa fa-eye"></i></a> --}}

                                                <form method="POST" action="/admin/business/{{ $business->id }}" accept-charset="UTF-8">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                    <button type="submit" onClick="return confirm('Are you sure You want to Delete')" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> 
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @empty

                                <tr>

                                    {{-- <th rowspan="2" style="width: 100%;">Sl</th> --}}



                                    <td colspan="6" style="width: 100%;"> 
                                        No Record yet. Please check again later. 
                                    </td> 

                                </tr>

                                @endforelse
                            
                            </tbody>

                        </table>

                    </div>
                    {{ $businesses->links('admin.components.pagination') }}
                </div>
            </div>
            <!-- END Full Table -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection