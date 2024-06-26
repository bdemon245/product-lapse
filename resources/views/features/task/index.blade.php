@extends('layouts.subscriber.app', ['title' => @__('feature/task.title')])
@section('main')
    <x-feature.index>
        <x-slot:breadcrumb>
            <x-breadcrumb :list="[['label' => @__('feature/task.title'), 'route' => route('task.index')]]" />
        </x-slot:breadcrumb>
        <x-slot:search>


            <form method="GET" hx-get="{{ route('task.search') }}" hx-trigger="submit" hx-target="#search-results"
                hx-select="#search-results" class="search-form input-group">
                <input type="hidden" name="columns[]" value="name">
                <input type="hidden" name="columns[]" value="details">
                <input type="hidden" name="model" value="task">
                <input type="search" name="search" class="form-control widget_input"
                    placeholder="{{ __('feature/task.search') }}" hx-vals="#search-results">
                <button type="submit"><i class="ti-search"></i></button>
            </form>
        </x-slot:search>

        <x-slot:actions>
            @can('create task')
                <x-button href="{{ route('task.create') }}" type="link">
                    <i class="ti-plus"></i>
                    @__('feature/task.add')
                </x-button>
            @endcan
        </x-slot:actions>

        <x-slot:filter>
            <form action="{{ route('task.index') }}" class="flex" x-data="{ mvp: '{{ !empty(request()->query('mvp')) ? '' : 'true' }}' }">
                <label
                    class="inline-flex cursor-pointer items-center px-2 py-1 rounded {{ request()->query('mvp') == 'true' ? '!bg-primary text-white' : '!text-gray-500 bg-white border' }}">
                    <input onchange="this.form.submit()" class="hidden" type="checkbox" name="mvp"
                        :value="mvp" id="" />
                    <span class="mb-0">MVP</span>
                </label>
                {{-- <label
                    class="inline-flex cursor-pointer items-center px-2 py-1 rounded {{ request()->query('my_task') == 'true' ? '!bg-primary text-white' : '!text-gray-500 bg-white border' }} mx-4">
                    <input onchange="this.form.submit()" class="hidden" type="checkbox" value="true" name="my_task"
                        id="" />
                    <span class="mb-0">My Tasks</span>
                </label> --}}
            </form>
            <x-my-filter :route="route('task.search')" :columns="['administrator']" model="task" />

            <h5>@__('feature/task.showing2')</h5>
            <x-filter :route="route('task.search')" :columns="['status']" model="task" :options="$priorities" />
        </x-slot:filter>

        <x-slot:list>
            @forelse ($tasks as $task)
                <div class="col-md-6">
                    <div class="item lon new">
                        <div class="list_item">
                            <figure><a href="#"><img src="{{ favicon($task->image) }}" alt=""></a></figure>
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell">
                                        <h4><a href="{{ route('task.show', $task) }}"
                                                class="f_500 t_color3">{{ $task->name }}</a>
                                        </h4>
                                        <ul class="list-unstyled">
                                            @include('components.feature-select-list', ['model' => $task])
                                            <li class="text-muted">
                                                {{ \Carbon\Carbon::parse($task->created_at)->format('l, j F Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="jobsearch-table-cell">
                                        <div class="jobsearch-job-userlist">
                                            @can('delete task')
                                                <div class="like-btn">
                                                    <x-button type="delete" :action="route('task.destroy', $task)" :has-icon="true">
                                                        <span class="ti-trash"></span>
                                                    </x-button>
                                                </div>
                                            @endcan
                                            @can('update task')
                                                <div class="like-btn">
                                                    <a href="{{ route('task.edit', $task) }}" class="shortlist" title="Edit">
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
            {!! $tasks->links() !!}
        </x-slot:pagination>
    </x-feature.index>
@endsection
