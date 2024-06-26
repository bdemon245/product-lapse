@extends('layouts.subscriber.app', ['title' => @__('feature/change.title')])
@section('main')
    <x-feature.index>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => @__('feature/change.title'), 'route' => route('change.index')]]" />
        </x-slot:breadcrumb>
        <x-slot:search>
            <form method="GET" hx-get="{{ route('change.search') }}" hx-trigger="submit" hx-target="#search-results"
                hx-select="#search-results" class="search-form input-group">
                <input type="hidden" name="columns[]" value="title">
                <input type="hidden" name="columns[]" value="classification">
                <input type="hidden" name="model" value="change">
                <input type="search" name="search" class="form-control widget_input"
                    placeholder="{{ __('feature/change.search') }}" hx-vals="#search-results">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </x-slot:search>

        <x-slot:actions>
            @can('create change')
                <x-button type="link" href="{{ route('change.create') }}">
                    <i class="ti-plus"></i>
                    @__('feature/change.add')
                </x-button>
            @endcan
        </x-slot:actions>

        <x-slot:filter>
            <x-my-filter :route="route('change.search')" :columns="['administrator']" model="change" />

            <h5>@__('feature/change.showing')</h5>
            <x-filter :route="route('change.search')" :columns="['status']" model="change" :options="$statuses" />
        </x-slot:filter>

        <x-slot:list>
            @forelse ($changes as $change)
                <div class="col-md-6">
                    <div class="item lon new">
                        <div class="list_item">
                            <figure><a href="#"><img src="{{ favicon($change->image) }}" alt=""></a></figure>
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell">
                                        <h4><a href="{{ route('change.show', $change) }}"
                                                class="f_500 t_color3">{{ $change->title }}</a></h4>
                                        <ul class="list-unstyled">
                                            @include('components.feature-select-list', [
                                                'model' => $change,
                                            ])
                                            <li class="text-muted">
                                                {{ \Carbon\Carbon::parse($change->created_at)->format('l, j F Y') }}</li>
                                        </ul>
                                    </div>
                                    <div class="jobsearch-table-cell">
                                        <div class="jobsearch-job-userlist">
                                            @can('delete change')
                                                <div class="like-btn">
                                                    <x-button type="delete" :action="route('change.destroy', $change)" :has-icon="true">
                                                        <span class="ti-trash"></span>
                                                    </x-button>
                                                </div>
                                            @endcan

                                            @can('delete change')
                                                <div class="like-btn">
                                                    <x-btn-icons type="anchor" value="<i class='ti-pencil'></i>"
                                                        href="{{ route('change.edit', $change) }}" />
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
            {!! $changes->links() !!}
        </x-slot:pagination>

    </x-feature.index>
@endsection
