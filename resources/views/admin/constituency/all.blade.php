@extends('admin.template')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Constituency <small></small>
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Constituency</li>
                        <li><a class="link-effect" href="/admin/constituency/create">Add a Constituency</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            <!-- Full Table -->
            <div class="block">
               
                <div class="block-content">
                    {{-- <p class="push-30"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate necessitatibus quisquam at fuga magni illum quas porro quo, non illo quos quam perspiciatis temporibus modi! Tempora sed ipsum expedita veniam.</p> --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th style="width: 15%;">Total Branches</th>
                                    <th style="width: 25%;">Region</th>
                                    <th style="width: 15%;">Created At</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($constituencies as $constituency)

                                        <td class="font-w600"> 
                                            {{ ucwords($constituency->name) }} 
                                        </td>

                                        <td class="text-center"> 
                                            {{ $constituency->branches_count }} 
                                        </td>

                                        <td> 
                                            {{ isset($constituency->region) ? ucwords($constituency->region->name) : "Unasigned" }}
                                        </td>


                                        <td>
                                            {{ $constituency->created_at }}
                                        </td>
                                        
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="/admin/constituency/{{ $constituency->id }}/edit" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <form method="POST" action="/admin/constituency/{{ $constituency->id }}" accept-charset="UTF-8">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                    <button type="submit" onClick="return confirm('Are you sure You want to Delete')" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> 
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @empty

                                <td colspan="4" style="width: 100%;"> 
                                    No Record yet. Please check again later. 
                                </td> 

                                @endforelse
                            
                            </tbody>

                        </table>

                    </div>
                    {{ $constituencies->links('admin.components.pagination') }}
                </div>
            </div>
            <!-- END Full Table -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection