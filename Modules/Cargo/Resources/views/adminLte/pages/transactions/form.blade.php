@csrf

<div class="card-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cargo::view.beneficiary')}}:</label>
                        <select class="form-control mb-5 kt-select2 select-beneficiary" name="type" onchange="enable_select(this)">
                            @foreach($types as $key=>$type)
                                <option value="{{$key}}">{{$type['name']}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="captain" @if(auth()->user()->role == 3 || auth()->user()->role == 0) style="display: block" @else style="display: none" @endif>
                    <div class="form-group">
                        <label>{{__('cargo::view.driver')}}:</label>
                        <select class="form-control mb-5 kt-select2 select-captain" name="captain">
                            <option></option>
                            @foreach($captains as $captain)
                                <option value="{{$captain->id}}">{{$captain->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="client" style="display: none">
                    <div class="form-group">
                        <label>{{__('cargo::view.client')}}:</label>
                        <select class="form-control mb-5 kt-select2 select-client" name="client">
                            <option></option>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-6" id="branch" @if(auth()->user()->role == 3 || auth()->user()->role == 0) style="display: none" @else style="display: block" @endif>
                    <div class="form-group">
                        <label>{{__('cargo::view.table.branch')}}:</label>
                        <select class="form-control mb-5 kt-select2 select-branch" name="branch">
                            <option></option>
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cargo::view.wallet_type')}}:</label>
                        <select class="form-control mb-5 kt-select2" name="wallet_type">
                            <option value="add">{{__('cargo::view.add_to_wallet')}}</option>
                            <option value="deduct">{{__('cargo::view.deduct_from_wallet')}}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cargo::view.amount')}}:</label>
                        <input id="kt_touchspin_4" placeholder="{{__('cargo::view.amount')}}" type="text" class="form-control mb-5 total-weight" value="0" name="amount" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('cargo::view.description')}}:</label>
                        <textarea name="description" id="description" class="form-control mb-5" cols="30" rows="3" placeholder="{{__('cargo::view.description')}}"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Inject styles --}}
@section('styles')
    <style>
        label {
            font-weight: bold !important;
        }
    </style>
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js" integrity="sha512-0hFHNPMD0WpvGGNbOaTXP0pTO9NkUeVSqW5uFG2f5F9nKyDuHE3T4xnfKhAhnAZWZIO/gBLacwVvxxq0HuZNqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.js" integrity="sha512-k59zBVzm+v8h8BmbntzgQeJbRVBK6AL1doDblD1pSZ50rwUwQmC/qMLZ92/8PcbHWpWYeFaf9hCICWXaiMYVRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $('#kt_touchspin_4').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
        });
        var types = @json($types);
        function enable_select(select_type) {
            for (const [key, value] of Object.entries(types)) {
                document.getElementById(types[key]['key']).style.display = "none";
            }
            document.getElementById(types[select_type.value]['key']).style.display = "block";
        }
    </script>
@endsection