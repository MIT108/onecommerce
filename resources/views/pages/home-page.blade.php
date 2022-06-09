@extends('layouts.user_type.auth')

@section('content')
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">

                <div class="col-12 mt-4">
                    <div class="card mb-4">
                        {{-- modal --}}
                        <!-- Modal -->
                        <div class="modal fade" id="bannerImages" tabindex="-1" role="dialog"
                            aria-labelledby="bannerImagesLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal" id="bannerImagesLabel">New Banner</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {{ Form::open(['route' => 'add.banner', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

                                    <div class="modal-body">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="file" required name="image" placeholder="Choose image"
                                                    id="bannerimage" hidden>
                                            </div>
                                        </div>
                                        <label for="bannerimage" class="text-center" style="width: 100%">

                                            <div class="col-md-12 mb-2 imagePreviewWrapper">
                                                <img id="bannerimagepreview" src="../assets/img/default/images.png"
                                                    alt="preview image" style="max-height: 150px;">
                                            </div>
                                        </label>
                                        <div class="form-group">
                                            <label for="heading" class="col-form-label">Heading:</label>
                                            <input type="text" required class="form-control" value="" name="heading"
                                                id="heading">
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description:</label>
                                            <input type="text" required class="form-control" value="" name="description"
                                                id="description">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Add</button>
                                    </div>
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>

                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-1">Banner Images</h6>
                            <p class="text-sm">Add your banner images here</p>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                @foreach ($banners as $banner)
                                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                        <div class="card card-blog card-plain">
                                            <div class="position-relative">
                                                <a class="d-block shadow-xl border-radius-xl" target="_blank"
                                                    href="{{ env('APP_URL') . $banner->image }}">
                                                    <img src="{{ env('APP_URL') . $banner->image }}" alt="img-blur-shadow"
                                                        class="img-fluid shadow border-radius-xl" max-height="10">
                                                </a>
                                            </div>
                                            <div class="card-body px-1 pb-0">
                                                <p class="text-gradient text-dark mb-2 text-sm">Banner #{{ $banner->id }}
                                                </p>
                                                <a href="javascript:;">
                                                    <h5>
                                                        {{ $banner->heading }}
                                                    </h5>
                                                </a>
                                                <p class="mb-4 text-sm">
                                                    {{ $banner->description }}
                                                </p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm mb-0">Delete</button>
                                                </div>
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
                <div class="col-12 col-xl-6">

                    <div class="card card-profile card-plain">
                        <div class="row">

                            {{-- modal --}}
                            <!-- Modal -->
                            <div class="modal fade" id="Image1" tabindex="-1" role="dialog"
                                aria-labelledby="Image1Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="Image1Label">New Banner
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        {{ Form::open(['route' => 'modify.home.images', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

                                        <div class="modal-body">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="file" required name="image" placeholder="Choose image"
                                                        id="image1" hidden>
                                                </div>
                                            </div>
                                            <label for="image1" class="text-center" style="width: 100%">

                                                <div class="col-md-12 mb-2 imagePreviewWrapper">
                                                    <img id="image1preview" src="{{ env('APP_URL') . $image1->image }}"
                                                        alt="preview image" style="max-height: 150px;">
                                                </div>
                                            </label>
                                            <div class="form-group">
                                                <label for="heading" class="col-form-label">Heading:</label>
                                                <input type="text" required class="form-control"
                                                    value="{{ $image1->heading }}" name="heading" id="heading">
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-form-label">Description:</label>
                                                <input type="text" required class="form-control"
                                                    value="{{ $image1->description }}" name="description"
                                                    id="description">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required class="form-control" hidden
                                                    value="{{ $image1->id }}" name="id" id="description">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn bg-gradient-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn bg-gradient-primary">Modify</button>
                                        </div>
                                        {{ Form::close() }}

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <a href="javascript:;">
                                    <div class="position-relative">
                                        <div class="blur-shadow-image">
                                            <a href="{{ env('APP_URL') . $image1->image }}" target="_blank">
                                                <img class="w-100 rounded-3 shadow-lg"
                                                    src="{{ env('APP_URL') . $image1->image }}">
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-7 ps-0 my-auto">
                                <div class="card-body text-left">
                                    <div class="p-md-0 pt-3">
                                        <h5 class="font-weight-bolder mb-0">{{ $image1->heading }}</h5>
                                    </div>
                                    <p class="mb-4">{{ $image1->description }}</p>

                                    <button type="button" data-bs-toggle="modal" data-bs-target="#Image1"
                                        class="btn btn-outline-primary btn-sm mb-0">Modify</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">

                    <div class="card card-profile card-plain">

                        {{-- modal --}}
                        <!-- Modal -->
                        <div class="modal fade" id="Image2" tabindex="-1" role="dialog" aria-labelledby="Image2Label"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal" id="Image2Label">New Banner</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {{ Form::open(['route' => 'modify.home.images', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

                                    <div class="modal-body">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="file" required name="image" placeholder="Choose image"
                                                    id="image2" hidden>
                                            </div>
                                        </div>
                                        <label for="image2" class="text-center" style="width: 100%">

                                            <div class="col-md-12 mb-2 imagePreviewWrapper">
                                                <img id="image2preview" src="{{ env('APP_URL') . $image2->image }}"
                                                    alt="preview image" style="max-height: 150px;">
                                            </div>
                                        </label>
                                        <div class="form-group">
                                            <label for="heading" class="col-form-label">Heading:</label>
                                            <input type="text" required class="form-control"
                                                value="{{ $image2->heading }}" name="heading" id="heading">
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description:</label>
                                            <input type="text" required class="form-control"
                                                value="{{ $image2->description }}" name="description" id="description">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required class="form-control" hidden
                                                value="{{ $image2->id }}" name="id" id="description">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Modify</button>
                                    </div>
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <a href="javascript:;">
                                    <div class="position-relative">
                                        <div class="blur-shadow-image">
                                            <a href="{{ env('APP_URL') . $image2->image }}" target="_blank">
                                                <img class="w-100 rounded-3 shadow-lg"
                                                    src="{{ env('APP_URL') . $image2->image }}">
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-7 ps-0 my-auto">
                                <div class="card-body text-left">
                                    <div class="p-md-0 pt-3">
                                        <h5 class="font-weight-bolder mb-0">{{ $image2->heading }}</h5>
                                    </div>
                                    <p class="mb-4">{{ $image2->description }}</p>

                                    <button type="button" data-bs-toggle="modal" data-bs-target="#Image2"
                                        class="btn btn-outline-primary btn-sm mb-0">Modify</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="card mb-4">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-1">Projects</h6>
                            <p class="text-sm">Architects design houses</p>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                    <div class="card card-blog card-plain">
                                        <div class="position-relative">
                                            <a class="d-block shadow-xl border-radius-xl">
                                                <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow"
                                                    class="img-fluid shadow border-radius-xl">
                                            </a>
                                        </div>
                                        <div class="card-body px-1 pb-0">
                                            <p class="text-gradient text-dark mb-2 text-sm">Project #2</p>
                                            <a href="javascript:;">
                                                <h5>
                                                    Modern
                                                </h5>
                                            </a>
                                            <p class="mb-4 text-sm">
                                                As Uber works through a huge amount of internal management turmoil.
                                            </p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                                    Project</button>
                                                <div class="avatar-group mt-2">
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Elena Morison">
                                                        <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Ryan Milly">
                                                        <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Nick Daniel">
                                                        <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Peterson">
                                                        <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                    <div class="card card-blog card-plain">
                                        <div class="position-relative">
                                            <a class="d-block shadow-xl border-radius-xl">
                                                <img src="../assets/img/home-decor-2.jpg" alt="img-blur-shadow"
                                                    class="img-fluid shadow border-radius-lg">
                                            </a>
                                        </div>
                                        <div class="card-body px-1 pb-0">
                                            <p class="text-gradient text-dark mb-2 text-sm">Project #1</p>
                                            <a href="javascript:;">
                                                <h5>
                                                    Scandinavian
                                                </h5>
                                            </a>
                                            <p class="mb-4 text-sm">
                                                Music is something that every person has his or her own specific opinion
                                                about.
                                            </p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                                    Project</button>
                                                <div class="avatar-group mt-2">
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Nick Daniel">
                                                        <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Peterson">
                                                        <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Elena Morison">
                                                        <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Ryan Milly">
                                                        <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                    <div class="card card-blog card-plain">
                                        <div class="position-relative">
                                            <a class="d-block shadow-xl border-radius-xl">
                                                <img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow"
                                                    class="img-fluid shadow border-radius-xl">
                                            </a>
                                        </div>
                                        <div class="card-body px-1 pb-0">
                                            <p class="text-gradient text-dark mb-2 text-sm">Project #3</p>
                                            <a href="javascript:;">
                                                <h5>
                                                    Minimalist
                                                </h5>
                                            </a>
                                            <p class="mb-4 text-sm">
                                                Different people have different taste, and various types of music.
                                            </p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button type="button" class="btn btn-outline-primary btn-sm mb-0">View
                                                    Project</button>
                                                <div class="avatar-group mt-2">
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Peterson">
                                                        <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Nick Daniel">
                                                        <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Ryan Milly">
                                                        <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                                    </a>
                                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Elena Morison">
                                                        <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                    <div class="card h-100 card-plain border">
                                        <div class="card-body d-flex flex-column justify-content-center text-center">
                                            <a href="javascript:;">
                                                <i class="fa fa-plus text-secondary mb-3"></i>
                                                <h5 class=" text-secondary"> New project </h5>
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
    $(document).ready(function(e) {


        $('#image2').change(function() {

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#image2preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });
    $(document).ready(function(e) {



        $('#image1').change(function() {

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#image1preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });
</script>
