@csrf

<input type="hidden" name="shipment_id" value="{{$data['shipment']->id}}" class="package-type-select" />
<div id="kt_repeater_1">
  <div class="row" id="">
    <a href="https://fontawesome.com/search" target="_blank" class="btn btn-primary">Choose Icon</a>
    <div data-repeater-list="Package" class="col-lg-12">
      @if(count($data['shipment_status']) == 0)
      <div data-repeater-item class="row align-items-center" style="margin-top: 15px;padding-bottom: 15px;padding-top: 15px;">
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Location</label>
          <input class="form-control" type="text"  name="location"  />
        </div>
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Receipt No.</label>
          <input class="form-control" type="text"   name="receipt_no"  />
        </div>
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Date</label>
          <input class="form-control" type="text"   name="date"  />
        </div>
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Local Time</label>
          <input class="form-control" type="text"   name="local_time"  />
        </div>
        <div class="col-md-2">
            <label class="col-form-label fw-bold fs-6 ">Icon</label>
            <input class="form-control" placeholder="<i class=fa-solid> </i>" type="text" name="ship_icon"  />
        </div>
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Shipment Status</label>
          <select class="form-control" name="ship_status" >
            <option value="Saved Pickup">Saved Pickup</option>
            <option value="Saved Dropoff">Saved Dropoff</option>
            <option value="Requested Pickup">Requested Pickup</option>
            <option value="Approved">Approved</option>
            <option value="In Transit">In Transit</option>
            <option value="Closed">Closed</option>
            <option value="Assigned">Assigned</option>
            <option value="Received">Received</option>
            <option value="Delivered">Delivered</option>
            <option value="Supplied">Supplied</option>
            <option value="Returned">Returned</option>
            <option value="On Hold">On Hold</option>
            <option value="In Vault">In Vault</option>
          </select>
        </div>

        <div class="col-md-2">
          <div>
            <br/>
            <br/>
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger delete_item">
              <i class="la la-trash-o"></i>{{ __('cargo::view.delete') }}
            </a>
          </div>
        </div>

      </div>
      @else
      @foreach($data['shipment_status'] as $pack)
      <div data-repeater-item class="row align-items-center" style="margin-top: 15px;padding-bottom: 15px;padding-top: 15px;">


        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Location</label>
          <input class="form-control" type="text" value="{{$pack->current_address}}" name="location"  />
        </div>
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Receipt No.</label>
          <input class="form-control" type="text"  value="{{$pack->receipt_no}}" name="receipt_no"  />
        </div>
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Date</label>
          <input class="form-control" type="text" value="{{$pack->date}}"  name="date"  />
        </div>
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Local Time</label>
          <input class="form-control" type="text" value="{{$pack->local_time}}"  name="local_time"  />
        </div>
        <div class="col-md-2">
            <label class="col-form-label fw-bold fs-6 ">Icon</label>
            <input class="form-control" placeholder="Paste icon tag" value="{{$pack->ship_icon}}" type="text" name="ship_icon"  />
        </div>
        <div class="col-md-2">
          <label class="col-form-label fw-bold fs-6 ">Shipment Status</label>
          <select class="form-control" name="ship_status" >
            <option value="Saved Pickup" {{$pack->current_status == 'Saved Pickup' ? 'selected' :''}}>Saved Pickup</option>
            <option value="Saved Dropoff" {{$pack->current_status == 'Saved Dropoff' ? 'selected' :''}}>Saved Dropoff</option>
            <option value="Requested Pickup" {{$pack->current_status == 'Requested Pickup' ? 'selected' :''}}>Requested Pickup</option>
            <option value="Approved" {{$pack->current_status == 'Approved' ? 'selected' :''}}>Approved</option>
            <option value="In Transit" {{$pack->current_status == 'In Transit' ? 'selected' :''}}>In Transit</option>
            <option value="Closed" {{$pack->current_status == 'Closed' ? 'selected' :''}}>Closed</option>
            <option value="Assigned" {{$pack->current_status == 'Assigned' ? 'selected' :''}}>Assigned</option>
            <option value="Received" {{$pack->current_status == 'Received' ? 'selected' :''}}>Received</option>
            <option value="Delivered" {{$pack->current_status == 'Delivered' ? 'selected' :''}}>Delivered</option>
            <option value="Supplied" {{$pack->current_status == 'Supplied' ? 'selected' :''}}>Supplied</option>
            <option value="Returned" {{$pack->current_status == 'Returned' ? 'selected' :''}}>Returned</option>
            <option value="On Hold" {{$pack->current_status == 'On Hold' ? 'selected' :''}}>On Hold</option>
            <option value="In Vault" {{$pack->current_status == 'In Vault' ? 'selected' :''}}>In Vault</option>
          </select>
        </div>
        <div class="col-md-2">
          <div>
            <br/>
            <br/>
            <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger delete_item">
              <i class="la la-trash-o"></i>{{ __('cargo::view.delete') }}
            </a>
          </div>
        </div>

      </div>
      @endforeach
      @endif
    </div>
  </div>

  <div class="form-group row">
    <div class="">
      <div>
        <br/>
        <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
          <i class="la la-plus"></i>Add More
        </a>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary" style="float:right">Save</button>
    </div>
  </div>
