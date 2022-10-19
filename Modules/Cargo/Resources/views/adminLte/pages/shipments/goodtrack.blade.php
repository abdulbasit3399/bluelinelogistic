@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
    {{ __('Goods Tracking') }}
@endsection

@section('content')
<div class="container mt-4">
<div class="card">
    <div class="card-header">
        <div class="row">
        <h3 class="pt-3 bl">Manage Goods Tracking</h3>
        <p class="bl">You can edit/delete tracking from here</p>
    </div>
    <a class="btn btn-success text-end mt-4" href="{{ route('shipments.add.goodtrack') }}">Add Tracking</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col"><strong>ID</strong></th>
                <th scope="col"><strong>Username</strong></th>
                <th scope="col"><strong>Tracking No.</strong></th>
                <th scope="col"><strong>Receipt No.</strong></th>
                <th scope="col"><strong>Status</strong></th>
                <th scope="col"><strong>Items</strong></th>
                <th scope="col"><strong>Weight</strong></th>
                <th scope="col"><strong>Payment Status</strong></th>
                <th scope="col"><strong>Actions</strong></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($share_data as $share_datas)
                <tr>
                    <th>{{ '#'.$share_datas->id }}</th>
                    <td>{{ $share_datas->vault_username }}</td>
                    <td>{{ $share_datas->code }}</td>
                    <td>{{ $share_datas->receipt_number }}</td>
                    <td>{{ $share_datas->status }}</td>
                    <td>{{ $share_datas->items }}</td>
                    <td>{{ $share_datas->total_weight }}</td>
                    <td>{{ $share_datas->payment_status }}</td>

                    {{--  <td>
                        <label class="
                        {!!$share_datas->type == 'Good' ?
                            'badge bg-primary ' :
                            'badge bg-success'
                        !!}">{{ $share_datas->type }}</label>

                    </td>  --}}
                    {{--  <td>
                        {{ $share_datas->created_at->format('M d, Y') }}
                    </td>  --}}

                    <td>
                        <a href="{{ url('shipments/edit_goodtrack/'.$share_datas->id) }}" class="badge bg-warning p-2"><i class="fa-solid fa-pen-to-square text-dark"></i></a>
                        <a href="{{ url('shipment_status/'.$share_datas->id) }}" class="badge bg-primary p-2"><i class="fa-solid fa-truck text-white"></i></a>

                        <a href="{{ route('shipments.delete.goodtrack',$share_datas->id) }}" class="badge bg-danger p-2"><i class="fa-solid fa-trash text-white"></i></a>
                    </td>
                </tr>
                @endforeach


            </tbody>
          </table>
    </div>
</div>
</div>
@endsection
