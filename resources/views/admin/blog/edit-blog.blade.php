@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0">Add Blog</h5>
                        </div>
                        <hr/>
                        <form action="{{ route('new.blog') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Category </label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" <?php echo $category->id==$blog->category_id? 'selected': ''?>> {{ $category->category_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Author </label>
                                <div class="col-sm-9">
                                    <select name="author_id" class="form-control">
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}" <?php echo $author->id==$blog->author_id? 'selected': ''?>> {{ $author->author_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Title </label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Slug </label>
                                <div class="col-sm-9">
                                    <input type="text" name="slug" class="form-control" value="{{ $blog->slug }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Description </label>
                                <div class="col-sm-9">
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control"> {{ $blog->description }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-sm-3">
                                    <img src="{{ asset($blog->image) }}" alt="blog image" width="100" height="75">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Image </label>
                                <div class="col-sm-9 mt-2">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Date </label>
                                <div class="col-sm-9">
                                    <input type="date" name="date" class="form-control" value="{{ $blog->date }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Blog Type </label>
                                <div class="col-sm-9">
                                    <select name="blog_type" class="form-control">
                                        <option value="popular" <?php echo $blog->blog_type=='popular'? 'selected': ''?>> Popular </option>
                                        <option value="trending" <?php echo $blog->blog_type=='trending'? 'selected': ''?>> Trending </option>
                                        <option value="latest" <?php echo $blog->blog_type=='latest'? 'selected': ''?>> Latest </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-3 col-form-label"> Status </label>
                                <div class="col-sm-9">
                                    <input type="radio" name="status" value="1" <?php echo $blog->status==1? 'checked': ''?>> published
                                    <input type="radio" name="status" value="0" <?php echo $blog->status==0? 'checked': ''?>> unpublished
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary px-5">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

