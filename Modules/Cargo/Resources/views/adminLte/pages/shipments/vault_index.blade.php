@php
$user_role = auth()->user()->role;
$admin  = 1;
$branch = 3;
$client = 4;
@endphp

{{--  @extends('cargo::adminLte.layouts.master')  --}}
@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
Manage Vaults
@endsection

@section('content')
<div class="container mt-4" style="background-color: white">
<br>
<div class="container-fluid">
  <div class="row mb-0">
    <div class="col-sm-6">
      <h3 class="m-0 bl">Manage Vaults Tracking</h3>
      <p class="bl">You can edit/delete tracking from here.</p>
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
                  <th><strong>ID</strong></th>
                  <th style="text-transform:uppercase;"><strong>Username</strong></th>

                  <th style="text-transform:uppercase;"><strong>Tracking No.</strong></th>
                  <th style="text-transform:uppercase;"><strong>Name of Depositor</strong></th>
                  <th style="text-transform:uppercase;"><strong>Next of Kin</strong></th>
                  <th style="text-transform:uppercase;"><strong>Good Quantity</strong></th>
                  <th style="text-transform:uppercase;"><strong>Paid</strong></th>

                  <th style="text-transform:uppercase;"><strong>Deposited on</strong></th>
                  <th style="text-transform:uppercase;"><strong>Status</strong></th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @php
                    $count = 1;
                    foreach ($shipment as $shipments):
                  @endphp
                  <tr>
                    <td>#{{ $shipments->id }}</td>
                    <td>{{ $shipments->vault_username }}</td>
                    <td>{{ $shipments->vault_number }}</td>
                    <td>{{ $shipments->despositor }}</td>
                    <td>{{ $shipments->next_kin }}</td>
                    <td>{{ $shipments->quantity }}</td>
                    <td></td>

                    <td>{{ $shipments->d_o_deposit }}</td>
                    <td>{{ $shipments->status }}</td>
                    <td>
                        <a href="{{route('admin.shipments.vault-edit',$shipments->id)}}" class="badge bg-warning p-2"><i class="fa-solid fa-pen-to-square text-dark"></i></a>
                        <a href="{{route('admin.shipments.vault-delete',$shipments->id)}}" onclick="return confirm('Want to delete this vault?')" class="badge bg-danger p-2"><i class="fa-solid fa-trash text-white"></i></a>
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
