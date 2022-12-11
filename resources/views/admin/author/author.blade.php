@extends('admin.master')
@section('content')
    {{--    ****************** Author Input ***********************--}}
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0">Add Author</h5>
                        </div>
                        <hr/>
                        <form action="{{ route('new.author') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Enter Author Name</label>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" name="author_name" class="form-control" id="" placeholder="Enter Author Name">
                                </div>
                                <label for="" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="author_image" class="form-control" id="">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary px-5">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    ****************** Author Table to Manage ***********************--}}
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0">Manage Author</h5>
                        </div>
                        <hr/>
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            @php $i=1 @endphp
                            @foreach($authors as $author)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $author->author_name }}</td>
                                    <td>
                                        <img src="{{ asset($author->author_image) }}" alt="authorImage" height="35" width="50">
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('edit.author') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="author_id" value="{{ $author->id }}">
                                                <button type="submit" class="btn btn-primary btn-sm me-2"> Edit </button>
                                            </form>
                                            <form action="#">
                                                <a href="" class="btn btn-danger btn-sm"> Delete </a>
                                            </form>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
