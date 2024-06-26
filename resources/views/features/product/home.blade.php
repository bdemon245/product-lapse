@extends('layouts.subscriber.app', ['title' => @__('Product')])
@section('main')
    <x-breadcrumb />
    <section class="sign_in_area bg_color sec_pad" style="padding-top: 20px">
        <div class="container">
            <div class="row align-items-center mb_20">
                <div class="col-lg-12 col-md-12 products-order2">
                    <div class="shop_menu_left d-flex align-items-center justify-content-end">
                        <h5>@__('Product')</h5>
                        <form id="product-filter-form" method="get" action="{{ route('product.show',$product) }}">
                            <select id="product-select" class="selectpickers selectpickers2">
                                @forelse ($products as $item)
                                    <option value="{{ $item->id }}" @selected(request()->product_id == $item->id || $product->id == $item->id)>{{ $item->name }}</option>
                                @empty
                                    <option disabled>@__('productHome.choose')</option>
                                @endforelse
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="job_listing job_listing2 job_listing3">
                <div class="listing_tab">
                    <div class="item lon new">
                        <div class="list_item">
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell">
                                        <h4 class="justify-between items-center">
                                            <a href="{{ route('product.info', $product->id) }}"
                                                class="f_500 t_color3">{{ $product->name }}</a>
                                            @can('update product')
                                                <form action="{{ route('product.edit', $product) }}" method="get">
                                                    <button type="submit" class="btn_hover agency_banner_btn btn-bg"><i
                                                            class="ti-pencil"></i>@__('productHome.edit')</button>
                                                </form>
                                            @endcan
                                        </h4>
                                        <ul class="list-unstyled">
                                            <li style="color: {{$product->getSelect('stage')?->color}}">{{ $product->getSelect('stage')?->value->{app()->getLocale()} }}</li>
                                            <li>{{ $product->description }}</li>
                                            <li><a href="{{ route('product.edit', $product->id) }}"
                                                    class="btn_hover agency_banner_btn btn-bg"><i class="ti-pencil"></i>
                                                    @__('productHome.edit')</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($features as $feature)
                {{-- {{ dd() }} --}}
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="box-item">
                            <span
                                class="box-item-num p-2 flex items-center justify-center {{ $feature['counter'] === null ? 'd-none' : '' }}">{{ $feature['counter'] > 999 ? '999+' : $feature['counter'] }}</span>
                            <a href="{{ $feature['route'] }}"></a>
                            <img style="margin:auto; margin-bottom:1rem;" src="{{ asset($feature['icon']) }}">
                            <h5 class="f_600 t_color2">@__($feature['name'])</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#product-select').on('change', function(e){
                console.log('changed')
                let value = e.target.value
                let url = "{{route('product.show', ':ID')}}";
                url = url.replace(':ID', value)
                $('#product-filter-form').attr('action', url)
                $('#product-filter-form').submit()
            })
        });
    </script>
@endpush
