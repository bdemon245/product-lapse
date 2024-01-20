@extends('layouts.subscriber.app', ['title' => 'History'])
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/css/fileinput.min.css">
@endpush
@section('main')
    <section class="breadcrumb_area">
        <div class="container d-flex">
            <div class="breadcrumb_content text-center ml-auto">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Product History</li>
                </ul>
            </div>

        </div>
    </section>

    <section class="sign_in_area bg_color sec_pad">
        <div class="container">
            <div class="sign_info">
                <div class="login_info">
                    <div class="d-flex justify-content-between align-items-center mb_20">
                        <h2 class=" f_600 f_size_24 t_color3">Product history</h2>
                        <button type="submit" class="btn_hover agency_banner_btn btn-bg" style="margin: 0"
                            data-toggle="modal" data-target="#myModal"><i class="ti-plus"></i>New group</button>
                    </div>
                    <div class="tab-content faq_content" id="myTabContent">
                        @foreach ($productHistory as $history)
                            <div class="tab-pane fade show active" id="purchas{{ $history->id }}" role="tabpanel"
                                aria-labelledby="purchas-tab">
                                <div id="accordion{{ $history->id }}">
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapseTwo{{ $history->id }}" aria-expanded="false"
                                                    aria-controls="collapseTwo{{ $history->id }}">
                                                    {{ $history->date }}
                                                    <i class="ti-angle-down"></i><i class="ti-angle-up"></i>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo{{ $history->id }}" class="collapse"
                                            aria-labelledby="headingTwo" data-parent="#accordion{{ $history->id }}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 history-notes">
                                                        <button type="submit" class="btn_hover agency_banner_btn btn-bg"><i
                                                                class="ti-pencil"></i>Edit</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <h6 class="title2">Description</h6>
                                                        <p class="f_400 mb-30 text-font">
                                                            {{ $history->description }}
                                                        </p>
                                                    </div>
                                                    @if ($history->images)
                                                        @foreach ($history->images as $image)
                                                            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                                                <div class="product-history">
                                                                    <img src="{{ asset($image->path) }}">
                                                                    <h6>Rolex watch</h6>
                                                                    <a href="#"></a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('product-history.store', $id) }}" enctype="multipart/form-data"> @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add new group</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group text_box col-lg-12 col-md-12">
                                <label class=" text_c f_500">Date</label>
                                <input type="date" placeholder="date" name="date" required>
                            </div>
                            <div class="form-group text_box col-lg-12 col-md-12">
                                <label class=" text_c f_500">Description</label>
                                <textarea name="description" id="message" cols="30" rows="10" placeholder="Description" required></textarea>
                            </div>
                            <div class="form-group text_box col-lg-12 col-md-12">
                                <label class=" text_c f_500">Images</label>
                                <div class="verify-sub-box">
                                    <div class="file-loading">
                                        <input id="multiplefileupload" name="image[]" type="file" accept=".jpg,.gif,.png"
                                            multiple />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn_hover agency_banner_btn btn-bg agency_banner_btn2">Add</button>
                        {{-- <button type="button" class="btn_hover agency_banner_btn btn-bg btn-bg-grey"
                            data-dismiss="modal">Cancel</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/js/fileinput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/js/plugins/sortable.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/themes/fas/theme.min.js"></script>
        <script>
            // ----------multiplefile-upload---------
            $("#multiplefileupload").fileinput({
                'theme': 'fa',
                'uploadUrl': '#',
                showRemove: false,
                showUpload: false,
                showZoom: false,
                showCaption: false,
                browseClass: "btn btn-danger",
                browseLabel: "",
                browseIcon: "<i class='ti ti-plus'></i>",
                overwriteInitial: false,
                initialPreviewAsData: true,
                fileActionSettings: {
                    showUpload: false,
                    showZoom: false,
                    removeIcon: "<i class='ti ti-close'></i>",
                }
            });
        </script>
    @endpush
@endsection