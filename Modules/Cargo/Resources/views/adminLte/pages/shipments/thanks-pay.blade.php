<?php
use \Milon\Barcode\DNS1D;
$d = new DNS1D();
?>

@php
    if (check_module('Localization')) {
        $current_lang = Modules\Localization\Entities\Language::where('code', LaravelLocalization::getCurrentLocale())->first();
    }
@endphp
<!DOCTYPE html>
@if(isset($current_lang) && $current_lang->dir == 'rtl')
<html lang="{{LaravelLocalization::getCurrentLocale()}}" direction="rtl" dir="rtl" style="direction: rtl;">
@else
<html lang="{{LaravelLocalization::getCurrentLocale()}}">
@endif
    <head>
        <title>{{ config('app.name') . ' | ' . ($pageTitle ?? 'Thanks Pay') }}</title>
        <meta name="description" content="Algoriza - Framework" />
        <meta name="keywords" content="Algoriza - Framework" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{ config('app.name') }}" />
		@php
            $model = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
        @endphp
        <link rel="shortcut icon" href="{{ $model->getFirstMediaUrl('system_logo') ? $model->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/favicon.png') }}" />

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('assets/lte/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->

        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/select2/css/select2.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/adminlte.css">
        @if(isset($current_lang) && $current_lang->dir == 'rtl')
            <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/rtl.css">
        @else
            <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/ltr.css">
        @endif

        <!-- Datatable style -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/css/datatable.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/summernote/summernote-bs4.min.css">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
        <!-- BS Stepper -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/bs-stepper/css/bs-stepper.min.css">
        <!-- dropzonejs -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/dropzone/min/dropzone.min.css">
        <!-- flag-icon-css -->
        <link rel="stylesheet" href="{{ asset('assets/lte') }}/plugins/flag-icon-css/css/flag-icon.min.css">

        <!--begin::Custom Stylesheets-->
		<link href="{{ asset('assets/global/css/app.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/custom/css/custom.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Custom Stylesheets-->

        <script>
			var hostUrl = "assets/";
			window._csrf_token = '{!! csrf_token() !!}'
		</script>
		<!--begin::Javascript-->
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('assets/lte/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/lte/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->

        <livewire:styles />
        <livewire:scripts />
        @yield('styles')

        <!-- signature pad -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="flex-row d-flex flex-column-fluid page">

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">

							<!--begin::Container-->
							<div class="container-fluid">

							<!--begin::Entry-->
								<div class="d-flex flex-column-fluid">
									<!--begin::Container-->
									<div class="container">
										<!--begin::Page Layout-->
										<div class="flex-row d-flex">
											<!--begin::Layout-->
											<div class="flex-row-fluid">

												<!--begin::Section-->
												<div class="row">
													<div class="col-md-7 col-lg-12 col-xxl-7">
														<!--begin::Engage Widget 14-->
														<div class="card card-custom card-stretch gutter-b">
															<div class="card-body">
																<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
																	<!--begin::Logo-->
																	<a href="{{ aurl('/') }}">
																		@php
																			$system_logo = App\Models\Settings::where('group', 'general')->where('name','system_logo')->first();
																		@endphp
																		<img alt="Logo" src="{{  $system_logo->getFirstMediaUrl('system_logo') ? $system_logo->getFirstMediaUrl('system_logo') : asset('assets/lte/media/logos/bll.png') }}" class="logo" style="max-height: 90px;" />
																	</a>

																	<!--end::Logo-->
																</div>
																<div class="mt-5 row mb-17">
																	<div class="col-lg-8">
																		<h1>{{ __('cargo::view.payment_gateway') }}: {{$shipment->payment_method_id}}</h1>
																		<div class="d-flex justify-content-between">
																			{{ __('cargo::view.thank_you_for_paying_the_shipping_cost') }}
																			<a href="{{route('shipments.show', ['shipment'=>$shipment->id])}}">{{ __('cargo::view.back_to_shipment') }}</a>
																			<a href="{{ aurl('/') }}">{{ __('cargo::view.back_to_dashboard') }}</a>
																		</div>
																	</div>
																	<div class="col-xxl-4">
																		<!--begin::Image-->
																		<div class="card card-custom card-stretch">
																			<div class="p-0 px-10 rounded card-body py-10 d-flex align-items-center justify-content-center" style="background-color: #FFCC69;">
																				<h1>{{$shipment->code}}</h1>
																			</div>
																		</div>
																		<!--end::Image-->
																	</div>
																	<div class="col-xxl-12 mt-5">
																		<h2 class="font-weight-bolder text-dark mb-2" style="font-size: 32px;">{{ __('cargo::view.client_sender') }}: {{$shipment->client->name}}</h2>
																		<div class="font-size-h2 mb-7 text-dark-50">{{ __('cargo::view.to_receiver') }}:
																			<span class="ml-2 text-info font-weight-boldest">{{$shipment->reciver_name}}</span>
																		</div>
																		@if($shipment->barcode != null)
																		<?=$d->getBarcodeHTML(str_replace(Modules\Cargo\Entities\ShipmentSetting::getVal('shipment_code_prefix'),"",$shipment->code), "C128");?>
																		@endif
																	</div>
																</div>
															</div>
														</div>
														<!--end::Engage Widget 14-->

														<!--begin::Engage Widget 14-->

														<!--end::Engage Widget 14-->
													</div>
													<div class="col-md-5 col-lg-12 col-xxl-5">
														<!--begin::List Widget 19-->
														<div class="card card-custom card-stretch gutter-b"  >
															<!--begin::Header-->
															<div class="pt-6 mb-2 border-0 card-header">
																<h3 class="card-title align-items-start flex-column">
																	<span class="mb-3 card-label font-weight-bold font-size-h4 text-dark-75">{{ __('cargo::view.package_info') }}</span>
																	<span class="text-muted font-weight-bold font-size-sm">{{Modules\Cargo\Entities\PackageShipment::where('shipment_id',$shipment->id)->count()}} {{__('cargo::view.packages')}}</span>
																</h3>
															</div>
															<!--end::Header-->
															<!--begin::Body-->
															<div class="pt-2 card-body">
																<!--begin::Table-->
																<div class="table-responsive">
																	<table class="table">
																		<thead>
																			<tr>
																				<th class="pl-0 font-weight-bold text-muted text-uppercase">{{ __('cargo::view.package_items') }}</th>
																				<th class="text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.qty') }}</th>
																				<th class="text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.type') }}</th>
																				<th class="pr-0 text-right font-weight-bold text-muted text-uppercase">{{ __('cargo::view.weigh_length_width_height') }}</th>
																			</tr>
																		</thead>
																		<tbody>

																			@foreach(Modules\Cargo\Entities\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)

																				<tr class="font-weight-boldest">
																					<td class="pl-0 border-0 pt-7 d-flex align-items-center">{{$package->description}}</td>
																					<td class="text-right align-middle pt-7">{{$package->qty}}</td>
																					<td class="text-right align-middle pt-7">@if(isset($package->package->name)){{json_decode($package->package->name, true)[app()->getLocale()]}} @else - @endif</td>
																					<td class="pr-0 text-right align-middle text-primary pt-7">{{$package->weight." ". __('cargo::view.KG')." x ".$package->length." ". __('cargo::view.CM') ." x ".$package->width." ".__('cargo::view.CM')." x ".$package->height." ".__('cargo::view.CM')}}</td>
																				</tr>
																			@endforeach

																		</tbody>
																	</table>
																</div>
																<!--end::Table-->
																<div class="mb-8 d-flex flex-column">
																	<span class="mb-4 text-dark font-weight-bold">{{ __('cargo::view.total_cost') }}</span>
																	<span class="text-muted font-weight-bolder font-size-lg">{{format_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance) }}</span>
																	<span class="text-muted font-weight-bolder font-size-lg">{{ __('cargo::view.included_tax_insurance') }}</span>
																</div>
															</div>
															<!--end::Body-->
														</div>

													</div>
												</div>
												<!--end::Section-->
												<!--begin::Section-->
												<!--begin::Advance Table Widget 10-->

												<!--end::Advance Table Widget 10-->
												<!--end::Section-->
											</div>
											<!--end::Layout-->
										</div>
										<!--end::Page Layout-->
									</div>
									<!--end::Container-->
								</div>
								<!--end::Entry-->

							</div>

							<!--end::Container-->

						</div>

						<!--end::Entry-->
					</div>

					<!--end::Content-->
				</div>

				<!--end::Wrapper-->
			</div>
		</div>

        <!-- jQuery -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="{{ asset('assets/lte') }}/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="{{ asset('assets/lte') }}/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="{{ asset('assets/lte') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{ asset('assets/lte') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('assets/lte') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('assets/lte') }}/plugins/moment/moment.min.js"></script>
        <script src="{{ asset('assets/lte') }}/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('assets/lte') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="{{ asset('assets/lte') }}/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('assets/lte') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="{{ asset('assets/lte') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/lte') }}/js/adminlte.js"></script>
        <!-- Select2 -->
        <script src="{{ asset('assets/lte') }}/plugins/select2/js/select2.full.min.js"></script>
        <!--begin::Custom javascript-->
		<script src="{{ asset('assets/global/js/app.js') }}"></script>
		<script src="{{ asset('assets/custom/js/custom.js') }}"></script>
		<!--end::Custom javascript-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(function () {
            bsCustomFileInput.init();
            });
        </script>

		{{-- Show message alert from session flash --}}
		@include('adminLte.helpers.message-alert')
		<!--end::Javascript-->

        @yield('scripts')

		@stack('js-component')
    </body>
</html>
