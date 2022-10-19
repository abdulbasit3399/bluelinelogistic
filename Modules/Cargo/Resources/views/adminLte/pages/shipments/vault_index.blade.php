@php
$user_role = auth()->user()->role;
$admin  = 1;
$branch = 3;
$client = 4;
@endphp

{{--  @extends('cargo::adminLte.layouts.master')  --}}
@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
Vault List
@endsection

@section('content')
<div class="container mt-4" style="background-color: white">
<br>
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h3 class="m-0 bl">{{ __('Vault List') }}</h3>
    </div>
    <div class="col-sm-6">
      <a class="btn btn-success" href="{{route('admin.shipments.vault-create')}}" style="float:right;">Create Vault</a>
    </div>
  </div>
</div>


  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card mb-4">
        {{--  <div class="card-header">
            <h3 class="fw-bolder m-0">{{ __('Vault List') }}</h3>
        </div>  --}}
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="vault_table">
              <thead>
                <tr>
                  <th><strong>#</strong></th>
                  <th style="text-transform:uppercase;"><strong>Vault Number</strong></th>
                  <th style="text-transform:uppercase;"><strong>Vault Username</strong></th>
                  <th style="text-transform:uppercase;"><strong>Vault Password</strong></th>
                  <th style="text-transform:uppercase;"><strong>Customer</strong></th>
                  <th style="text-transform:uppercase;"><strong>Arrears to be paid</strong></th>

                  <th style="text-transform:uppercase;"><strong>Date of Deposit</strong></th>
                  <th style="text-transform:uppercase;"><strong>Next Kin</strong></th>
                  {{--  <th style="text-transform:uppercase;"><strong>Item Description</strong></th>  --}}
                  <th style="text-transform:uppercase;"><strong>Status</strong></th>
                  {{--  <th style="text-transform:uppercase;"><strong>Vault Icon</strong></th>  --}}

                  <th>Action</th>
                </thead>
                <tbody>
                  @php
                    $count = 1;
                    foreach ($shipment as $shipments):
                  @endphp
                  <tr>
                    <td>{{ $count }}</td>
                    <td>{{ $shipments->vault_number }}</td>
                    <td>{{ $shipments->vault_username }}</td>
                    <td>{{ $shipments->vault_password }}</td>
                    <td>{{ $shipments->client->name }}</td>
                    <td>{{ $shipments->arrears }}</td>

                    <td>{{ $shipments->d_o_deposit }}</td>
                    <td>{{ $shipments->next_kin }}</td>
                    {{--  <td>{{ $shipments->item_des }}</td>  --}}
                    <td>{{ $shipments->status }}</td>
                    {{--  <td>{{ $shipments->vault_icon }}</td>  --}}


                    <td>
                        <a class="btn btn-sm btn-secondary btn-action-table" href="{{route('admin.shipments.vault-edit',$shipments->id)}}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-secondary btn-action-table" onclick="return confirm('Want to delete this vault?')" href="{{route('admin.shipments.vault-delete',$shipments->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  @php $count++; @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>
  @endsection


  @section('toolbar-btn')
  <!--begin::Button-->
  {{-- <a href="{{ fr_route('users.create') }}" class="btn btn-sm btn-primary">Create <i class="ms-2 fas fa-plus"></i> </a> --}}
  <!--end::Button-->
  @endsection


  {{-- Inject styles --}}
  @section('styles')
  <link rel="stylesheet" href="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  @endsection

  {{-- Inject Scripts --}}
  @section('scripts')
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    $('#vault_table').DataTable();
  </script>
  @endsection
