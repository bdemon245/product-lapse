@extends('layouts.frontend.app')


@section('main')
    <x-breadcrumb :list="[
        [
            'label' => __('Compare Packages'),
            'route' => route('package.compare'),
        ],
    ]">

    </x-breadcrumb>
    <section class="pricing_area_four sec_pad">
        <div class="container">
            <div class="price_info_two price_info_three">
                <div class="price_head">
                    <div class="p_head time">
                        <h4>@__('Packages')</h4>
                    </div>
                    @foreach ($packages as $package)
                        <div class="p_head">
                            <h5>{{ $package->name->{app()->getLocale()} }}</h5>
                            <p>{{ $package->price }} / @__('welcome.price')</p>
                        </div>
                    @endforeach
                </div>
                <div class="price_body">

                    @foreach ($packageFeatures as $feature)
                        <div class="pr_list">
                            <div class="price_item">
                                <h5 class="pr_title">{{ $feature->name->{app()->getLocale()} }}</h5>
                            </div>

                            @foreach ($packages as $p)
                                <div class="price_item" data-title="{{ $package->name->{app()->getLocale()} }}">
                                    @if ($p->activeFeatures()->find($feature->id))
                                        <h5 class="check"><i class="icon_check_alt2"></i></h5>
                                    @else
                                        <h5 class="cros"><i class="icon_close"></i></h5>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="pr_list">

                        <div class="price_item">

                        </div>
                        @foreach ($packages as $p)
                            <div class="price_item" data-title="{{ $package->name->{app()->getLocale()} }}">
                                @if (auth()->user()?->activePackage()?->id == $package->id)
                                    <a href="#" class="price_btn btn_hover">
                                        <i class="ti-check"></i>
                                    </a>
                                @else
                                    @if (auth()->user()?->type == 'admin')
                                        <a href="#" class="price_btn btn_hover">@__('You are admin')</a>
                                    @elseif(auth()->user()?->type == 'member')
                                        <a href="#" class="price_btn btn_hover">@__('You are member')</a>
                                    @else
                                        <a href="{{ route('order.create', ['package' => $package]) }}"
                                            class="price_btn btn_hover">@lang('welcome.subscribe')</a>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center mt_30 packages-btn">
            <a href="packages.html" class="btn_hover agency_banner_btn btn-bg">Subscribe</a>
        </div>
    </section>
@endsection
