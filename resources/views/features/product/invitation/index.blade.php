@extends('layouts.subscriber.app', ['title' => @__('feature/invitation.title')])
@section('main')
    <x-feature.index>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => @__('feature/invitation.title'), 'route' => route('invitation.index')]]" />
        </x-slot:breadcrumb>

        <x-slot:search>
            <form method="GET" hx-get="{{ route('invitation.index') }}" hx-trigger="submit" hx-target="#search-results"
                hx-select="#search-results" class="search-form input-group">
                <input type="hidden" name="columns[]" value="first_name">
                <input type="hidden" name="columns[]" value="last_name">
                <input type="hidden" name="columns[]" value="email">
                <input type="hidden" name="model" value="invitation">
                <input type="search" name="search" class="form-control widget_input" placeholder="{{ __('Search') }}"
                    hx-vals="#search-results">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </x-slot:search>

        <x-slot:actions>
            @can('send invitation')
                <x-button type="link" href="{{ route('invitation.create') }}">
                    <i class="ti-plus"></i>
                    @__('feature/invitation.add')
                </x-button>
            @endcan
        </x-slot:actions>

        <x-slot:filter>
            {{-- Empty --}}
        </x-slot:filter>
        <x-slot:list>
            @forelse ($invitations as $invitation)
                <div class="col-md-6">
                    <div class="item lon new">
                        <div class="list_item">
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell">
                                        <h4><a href="#" class="f_500 t_color3">{{ $invitation->first_name }}
                                                {{ $invitation->last_name }}</a>
                                        </h4>
                                        <ul class="list-unstyled">
                                            <li class="p_color4">{{ $invitation->email }}</li>
                                            <li class="p_color4">{{ $invitation->phone }}</li>
                                            <li class="p_color4">{{ $invitation->position }}</li>
                                            <li class="p_color4">{{ $invitation->role }}</li>
                                            <li class="p_color4">
                                                {{ $invitation->accepted_at == null ? __('Not Accepted yet') : __('Accepted') . ' : ' . Carbon\Carbon::parse($invitation->accepted_at)->diffForHumans() }}
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="jobsearch-table-cell">
                                        <div class="jobsearch-job-userlist">
                                            <div class="like-btn">
                                                <form
                                                    action="{{ route('invitation.destroy', ['invitation' => base64_encode($invitation->id)]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="shortlist" title="Delete">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                            <div class="like-btn">
                                                <a href="{{ route('invitation.edit', ['invitation' => $invitation]) }}"
                                                    class="shortlist" title="Edit">
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
            @empty
                <x-feature.not-found />
            @endforelse
        </x-slot:list>
    </x-feature.index>
@endsection
