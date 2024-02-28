@extends('layouts.subscriber.app', ['title' => @__('profile.profile.info')])
@section('main')
    <x-feature.create>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => @__('profile.profile.info'), 'route' => route('product.info')]]" />
        </x-slot:breadcrumb>
        <x-slot:from>
            {{-- {{ dd($user) }} --}}
            <section class="sign_in_area bg_color sec_pad">
                <div class="container">
                    <div class="study_details">
                        <div class="row">
                            <div class="col-md-5 col-sm-3">
                                <div class="details_img">
                                    <img class="rounded-circle" style="height: 20rem; width:20rem;"
                                        src="{{ $user->image->url ?? avatar($user->name) }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-9">
                                <div class="details_info details_info2">
                                    <h2>{{ $user->name }}</h2>
                                    <ul class="list-unstyled profile-details">
                                        @if ($user->getRole() != null)
                                            <li class="!flex items-center gap-2">
                                                <img src="{{ asset('img/check.png') }}" />
                                                <div class="capitalize">{{ $user->roles->first()?->name }}</div>
                                            </li>
                                        @endif
                                        @if ($user->activePlan()->first() != null)
                                            <li><span>{{ $user->activePlanName() }}</span></li>
                                            <li><a href="#"><img
                                                        src="{{ asset('img/crown.png') }}">@__('profile.profile.upgrade')</a>
                                        @endif
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li><span>@__('profile.profile.email') :</span>{{ $user->email }}</li>
                                        <li><span>@__('profile.profile.phone') :</span> <span
                                                class="profile-num">{{ $user->phone }}</span></li>
                                        @if ($user->type == 'member')
                                            <li><span>@__('profile.profile.employer') :</span> {{ $user->owner?->name }}</li>
                                        @endif
                                    </ul>
                                    <div class="btn_info d-flex">
                                        <x-button type="link" href="{{ route('profile.edit') }}"
                                            class="btn_hover agency_banner_btn btn-bg">@__('profile.profile.edit')</x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </x-slot:from>
    </x-feature.create>
@endsection
