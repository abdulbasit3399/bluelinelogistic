@php
    $user_role = auth()->user()->role;
    $date_now = \Carbon\Carbon::now()->format('d-m-Y');

    $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.barcode_scanner') }}
@endsection

@section('content')
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <form id="kt_form_1" class="form" action="{{ fr_route('shipments.barcode.scanner.post') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>{{ __('cargo::view.barcode_scanner') }}:</label>
                        <input type="text" autocomplete="off" autofocus id="barcode" class="form-control" placeholder="{{ __('cargo::view.barcode') }}" name="barcode"/>
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ url()->previous() }}" class="btn btn-light btn-active-light-primary me-2">@lang('view.discard')</a>
                        <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-success">{{ __('cargo::view.change_status') }}</button>
                    </div>

                    <ul class="list-group mt-3" id="list">
                        
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <form id="kt_form_1" class="form" action="{{ fr_route('shipments.barcode.scanner.post') }}" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('cargo::view.barcode_scanner') }} {{ __('cargo::view.change_status') }} <span class="count"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('cargo::messages.are_you_sure') }}
                    
                        <input type="hidden" name="checked_ids" class="checked_ids" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ __('cargo::view.change_status') }}</button>
                </div>
                </div>
            </div>
        </div>
    </form>
@endsection

{{-- Inject styles --}}
@section('styles')
    <style type="text/css">
        .badge{
            cursor: pointer;
        }
    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>

        var shipments_barcodes = [];
        $("#barcode").keyup(function() {
            let barcode = $(this).val();
            if(barcode && barcode != ' '){
                if(jQuery.inArray(barcode, shipments_barcodes) !== -1){
                    console.log(jQuery.inArray(barcode, shipments_barcodes));
                }else{
                    shipments_barcodes.push(barcode);
                    $("#list").append(`
                    <li class="list-group-item remove_li_${barcode} d-flex justify-content-between align-items-center">
                        ${barcode}
                        <span onClick="delete_el('${barcode}')" class="delete_el badge badge-pill"><i class="fas fa-times-circle"></i></span>
                    </li>`);
                }
                $('#barcode').val('');
                $('#barcode').focus();
            }else{
                $('#barcode').val('');
                $('#barcode').focus();
            }
            $('.checked_ids').val(JSON.stringify(shipments_barcodes));
            $(".count").text('( '+ shipments_barcodes.length +' {{ __("cargo::view.shipments") }} )');
        });

        function delete_el(barcode){
            let index = shipments_barcodes.findIndex( (n)=> n == barcode );
            shipments_barcodes.splice(index,1);
            $(`.remove_li_${barcode}`).remove();
            $('.checked_ids').val(JSON.stringify(shipments_barcodes));
            $(".count").text('( '+ shipments_barcodes.length +' {{ __("cargo::view.shipments") }} )');
        }
    </script>
@endsection