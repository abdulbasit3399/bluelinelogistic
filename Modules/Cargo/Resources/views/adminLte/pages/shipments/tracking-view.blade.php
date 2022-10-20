{{--  @extends('cargo::adminLte.layouts.blank')  --}}
@extends('cargo::adminLte.template.layout.layout')

@php
    $pageTitle =  __('cargo::view.tracking');
@endphp

@section('pageTitle', $pageTitle )

@section('page-type', 'page')

@section('styles')

@endsection

@section('content')
<br>
<br>
<br>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div id="shipments-tracking-page">
                <div id="shipments-tracking" class="widget bdaia-widget widget_mc4wp_form_widget">
                    <div class="widget-inner">
                        <form class="form" action="{{route('shipments.tracking')}}" method="GET">
                            <div class="bdaia-mc4wp-form-icon text-center">
                                <span class="bdaia-io text-primary" style="line-height: 0">
                                <svg style="width:auto" height="58px" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m57.123 31.247v13.63h-12.247v-13.63zm3.925-4h27.552l-8.625-15.99h-20.155zm-18.868-15.99h-20.159l-8.621 15.99h27.551zm2.783 15.99h12.073l-1.229-15.99h-9.615zm2.03 44.992a25.612 25.612 0 0 1 .486-4.979h-19.888a5.133 5.133 0 0 0 -5.127 5.127v1.432a5.133 5.133 0 0 0 5.127 5.127h20.3a25.46 25.46 0 0 1 -.897-6.707zm7.393 17.875a25.231 25.231 0 0 1 -5.032-7.169h-21.763a9.137 9.137 0 0 1 -9.127-9.127v-1.431a9.137 9.137 0 0 1 9.127-9.127h21.04a25.28 25.28 0 0 1 41.507-8.9c.214.214.418.434.623.654v-23.767h-29.638v15.63a2 2 0 0 1 -2 2h-16.247a2 2 0 0 1 -2-2v-15.63h-29.638v60.185h44.58c-.49-.421-.97-.856-1.432-1.318zm10.36-23.922a2.08 2.08 0 0 0 -2.08 2.08v7.933a2.08 2.08 0 1 0 4.16 0v-7.932a2.08 2.08 0 0 0 -2.08-2.08zm9.6 2.08v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm7.516 0v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm-17.112-2.08a2.08 2.08 0 0 0 -2.08 2.08v7.933a2.08 2.08 0 1 0 4.16 0v-7.932a2.08 2.08 0 0 0 -2.084-2.08zm9.6 2.08v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm7.516 0v7.933a2.08 2.08 0 1 1 -4.16 0v-7.932a2.08 2.08 0 0 1 4.16 0zm11.673 3.967a21.292 21.292 0 1 1 -21.3-21.292 21.292 21.292 0 0 1 21.292 21.292zm-6.716 0a14.576 14.576 0 1 0 -14.584 14.576 14.576 14.576 0 0 0 14.576-14.576zm29.934 37.387a6.864 6.864 0 0 1 -6.974 7.1 8.6 8.6 0 0 1 -6.214-2.785l-14.663-15.651a1 1 0 0 1 .023-1.391l.977-.977-3.057-3.057a25.493 25.493 0 0 0 6.036-6.044l3.061 3.061.977-.977a1 1 0 0 1 1.391-.023l15.651 14.656a8.624 8.624 0 0 1 2.784 6.088zm-4 .066a4.608 4.608 0 0 0 -1.52-3.233l-13.537-12.672-3.89 3.888 12.671 13.532a4.586 4.586 0 0 0 3.294 1.52 2.868 2.868 0 0 0 2.974-3.034z"/></svg>
                                </span>
                            </div>
{{--
                            <p class="bdaia-mc4wp-bform-p bd1-font"  >
                                {{ __('cargo::view.tracking_shipment') }}
                            </p>

                            <p class="bdaia-mc4wp-bform-p2 bd2-font" >
                                {{ __('cargo::view.enter_your_tracking_code') }}
                            </p>  --}}

                            <h5 class="text-dark text-center my-4">Please insert your tracking number to know your package progress!</h5>
                            <div class="px-4">
                            <div class="row">
                                <div class="col-11">
                                <input type="text" name="code" class="form-control" placeholder="{{__('cargo::view.example_SH00001')}}">
                                </div>
                                <div class="col-1">
                                    <input type="submit" class="btn btn-success" value="Track">
                                </div>
                            </div>
                            </div>
                            {{--  <div class="mc4wp-form-fields">
                                <p>
                                    <label >
                                        {{ __('cargo::view.enter_your_tracking_code') }}
                                    </label>

                                </p>
                                <p>
                                </p>
                            </div>  --}}
                        </form>
                    </div>
                </div>
            </div><!--#shipments-tracking-page -->
        </div>
    </div>
</div>
@endsection
