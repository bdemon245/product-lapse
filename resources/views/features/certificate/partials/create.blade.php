@extends('layouts.subscriber.app', ['title' => @__('feature/certificate.add')])
@section('main')
    <x-feature.create>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => @__('feature/certificate.add'), 'route' => route('certificate.create')]]" />
        </x-slot:breadcrumb>

        <x-slot:from>

            @if ($certificate == !null)
                @if ($certificate->status == 'approved' && $certificate->achieved_id == auth()->id())
                    <div class="certificate-1 mx-auto my-auto p-3"
                    style="display: flex; justify-content: center; align-items: center;"><img
                        src="{{ asset('img/logo.png') }}"></div>
                    <div id="p1" style="overflow: hidden; position: relative; background-color: white;">
                        <h1 class="text-center p-2">{{ $certificate->company }}</h1>
                        <h6 class="text-center p-2"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit facere, earum odit ut laudantium doloremque similique id provident voluptatem minima doloribus at vel ducimus culpa labore. Aliquid, dolorem. Corrupti, libero. </h6>
                        <h4 class="text-center p-2">{{ $certificate->name }}</h4>

                    </div>
                    <div class="d-flex justify-content-center align-items-center text-center">
                        <button type="submit" class="btn_hover agency_banner_btn btn-bg">@__('feature/certificate.share')</button>

                    </div>
                @elseif ($certificate->status == 'rejected')
                    <div class="certificate-1" style="display: flex; justify-content: center; align-items: center;"><img
                            src="{{ asset('img/logo.png') }}"></div>
                    <div class="certificate-text">
                        <p style="display: flex; justify-content: center; align-items: center;">
                            <span>@__('feature/certificate.others.cancel')</span>
                        </p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center text-center certificate-btns">
                        <x-button type="link" href="{{ route('product.index') }}"
                            class="btn_hover agency_banner_btn btn-bg">@__('feature/certificate.others.back')</x-button>

                    </div>
                    <div class="certificate-terms" style="display: flex; justify-content: center; align-items: center;">
                        <a href="#" data-toggle="modal" data-target="#cancleSubmission">@__('feature/certificate.others.status')</a>
                    </div>
                @elseif($certificate->status == 'pending')
                    <div class="certificate-1" style="display: flex; justify-content: center; align-items: center;"><img
                            src="{{ asset('img/logo.png') }}"></div>
                    <div class="certificate-text">
                        <p style="display: flex; justify-content: center; align-items: center;">
                            <span>@__('feature/certificate.others.waiting')</span>
                        </p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center text-center certificate-btns">
                        <x-button type="link" href="{{ route('product.index') }}"
                            class="btn_hover agency_banner_btn btn-bg">@__('feature/certificate.others.back')</x-button>

                    </div>
                    <div class="certificate-terms" style="display: flex; justify-content: center; align-items: center;">
                        <a href="#" data-toggle="modal" data-target="#subMission">@__('feature/certificate.others.status')</a>
                    </div>
                @endif
            @else
                <h2 class=" f_600 f_size_24 t_color3 mb_40">@__('feature/certificate.add')</h2>
                <form action="{{ route('certificate.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="text" value="{{ auth()->id() }}" name="achieved_id" class="d-none">
                        <div class="form-group text_box col-lg-6 col-md-6">
                            <x-input-label for="name" value="{{ __('feature/certificate.label.name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text"
                                placeholder="{{ __('feature/certificate.label.name') }}" name="name" :value="old('name')"
                                required autofocus />
                        </div>
                        <div class="form-group text_box col-lg-6 col-md-6">
                            <x-input-label for="company" value="{{ @__('feature/certificate.label.company') }}" />
                            <x-input id="company" class="block mt-1 w-full" type="text"
                                placeholder="{{ __('feature/certificate.placeholder.company') }}" name="company"
                                :value="old('company_name')" required autofocus />
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-center">
                        <x-button type="submit">
                            @__('feature/certificate.submit')
                        </x-button>
                </form>
                </div>
            @endif
        </x-slot:from>
    </x-feature.create>

    <!-- The Modal -->
    <div class="modal fade " id="subMission">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">@__('feature/certificate.modal.get')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <ul class="certificate-conditions">
                        <li class="text-success">@__('feature/certificate.modal.status')</li>
                        <li>@__('feature/certificate.modal.msg')</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade " id="cancleSubmission">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">@__('feature/certificate.modal.get')</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <ul class="certificate-conditions">
                        <li class="text-success">@__('feature/certificate.modal.status')</li>
                        <li class="text-danger">@__('feature/certificate.modal.but')</li>
                        <li>@__('feature/certificate.modal.fullfill')</li>
                        <li>@__('feature/certificate.modal.msg')</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
