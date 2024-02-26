@extends('layouts.admin.app', ['title' => 'Users Management'])
@section('main')
    <x-feature.index>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => 'Users Management', 'route' => route('users.index')]]" />
        </x-slot:breadcrumb>

        <x-slot:search>
            <form method="GET" hx-get="{{ route('users.search') }}" hx-trigger="submit" hx-target="#search-results"
                hx-select="#search-results" class="search-form input-group">
                <input type="hidden" name="columns[]" value="name">
                <input type="hidden" name="model" value="user">
                <input type="search" name="search" class="form-control widget_input" placeholder="Search user"
                    hx-vals="#search-results">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </x-slot:search>


        <x-slot:actions>
            {{--  --}}
        </x-slot:actions>

        <x-slot:filter>
            {{-- <h5>Status</h5>
        <x-filter :route="route('search.certificate')" :columns="['status']" model="certificate" :options="$statuses" /> --}}
        </x-slot:filter>


        <x-slot:list>
            @forelse ($subscribers as $subscriber)
                <div class="col-md-6">
                    <div class="item lon new">
                        <div class="list_item ">
                            <figure class="align-middle"><a href="#"><img src="{{ favicon() }}"
                                        alt=""></a></figure>
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell !w-full">
                                        <h4><a href="{{ route('users.show', $subscriber) }}"
                                                class="f_500 t_color3">{{ $subscriber->name }}</a>
                                        </h4>
                                        <ul class="list-unstyled">
                                            <li class="p_color4">{{ $subscriber->phone }}</li>
                                            <li class="p_color4"> {{ $subscriber->workplace }} </li>
                                            <li class="">
                                                {{ \Carbon\Carbon::parse($subscriber->created_at)->format('l, j F Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="jobsearch-table-cell !w-full">
                                        <div class="jobsearch-job-userlist !float-start">
                                            <form action="{{ route('user.ban', $subscriber) }}" method="post"
                                                class="like-btn">
                                                @csrf
                                                <button type="submit">
                                                    @if ($subscriber->banned_at == null)
                                                        <i class="ti-na" title="@__('Ban')"></i>
                                                    @else
                                                        <i class="ti-check" title="@__('Unban')"></i>
                                                    @endif
                                                </button>
                                            </fo>
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
    </x-feature.index>
@endsection
