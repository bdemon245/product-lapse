@extends('layouts.subscriber.app', ['title' => 'Select Items'])
@section('main')
    <x-feature.index>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => 'Select Items', 'route' => route('select.index')]]" />
        </x-slot:breadcrumb>
        <x-slot:search>
            <form action="#" class="search-form input-group">
                <input type="searproductch" class="form-control widget_input" placeholder="Search Select Items">
                <button type="submit"><i class="ti-search"></i></button>
            </form>

        </x-slot:search>

        <x-slot:actions>
            <x-button type="link" href="{{ route('select.create') }}">
                <i class="ti-plus"></i>
                Add Select Item
            </x-button>
        </x-slot:actions>
        <x-slot:filter>

        </x-slot:filter>

        <x-slot:list>
            @foreach ($selects as $select)
                <div class="col-md-6">
                    <div class="item lon new">
                        <div class="list_item">
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell">
                                        <h4 class="d-flex ">
                                            <span class="mr-2">(En)
                                                {{ $select->value->en }}</span> | 
                                            <span class="ml-2">(Ar) {{ $select->value->ar }}</span>
                                        </h4>
                                        <ul class="list-unstyled">
                                            <li class="p_color4">{{ $select->model_type }}</li>
                                            <li class="p_color4">{{ $select->type }}</li>
                                            <li > <input type="color" value="{{ $select->color }}" disabled /> </li>
                                        </ul>
                                    </div>
                                    <div class="jobsearch-table-cell">
                                        <div class="jobsearch-job-userlist">
                                            <div class="like-btn">
                                                <form action="{{ route('select.destroy', $select) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="shortlist" title="Delete">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                            <div class="like-btn">
                                                <a href="{{ route('select.edit', $select) }}" class="shortlist"
                                                    title="Edit">
                                                    <i class="ti-pencil"></i>
                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </x-slot:list>
    </x-feature.index>
@endsection
