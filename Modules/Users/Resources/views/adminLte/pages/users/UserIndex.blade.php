@extends('cargo::adminLte.template.layout.layout')

@section('pageTitle')
    {{ __('Users List') }}
@endsection

@section('content')
<div class="container mt-4">
<div class="card">
    <div class="card-header">
        <div class="row">
        <h3 class="pt-3 bl">Manage Users</h3>
        <p class="bl">You can edit/delete users from here</p>
    </div>
    <a class="btn btn-success text-end mt-4" href="{{ route('users.create') }}">Add User</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col"><strong>Id</strong></th>
                <th scope="col"><strong>Username</strong></th>
                <th scope="col"><strong>Email</strong></th>
                <th scope="col"><strong>Full Name</strong></th>

                <th scope="col"><strong>Type</strong></th>
                <th scope="col"><strong>Tracking No.</strong></th>
                <th scope="col"><strong>Receipt No.</strong></th>
                <th scope="col"><strong>Created</strong></th>
                <th scope="col"><strong>Actions</strong></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($share_data as $share_datas)
                <tr>
                    <th>{{ '#'.$share_datas->id }}</th>
                    <td>{{ $share_datas->username }}</td>
                    <td>{{ $share_datas->email }}</td>
                    <td>{{ $share_datas->name }}</td>

                    <td>

                        <label class="
                        {!!$share_datas->type == 'Good' ?
                            'badge bg-primary ' :
                            'badge bg-success'
                        !!}">{{ $share_datas->type }}</label>

                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        {{ $share_datas->created_at->format('M d, Y') }} </td>
                    <td>
                        <a href="{{ url('admin/users/'.$share_datas->id.'/edit') }}" class="badge bg-warning p-2"><i class="fa-solid fa-pen-to-square text-dark"></i></a>
                        <a href="{{ route('users.delete',$share_datas->id) }}" class="badge bg-danger p-2"><i class="fa-solid fa-trash text-white"></i></a>
                    </td>
                </tr>
                @endforeach


            </tbody>
          </table>
    </div>
</div>
</div>
@endsection
