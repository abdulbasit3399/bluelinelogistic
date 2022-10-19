<div class="demos-setting">



    <!--begin::colors -->
    <div class="setting-box">
        <div style="display: flex;justify-content: space-between;">
            <h4 class="setting-box-label fw-bold fs-3">@lang('theme_timeglobalshipping::view.timeglobalshipping_demo')</h4>
            <h4 class="fw-bold fs-3">
                <div class="mb-0 text-right form-group">
                    <button type="button" id="confirm-import" class="btn btn-sm btn-primary">@lang('theme_timeglobalshipping::view.import_now')</button>
                </div>
            </h4>
        </div>

        <div class="message  message--warning">
            <p>@lang('theme_timeglobalshipping::view.import_note')</p>
        </div>

        <div class="input-group radio-images" style="display: flex;justify-content: center;">
            <div class="form-check-label bg-white border p3">
                <img  class="mb-1" style="max-width: 373px;" src="{{ asset('assets/custom/images/settings/demos/timeglobalshipping.png') }}"><br>
            </div>
        </div>

    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{__('view.are_you_sure') }}</h4>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title h6">@lang('theme_timeglobalshipping::view.import_note')</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-no">{{ __('view.no') }}</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-yes">{{ __('view.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::colors -->
</div>

<script>

    var modalConfirm = function(callback){

        $("#confirm-import").on("click", function(){
            $("#mi-modal").modal('show');
        });

        $("#modal-btn-yes").on("click", function(){
            callback(true);
            $("#mi-modal").modal('hide');
        });

        $("#modal-btn-no").on("click", function(){
            callback(false);
            $("#mi-modal").modal('hide');
        });
    };

    modalConfirm(function(confirm){
        if(confirm){
            var url = "{{ fr_route('import.demo') }}";
            var ajaxData = {
                theme: 'timeglobalshipping',
            };
            //Acciones si el usuario confirma

            $("#confirm-import").html('Importing...');
            $('#confirm-import').prop('disabled', true);
            $.post( "{{route('import.demo')}}",
            {
                _token: "{{ csrf_token() }}",
                theme: 'timeglobalshipping',
            } , function(res){
                $("#confirm-import").html('Import Now');
                $('#confirm-import').prop('disabled', false);
                if(res.result){
                    Toast.fire({
                        icon: 'success',
                        title: res.message ? res.message : "Demo imported successfully"
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: res.message ? res.message : "Something Wrong"
                    });
                }
            });
        }
    });

</script>
