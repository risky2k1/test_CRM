@extends('layouts.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div id="div-error" class="alert alert-danger d-none"></div>
                <div class="card-body">
                    <form class="form-horizontal"
                          action="{{ route('admin.posts.update',$data) }}"
                          method="post"
                          id="form-create-post">
                        @csrf
                        @method('put')


                        <div class="form-row">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="{{$data->title}}" >
                            </div>

                        </div>
                        <label>Content</label>
                        <textarea id="summernote" name="content" placeholder="{{$data->content}}"></textarea>
                        <div class="form-group">
                            <button class="btn btn-success" id="btn-submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                inheritPlaceholder: true,
                tabsize: 2,
                height: 200,
            });
        });
    </script>
@endpush
