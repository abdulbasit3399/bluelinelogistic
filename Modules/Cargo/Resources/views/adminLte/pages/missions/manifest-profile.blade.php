@php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $branch = 3;

    $userBranch = Modules\Cargo\Entities\Branch::where('user_id',auth()->user()->id)->first();
@endphp

@extends('cargo::adminLte.layouts.master')

@section('pageTitle')
    {{ __('cargo::view.manifest_missions') }}
@endsection

@section('content')

    <!-- begin::Card-->
    <div class="card card-custom overflow-hidden">
        <div class="card-body p-0">
            <!-- begin: Invoice-->
            <!-- begin: Invoice header-->
            <div class="row justify-content-center py-8 px-8 pt-md-27 px-md-0">
                <div class="col-md-9">
                    <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                        <h1 class="display-4 font-weight-boldest mb-10">
                            @php 
                                $system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
                            @endphp
                            <img alt="Logo" src="{{  $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
                            {{ __('cargo::view.MANIFEST_MISSIONS') }}
                        </h1>
                        <div class="d-flex flex-column align-items-md-end px-0">
                            <span class="d-flex flex-column align-items-md-end opacity-70">
                                <br />
                                <span><span class="font-weight-bolder">{{ __('cargo::view.MANIFEST_DATE') }}: @if(isset($due_date)) {{$due_date}} @else {{now()->format('Y-m-d')}} @endif</span> </span>
                                <span><span class="font-weight-bolder">{{ __('cargo::view.DRIVER') }}:</span> {{$driver->name}}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: Invoice header-->
            <!-- begin: Invoice body-->

            <div class="px-8 py-8 row justify-content-center pb-md-10 px-md-0">

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="3%"></th>
                                    <th>{{ __('cargo::view.table.code') }}</th>
                                    <th>{{ __('cargo::view.table.type') }}</th>
                                    <th>{{ __('cargo::view.amount') }}</th>
                                    <th>{{ __('cargo::view.table.address') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="profile_manifest">

                                @foreach($missions as $key=>$mission)

                                <tr data-missionid="{{$mission->id}}" class="mission" style="background-color:tomatom">
                                    <td></td>
                                    <td width="5%"><a href="{{route('missions.show', $mission->id)}}">{{$mission->code}}</a></td>
                                    <td>{{$mission->type}}</td>
                                    @php
                                        $helper = new Modules\Cargo\Http\Helpers\TransactionHelper();
                                        $mission_cost = $helper->calcMissionShipmentsAmount($mission->getRawOriginal('type'),$mission->id);
                                    @endphp
                                    <td>{{format_price($mission_cost)}}</td>
                                    <td>{{$mission->address}}</td>
                                    <td>
                                        <div style="width: 30px;height: 30px;border: 1px solid;border-radius: 3px;"></div>
                                    </td>

                                
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end: Invoice body-->
            <!-- begin: Invoice action-->
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 no-print">
                <div class="col-md-9">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">{{ __('cargo::view.print_manifest') }}</button>
                    </div>
                </div>
            </div>
            <!-- end: Invoice action-->
            <!-- end: Invoice-->
        </div>
    </div>
    <!-- end::Card-->

@endsection

{{-- Inject styles --}}
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.6/dragula.css" integrity="sha512-gGkweS4I+MDqo1tLZtHl3Nu3PGY7TU8ldedRnu60fY6etWjQ/twRHRG2J92oDj7GDU2XvX8k6G5mbp0yCoyXCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.6/dragula.min.css" integrity="sha512-49xW99xceMN8dDoWaoCaXvuVMjnUctHv/jOlZxzFSMJYhqDZmSF/UnM6pLJjQu0YEBLSdO1DP0er6rUdm8/VqA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        tr{
            cursor: move !important;
        }
        .print-only{
            display: block;
        }
    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.6/dragula.min.js" integrity="sha512-MrA7WH8h42LMq8GWxQGmWjrtalBjrfIzCQ+i2EZA26cZ7OBiBd/Uct5S3NP9IBqKx5b+MMNH1PhzTsk6J9nPQQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.6/dragula.js" integrity="sha512-Go0jK2e5PYtDuRfDMQVNHauv3p9bGVLg8UB1B1KzfR1wy59QCxGUvrqMM4KquTyLpQ7psbSERhsYWC7mrWITKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        dragula([document.getElementById('profile_manifest')]).on('drop', function (el, container, source) {
            if(container){
                var missions = container.getElementsByClassName('mission');
                var missions_order = [];
                for (let index = 0; index < missions.length; index++) {
                    missions_order.push(missions[index].dataset.missionid);
                }
                $.ajax({
                    url:'{{ route("missions.manifests.order") }}',
                    type:'POST',
                    data:  { _token: "{{ csrf_token() }}", missions_ids:missions_order},
                    dataTy:'json',
                    success:function(response){
                    },
                    error: function(returnval) {
                        // console.log(returnval);
                    }
                });
            }
        });
    </script>
@endsection