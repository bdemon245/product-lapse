@extends('layouts.subscriber.app', ['title' => @__('feature/release.title')])
@section('main')
    <x-feature.index>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => @__('feature/release.title'), 'route' => route('release.index')]]" />
        </x-slot:breadcrumb>
        <x-slot:search>
            <form method="GET" hx-get="{{ route('release.search') }}" hx-trigger="submit" hx-target="#search-results"
                hx-select="#search-results" class="search-form input-group">
                <input type="hidden" name="columns[]" value="name">
                <input type="hidden" name="columns[]" value="version">
                <input type="hidden" name="model" value="release">
                <input type="search" name="search" class="form-control widget_input"
                    placeholder="{{ __('feature/release.search') }}" hx-vals="#search-results">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </x-slot:search>

        <x-slot:actions>
            @can('create release')
                <x-button type="link" href="{{ route('release.create') }}">
                    <i class="ti-plus"></i>
                    @__('feature/release.add')
                </x-button>
            @endcan
        </x-slot:actions>

        <x-slot:filter>
            {{-- Empty --}}
        </x-slot:filter>


        <x-slot:list>
            @forelse ($releases as $release)
                <div class="col-md-6">
                    <div class="item lon new">
                        <div class="list_item">
                         <figure><a href="#"><img src="{{ favicon($release->image) }}" alt=""></a></figure>
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell">
                                        <h4><a href="{{ route('release.show', $release) }}"
                                                class="f_500 t_color3">{{ $release->name }}</a></h4>
                                        <ul class="list-unstyled">
                                            <li class="p_color1">{{ $release->version }}</li>
                                            <li>More text about product</li>
                                        </ul>
                                    </div>
                                    <div class="jobsearch-table-cell">
                                        <div class="jobsearch-job-userlist">

                                            @can('delete release')
                                                <div class="like-btn">
                                                    <x-button type="delete" :action="route('release.destroy', $release)" :has-icon="true">
                                                        <span class="ti-trash"></span>
                                                    </x-button>
                                                </div>
                                            @endcan

                                            @can('update release')
                                                <div class="like-btn">
                                                    <x-btn-icons type="anchor" value="<i class='ti-pencil'></i>"
                                                        href="{{ route('release.edit', $release) }}" />
                                                </div>
                                            @endcan

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <x-feature.not-found />
            @endforelse
        </x-slot:list>
        <x-slot:pagination>
            {!! $releases->links() !!}
        </x-slot:pagination>
    </x-feature.index>
@endsection