</div>

</div>

</div>
</div>

{{-- Inject styles --}}
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.css" integrity="sha512-g4B+TyvVE4aa0Y1SgjMHnT/4M4IRl8jnG3Ha9ebg8VhLyrfaAqL5AHDh7zo0/ZdES57Y1E7wvWwsDzX806b1Gw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.css" integrity="sha512-0GlDFjxPsBIRh0ZGa2IMkNT54XGNaGqeJQLtMAw6EMEDQJ0WqpnU6COVA91cUS0CeVA5HtfBfzS9rlJR3bPMyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
@endsection

{{-- Inject Scripts --}}
@push('js-component')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js" integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js" integrity="sha512-0hFHNPMD0WpvGGNbOaTXP0pTO9NkUeVSqW5uFG2f5F9nKyDuHE3T4xnfKhAhnAZWZIO/gBLacwVvxxq0HuZNqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.js" integrity="sha512-k59zBVzm+v8h8BmbntzgQeJbRVBK6AL1doDblD1pSZ50rwUwQmC/qMLZ92/8PcbHWpWYeFaf9hCICWXaiMYVRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="{{ asset('assets/global/js/jquery.geocomplete.js') }}"></script>

<script>


  $('#kt_repeater_1').repeater({
    initEmpty: false,

    show: function() {
      $(this).slideDown();

      $('.dimensions_r').TouchSpin({
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary',

        min: 1,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        initval: 1,
      });

      $('.kt_touchspin_weight').TouchSpin({
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary',

        step: 0.5,
        min: 0.5,
        boostat: 5,
        min: 1,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 50,
        initval: 1,
        prefix: 'Kg'
      });
      $('.kt_touchspin_qty').TouchSpin({
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary',

        min: 1,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        initval: 1,
      });
      calcTotalWeight();
    },

    hide: function(deleteElement) {
      $(this).slideUp(deleteElement);
    },

    isFirstItemUndeletable: true
  });

  $('body').on('click', '.delete_item', function(){
    $('.total-weight').val("{{ __('cargo::view.calculated') }}");
    setTimeout(function(){ calcTotalWeight(); }, 500);
  });

  $('#kt_touchspin_2, #kt_touchspin_2_2').TouchSpin({
    buttondown_class: 'btn btn-secondary',
    buttonup_class: 'btn btn-secondary',

    min: -1000000000,
    max: 1000000000,
    stepinterval: 50,
    maxboostedstep: 10000000,
    prefix: '%'
  });
  $('#kt_touchspin_3, #kt_touchspin_3_shipping_cost, #kt_touchspin_3_3').TouchSpin({
    buttondown_class: 'btn btn-secondary',
    buttonup_class: 'btn btn-secondary',

    min: 0,
    max: 1000000000,
    stepinterval: 50,
    maxboostedstep: 10000000,
    prefix: '$'
  });
  $('.kt_touchspin_weight').TouchSpin({
    buttondown_class: 'btn btn-secondary',
    buttonup_class: 'btn btn-secondary',

    step: 0.5,
    decimals: 1,
    boostat: 5,
    min: 0.5,
    max: 1000000000,
    stepinterval: 50,
    maxboostedstep: 50,
    initval: 1,
    prefix: 'Kg'
  });
  $('.kt_touchspin_qty').TouchSpin({
    buttondown_class: 'btn btn-secondary',
    buttonup_class: 'btn btn-secondary',

    min: 1,
    max: 1000000000,
    stepinterval: 50,
    maxboostedstep: 10000000,
    initval: 1,
  });
  $('.dimensions_r').TouchSpin({
    buttondown_class: 'btn btn-secondary',
    buttonup_class: 'btn btn-secondary',

    min: 1,
    max: 1000000000,
    stepinterval: 50,
    maxboostedstep: 10000000,
    initval: 1,
  });


</script>
@endpush
