@extends('admin.template')


@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        <i class="si si-user  bigicon"></i> Persons <small></small>
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li><a class="link-effect" href="/admin/dashboard">Dashboard</a></li>
                        <li>All Persons ({{ $persons->total() }}) </li>
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

                                    <th style="width: 15%;">Email</th>
                                    <th style="width: 20%;">First Name</th>
                                    <th style="width: 20%;">Last Name</th>
                                    <th style="width: 20%;">experience</th>
                                    <th style="width: 15%;">Created At</th>
                                    <th class="text-center" style="width: 10%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($persons as $person)

                                    <tr>

                                        <td>
                                            {{ $person->email }}
                                        </td>
                                      
                                        <td> 
                                            {{ ucwords($person->first_name) }}
                                         </td>

                                         <td> 
                                            {{ ucwords($person->last_name) }}
                                         </td>

                                        <td>
                                            {{ $person->experience }}
                                        </td>

                                        <td>
                                            {{ $person->created_at }}
                                        </td>
                                       
                                        <td class="text-center">
                                            <div class="btn-group">

                                                {{-- <a href="/admin/blog/{{ $business->id }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="view"><i class="fa fa-eye"></i></a> --}}

                                                <form method="POST" action="/admin/person/{{ $person->id }}" accept-charset="UTF-8">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                    <button type="submit" onClick="return confirm('Are you sure You want to Delete')" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> 
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @empty

                                <tr>
                                    
                                    <td colspan="6" style="width: 100%;"> 
                                        No Record yet. Please check again later. 
                                    </td> 

                                </tr>

                                @endforelse
                            
                            </tbody>

                        </table>

                    </div>
                    {{ $persons->links('admin.components.pagination') }}
                </div>
            </div>
            <!-- END Full Table -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection