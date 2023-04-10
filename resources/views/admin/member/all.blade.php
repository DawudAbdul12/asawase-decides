@extends('admin.template')

@section('content')
    <!-- Main Container -->
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
                        <li><a class="link-effect" href="/admin/member/create">Add a Member</a></li>
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
                    <h3 class="block-title">All User(s)</h3>
                </div> --}}
                <div class="block-content">
                    {{-- <p class="push-30"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptate necessitatibus quisquam at fuga magni illum quas porro quo, non illo quos quam perspiciatis temporibus modi! Tempora sed ipsum expedita veniam.</p> --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 120px;"><i class="si si-user"></i></th>
                                    <th> Full Name </th>
                                    <th style="width: 20%;">Phone</th>
                                    <th style="width: 15%;">Occupation</th>
                                    <th style="width: 15%;">Branch</th>
                                    <th style="width: 10%;">Status</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($members as $member)

                                    <tr>
                                        <td class="text-center">
                                            @if($member->profile_pic == "")

                                                <img class="img-avatar img-avatar48" src="assets/img/avatars/avatar6.jpg" alt="">

                                            @else 

                                                <img class="img-avatar img-avatar48" src="{{ $member->profile_pic }}" alt="{{ ucwords($member->username) }}">

                                            @endif
                                        </td>
                                        <td class="font-w600"> 
                                            {{ ucwords($member->fname." ".$member->sname." ".$member->lname) }} <br>
                                            ID: {{ $member->membership_id }} 
                                        </td>
                                        <td>
                                            {{ $member->phone_number }} <br>
                                            Location:{{ $member->location }} 
                                        </td>
                                       
                                        <td>
                                            {{ $member->occupation }} <br>
                                            Education:{{ $member->education }}
                                        </td>
                                      
                                        <td class="font-w600">
                                            {{ isset($member->branch) ? ucwords($member->branch->name) : "Unasigned" }}
                                           
                                        </td>
                                      
                                        <td>
                                            @if($member->status == "approved")
                                                <span class="label label-success"> {{ $member->status }} </span>
                                            @else
                                                <span class="label label-danger"> {{ $member->status }} </span>
                                            @endif
                                        </td>
                                        
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="/admin/member/{{ $member->id }}/edit" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <form method="POST" action="/admin/member/{{ $member->id }}" accept-charset="UTF-8">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                    <button type="submit" onClick="return confirm('Are you sure You want to Delete')" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> 
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @empty

                                    <td colspan="9" style="width: 100%;"> 
                                        No Record yet. Please check again later. 
                                    </td> 

                                @endforelse
                            
                            </tbody>

                        </table>

                    </div>
                    {{ $members->links('admin.components.pagination') }}
                </div>
            </div>
            <!-- END Full Table -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection