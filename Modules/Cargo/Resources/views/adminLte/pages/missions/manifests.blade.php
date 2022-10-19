@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;

    $userBranch = Modules\Cargo\Entities\Branch::where('user_id',auth()->user()->id)->first();
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.manifest') }}
@endsection

@section('content')

<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">
                {{ __('cargo::view.manifest') }}
            </h3>
        </div>
       
    </div>

    <div class="card-body">
    <form action="{{route('missions.get.manifest')}}" id="kt_form_1" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-5">
                    @php
                        if($user_role == $branch){
                            $manifest_captains = Modules\Cargo\Entities\Driver::where('branch_id',$userBranch->id)->get();
                        }else{
                            $manifest_captains = Modules\Cargo\Entities\Driver::all();
                        }
                    @endphp
                    
                    <label>{{ __('cargo::view.driver') }}:</label>
                    <select 
                        class="form-control  select-branch  @error('captain_id') is-invalid @enderror"
                        data-control="select2"
                        data-placeholder="{{ __('cargo::view.table.choose_driver') }}"
                        data-allow-clear="true"
                        name="captain_id"
                    >
                        @foreach($manifest_captains as $captain)
                        <option value="{{$captain->id}}"
                            {{ old('captain_id') == $captain->id ? 'selected' : '' }}
                        >{{$captain->name}}</option>
                        @endforeach
                    </select>
                    @error('captain_id') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{ __('cargo::view.manifest_date') }}:</label>
                <div class="form-group mb-5">
                    <input type="text" placeholder="{{ __('cargo::view.manifest_date') }}" name="manifest_date" autocomplete="off" value="{{ old('Shipment.shipping_date') }}" class="form-control @error('manifest_date') is-invalid @enderror" id="kt_datepicker_3" />
                    @error('manifest_date') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-5">
                  <button type="submit" class="btn btn-primary" style="display:block">{{ __('cargo::view.get_ganifest') }}</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

@endsection

{{-- Inject styles --}}
@section('styles')
    <style media="print">
        
    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script>
        var inputDate = $(`#kt_datepicker_3`);

        // Trigger date picker for Shipping Date
        inputDate.daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            autoUpdateInput: false,
            autoclose: true,
            minYear: parseInt(moment().format('YYYY')) - 10,
            maxYear: parseInt(moment().format('YYYY')) + 10,
            todayHighlight: true,
            startDate: new Date(),
            todayBtn: true,
            locale: {
                format: "DD/MM/YYYY",
                cancelLabel: "{{ __('view.cancel') }}",
                applyLabel: "{{ __('view.apply') }}",
                "fromLabel": "{{ __('view.from') }}",
                "toLabel": "{{ __('view.to') }}",
                "customRangeLabel": "{{ __('datepicker.custom_range') }}",
                "weekLabel": "{{ __('datepicker.week_label') }}",
                "daysOfWeek": [
                    "{{ __('datepicker.days_of_week.sunday') }}",
                    "{{ __('datepicker.days_of_week.monday') }}",
                    "{{ __('datepicker.days_of_week.tuesday') }}",
                    "{{ __('datepicker.days_of_week.wednesday') }}",
                    "{{ __('datepicker.days_of_week.thursday') }}",
                    "{{ __('datepicker.days_of_week.friday') }}",
                    "{{ __('datepicker.days_of_week.saturday') }}",
                ],
                "monthNames": [
                    "{{ __('datepicker.month_names.january') }}",
                    "{{ __('datepicker.month_names.february') }}",
                    "{{ __('datepicker.month_names.march') }}",
                    "{{ __('datepicker.month_names.april') }}",
                    "{{ __('datepicker.month_names.may') }}",
                    "{{ __('datepicker.month_names.june') }}",
                    "{{ __('datepicker.month_names.july') }}",
                    "{{ __('datepicker.month_names.august') }}",
                    "{{ __('datepicker.month_names.september') }}",
                    "{{ __('datepicker.month_names.october') }}",
                    "{{ __('datepicker.month_names.november') }}",
                    "{{ __('datepicker.month_names.december') }}",
                ],
            }
        }, cb);

        // call back after choose date
        function cb(start) {
            var apiDate = start ? start.format("YYYY-MM-DD H:m") : '';
            var inputShowDate = start ? (start.format("YYYY-MM-DD")) : '';
            if (start) {
                inputDate.val(inputShowDate);
            }
        }
    </script>
@endsection