@extends('layouts.feature.index', ['title' => 'Edit Change Request'])
@section('main')
<x-feature.edit>
    <x-slot:breadcrumb>
        <x-breadcrumb :list="[['label' => 'Edit Change Request', 'route' => route('change.edit', $change)]]" />
    </x-slot:breadcrumb>

    <x-slot:from>
        <h2 class=" f_600 f_size_24 t_color3 mb_40">Edit Change Request</h2>
            <form action="{{ route('change.update', base64_encode($change->id)) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group text_box col-lg-6 col-md-6">
                        <x-input-label for="title" value="Change request title" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text"
                            placeholder="Enter change request title" name="title" value="{{ $change->title }}" required
                            autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="form-group text_box col-lg-6 col-md-6">
                        <x-select-input label="Classification" id="classification" placeholder="Choose one"
                            name="classification" required autofocus>
                            <option value="Free">Free</option>
                            <option value="Basic">Basic</option>
                            <option value="Golden">Golden</option>
                            <option value="Dimond">Dimond</option>
                        </x-select-input>
                    </div>
                    <div class="form-group text_box col-lg-6 col-md-6">
                        <x-select-input label="Priority" id="priority" placeholder="Choose one" name="priority" required
                            autofocus>
                            <option value="Free">Free</option>
                            <option value="Basic">Basic</option>
                            <option value="Golden">Golden</option>
                            <option value="Dimond">Dimond</option>
                        </x-select-input>
                    </div>
                    <div class="form-group text_box col-lg-6 col-md-6">
                        <x-select-input label="Status" id="status" placeholder="Choose one" name="status" required
                            autofocus>
                            <option value="Free">Free</option>
                            <option value="Basic">Basic</option>
                            <option value="Golden">Golden</option>
                            <option value="Dimond">Dimond</option>
                        </x-select-input>
                    </div>
                    <div class="form-group text_box col-lg-12 col-md-6">
                        <x-textarea label="Details" name="details" placeholder="Write details..."
                            value="{{ $change->details }}" />
                    </div>
                    <div class="form-group text_box col-lg-6 col-md-6">
                        <x-input-label for="administrator" value="Administrator" />
                        <x-text-input id="administrator" class="block mt-1 w-full" type="text"
                            placeholder="Administrator" name="administrator" value="{{ $change->administrator }}" required
                            autofocus />
                        <x-input-error :messages="$errors->get('administrator')" class="mt-2" />
                    </div>
                    <div class="form-group text_box col-lg-6 col-md-6">
                        <x-input-label for="required_completion_date" value="Required Completion Date" />
                        <x-text-input id="required_completion_date" class="block mt-1 w-full" type="date"
                            name="required_completion_date"
                            value="{{ \Carbon\Carbon::parse($change->required_completion_date)->format('Y-m-d') }}" required
                            autofocus />

                        <x-input-error :messages="$errors->get('required_completion_date')" class="mt-2" /> 
                    </div>
                </div>

                <div class="d-flex align-items-center text-center">
                    <x-button type="submit" class="mr-2">
                        Edit Change Request
                    </x-button>
                    <x-button hx-get="{{ route('change.index') }}" hx-push-url="true" hx-target="#hx-global-target"
                        hx-select="#hx-global-target">
                        Cancel
                    </x-button>
                </div>
            </form>
    </x-slot:from>

</x-feature.edit>
@endsection
