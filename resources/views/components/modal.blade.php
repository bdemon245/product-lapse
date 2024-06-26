@props(['title' => null, 'label' => 'Toggle Modal'])

@php
    $modalID = $attributes->has('id') ? $attributes->get('id') : uniqid('modal-');
@endphp

<div>
    @empty($trigger)
        <!-- Modal trigger -->
        <button type="button" class="button-1 btn-bg-1" data-toggle="modal" data-target="#{{ $modalID }}">
            @__($label)
        </button>
    @else
        {!! $trigger !!}
    @endempty


    <div class="modal fade" id="{{ $modalID }}" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                @empty($header)
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $title }}</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                @else
                    {!! $header !!}
                @endempty

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid">
                        {!! $slot !!}
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    @empty($footer)
                        <!-- Modal Header -->
                        <button
                            @if (request()->routeIs('idea.show')) type="button" data-dismiss="modal" 
                        @else
                        type="submit" @endif
                            class="btn_hover agency_banner_btn btn-bg agency_banner_btn2">@__('Save')</button>
                        <button type="button" class="btn_hover agency_banner_btn btn-bg btn-bg-grey"
                            data-dismiss="modal">@__('Cancel')</button>
                    @else
                        {!! $footer !!}
                    @endempty
                </div>

            </div>
        </div>
    </div>
</div>
