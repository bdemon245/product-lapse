@extends('layouts.subscriber.app', ['title' => @__('Support ticket List')])
@section('main')
    <x-feature.index>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => @__('Support ticket List'), 'route' => route('support.index')]]" />
        </x-slot:breadcrumb>
        <x-slot:search>
            <form method="GET" hx-get="{{ route('support.search') }}" hx-trigger="submit" hx-target="#search-results"
                hx-select="#search-results" class="search-form input-group">
                <input type="hidden" name="columns[]" value="name">
                <input type="hidden" name="columns[]" value="classification">
                <input type="hidden" name="model" value="support">
                <input type="search" name="search" class="form-control widget_input"
                    placeholder="{{ __('Search for ticket') }}" hx-vals="#search-results">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </x-slot:search>
        <x-slot:actions>
            @can('create support')
                <x-button type="link" href="{{ route('support.create') }}">
                    <i class="ti-plus"></i>
                    @__('Add ticket')
                </x-button>
            @endcan
        </x-slot:actions>
        <x-slot:filter>
            <x-my-filter :route="route('support.search')" :columns="['administrator']" model="support" />
            <h5>@__('Status')</h5>
            <x-filter :route="route('support.search')" :columns="['status']" model="support" :options="$statuses" />
        </x-slot:filter>

        <x-slot:list>
            @forelse ($supports as $support)
                <div class="col-md-6">
                    <div class="item lon new">
                        <div class="list_item">
                            <figure><a href="#"><img src="{{ favicon($support->image) }}" alt=""></a></figure>
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell">
                                        <h4><a href="{{ route('support.show', $support) }}"
                                                class="f_500 t_color3">{{ $support->name }}</a>
                                        </h4>
                                        <ul class="list-unstyled">
                                            @include('components.feature-select-list', [
                                                'model' => $support,
                                            ])
                                            <li>
                                                {{ \Carbon\Carbon::parse($support->created_at)->format('l, j F Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="jobsearch-table-cell">
                                        <div class="jobsearch-job-userlist">
                                            @can('delete support')
                                                <div class="like-btn">
                                                    <x-button type="delete" :action="route('support.destroy', $support)" :has-icon="true">
                                                        <span class="ti-trash"></span>
                                                    </x-button>
                                                </div>
                                            @endcan
                                            @can('update support')
                                                <div class="like-btn">
                                                    <a href="{{ route('support.edit', $support) }}" class="shortlist"
                                                        title="Edit">
                                                        <i class="ti-pencil"></i>
                                                    </a>
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
            {!! $supports->links() !!}
        </x-slot:pagination>

    </x-feature.index>
@endsection
