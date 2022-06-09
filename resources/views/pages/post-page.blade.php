@extends('layouts.user_type.auth')

@section('content')
    <!-- Modal -->
    @if (isset($_GET['id']))
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Reply</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ Form::open(['route' => 'create.comment', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="comment" class="col-form-label">Comment:</label>
                            <input type="text" required class="form-control" value="" name="comment" id="comment">
                            <input type="text" required class="form-control" value="{{ $_GET['id'] }}" name="blog_id"
                                id="blog_id" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Reply</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endif


    <!-- Modal -->
    <div class="modal fade" id="bannerImages" tabindex="-1" role="dialog" aria-labelledby="bannerImagesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="bannerImagesLabel">New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['route' => 'create.blog', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="image" placeholder="Choose image" id="bannerimage" hidden>
                        </div>
                    </div>
                    <label for="bannerimage" class="text-center" style="width: 100%">

                        <div class="col-md-12 mb-2 imagePreviewWrapper">
                            <img id="bannerimagepreview" src="../assets/img/default/images.png" alt="preview image"
                                style="max-height: 150px;">
                        </div>
                    </label>
                    <div class="form-group">
                        <label for="heading" class="col-form-label">Heading:</label>
                        <input type="text" required class="form-control" value="" name="heading" id="heading">
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea type="text" required class="form-control" value="" name="description" id="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Post</button>
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        @if (isset($_GET['id']))
            <div class="container-fluid">
                @if ($oneBlog->image == '/storage/images/blog/')
                    <br>
                    <br>
                @endif
                @if ($oneBlog->image != '/storage/images/blog/')
                    <a href="{{ env('APP_URL') . $oneBlog->image }}" target="_blank">
                        <div class="page-header min-height-600 border-radius-xl mt-4"
                            style="background-image: url('{{ env('APP_URL') . $oneBlog->image }}'); background-position-y: 50%;">
                            <span class="mask opacity-6"></span>
                        </div>
                    </a>
                @endif
                <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                    <div class="row gx-4">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <div class="d-flex text-capitalize align-items-center bg-gradient-primary justify-content-between text-bold border-radius-sm"
                                    style="width: 60px; height: 60px; font-size: 30px;">
                                    {{ substr($oneBlog->sendEmail, 0, 1) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h3 class="mb-1">
                                    {{ $oneBlog->sendEmail }}
                                </h3>
                                <small class="mb-1">
                                    <i>
                                        {{ $oneBlog->created_at->diffForHumans() }}
                                    </i>
                                </small>
                                <h5 class="mb-1">
                                    {{ $oneBlog->heading }}
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    {{ $oneBlog->description }}
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                    <li class="nav-item">

                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            comment
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
        <div class="container-fluid py-4">
            <div class="row">
                @if (isset($_GET['id']))
                    <div class="col-12 col-xl-12">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Comments</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    @foreach ($comments as $comment)
                                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">

                                            <div class="avatar me-3">
                                                <div class="d-flex text-capitalize align-items-center bg-gradient-primary justify-content-between text-bold border-radius-sm"
                                                    style="width: 50px; height: 50px; font-size: 30px;">
                                                    {{ substr($comment['individual']->email, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-start flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $comment['individual']->email }}</h6>
                                                <small><i>{{ $comment['comment']->created_at->diffForHumans() }}</i></small>
                                                <p class="mb-0 text-xs">{{ $comment['comment']->comment }}</p>
                                            </div>
                                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Delete</a>
                                            <hr>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12 mt-4">
                    <div class="card mb-4">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-1">Blogs</h6>
                            <p class="text-sm">Here is the list of the blog posts</p>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                @foreach ($blogs as $blog)
                                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                        <div class="card card-blog card-plain">
                                            @if ($blog->image != '/storage/images/blog/')
                                                <div class="position-relative">
                                                    <a class="d-block shadow-xl border-radius-xl"
                                                        href="{{ env('APP_URL') . $blog->image }}" target="_blank">
                                                        <img src="{{ env('APP_URL') . $blog->image }}"
                                                            class="img-fluid shadow border-radius-xl">
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="card-body px-1 pb-0">
                                                <p class="text-gradient text-dark mb-2 text-sm">Blog ID
                                                    #{{ $blog->id }}</p>
                                                <p class="text-gradient text-dark mb-2 text-sm">
                                                    <i>
                                                        {{ $blog->created_at->diffForHumans() }}
                                                    </i>
                                                </p>
                                                <a href="javascript:;">
                                                    <h5>
                                                        {{ $blog->heading }}
                                                    </h5>
                                                </a>
                                                <p class="mb-4 text-sm">
                                                    @php
                                                        if (strlen($blog->description > 100)) {
                                                            $blog->description = substr($blog->description, 0, 100) . ' ...';
                                                        }
                                                    @endphp
                                                    {{ $blog->description }}
                                                </p>
                                                <a class="d-flex align-items-center justify-content-between"
                                                    href="/all-post?id={{ $blog->id }}">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm mb-0">View</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                    <div class="card h-100 card-plain border" data-bs-toggle="modal"
                                        data-bs-target="#bannerImages">
                                        <div class="card-body d-flex flex-column justify-content-center text-center">
                                            <a href="javascript:;">
                                                <i class="fa fa-plus text-secondary mb-3"></i>
                                                <h5 class=" text-secondary"> New Banner </h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth.footer')
        </div>
    </div>
@endsection

<style>
    .imagePreviewWrapper {
        width: 100%;
        height: 150px;
        display: block;
        cursor: pointer;
        margin: 0 auto 30px;
        background-size: cover;
        background-position: center center;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(e) {


        $('#bannerimage').change(function() {

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#bannerimagepreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });
</script>
