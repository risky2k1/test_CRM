@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.posts.create')}}" class="btn btn-success">Add Post</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Posted by</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($data as $val)
                            <tr>
                                <td>{{$val->id}}</td>
                                <td>
                                    {{$val->title}}

                                </td>
                                <td>
                                    {{--                                    {{$val->user_id ? $val->user->name : ''}}--}}
                                    {{$val->userName}}
                                </td>
                                <td>
                                    {{$val->slug}}
                                </td>
                                <td>
                                    {{$val->status_name}}
                                </td>
                                <td>
                                    {{$val->content}}
                                </td>
                                <td>
                                    <form action="{{ route("admin.posts.destroy", $val) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                    <a href="{{route('admin.posts.edit',['post'=>$val])}}" class="btn btn-info text-white">Change</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination pagination-rounded mb-0">
                            {{$data->links()}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
