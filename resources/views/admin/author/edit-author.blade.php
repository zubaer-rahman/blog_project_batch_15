@extends('admin.master')
@section('content')
    {{--    ****************** Author Input ***********************--}}
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0">Edit Author</h5>
                        </div>
                        <hr/>
                        <form action="{{ route('update.author') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="author_id" value="{{$author->id}}">
                            <div class="row">
                                <label for="" class="col-sm-3 col-form-label">Enter Author Name</label>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" name="author_name" class="form-control" id="" value="{{ $author->author_name }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="author_image"  class="form-control" id="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary px-5"> Update </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
