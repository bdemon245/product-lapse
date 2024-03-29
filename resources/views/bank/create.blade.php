@extends('layouts.subscriber.app', ['title' => @__('Bank Transfer')])
@section('main')
    <x-feature.index>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => @__('Bank Transfer'), 'route' => route('change.index')]]" />
        </x-slot:breadcrumb>
        <x-slot:search>
            {{--  --}}
        </x-slot:search>

        <x-slot:actions>
            {{--  --}}
        </x-slot:actions>

        <x-slot:filter>
            {{--  --}}
        </x-slot:filter>

        <x-slot:list>
            <div class="container">
                <div class="sign_info">
                    <div class="login_info">
                        <h2 class=" f_600 f_size_24 t_color3 mb_40">@__('Bank account')</h2>
                        <form action="{{ route('bank.store', $order) }}" method="POST" class="login-form sign-in-form">
                            @csrf
                            <div class="row">
                                <div class="form-group text_box col-lg-4 col-md-12">
                                    <x-input-label for="id" value="{{ __('Bank Account ID:') }}" />
                                    <x-input id="id" class="block mt-1 w-full" type="text"
                                        placeholder="996587432156"  name="id" value="{{ $bank?->account_id ?? old('id')}}" required
                                        autofocus />
                                </div>
                                <div class="form-group text_box col-lg-4 col-md-12">
                                    <x-input-label for="name" value="{{ __('Bank Name:') }}" />
                                    <x-input id="name" class="block mt-1 w-full" type="text"
                                        placeholder="name" name="name" value="{{ $bank?->name ?? old('name')}}" required
                                        autofocus />
                                </div>
                                <div class="form-group text_box col-lg-4 col-md-12">
                                    <x-input-label for="iban" value="{{ __('Bank IBAN:') }}" />
                                    <x-input id="iban" class="block mt-1 w-full" type="text"
                                        placeholder="996587432156" name="iban" value="{{ $bank?->iban ?? old('iban')}}" required
                                        autofocus />
                                </div>
                                <div class="form-group text_box col-lg-12 col-md-12">
                                    <div class="extra extra2 extra3">
                                        <div class="media post_author post_author2">
                                            <div class="checkbox remember">
                                                <label class="d-flex">
                                                    <input type="checkbox"{{ $bank?->payment_receipt == null ? '' : 'checked'}}  name="payment_receipt">
                                                    <h5 class=" t_color3 f_size_18 f_500">@__('Payment receipt')</h5>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="payment-btns text-center flex items-center justify-center gap-3">
                                <button type="submit" class="btn_hover agency_banner_btn btn-bg">@__('Continue')</button>
                                <x-button type="link" href="{{ route('home') }}" class="btn_hover agency_banner_btn btn-bg btn-bg3">@__('Cancel')</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </x-slot:list>
        {{-- <x-slot:pagination>
            {!! $changes?->links() !!}
        </x-slot:pagination> --}}

    </x-feature.index>
@endsection
