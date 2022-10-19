<x-base-layout>

    <x-slot name="pageTitle">
        @lang('view.system_update')
    </x-slot>

    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">

        <div class="wrapper-settings">
            <div class="mx-auto mb-5 col-lg-12">

                <div class="card mb-5">
                    <div class="card-body">
                        <div class="message  message--warning">
                            <p>{{ __('view.system_update_note') }}.</p>
                        </div>
                        <div class="message  message--warning">
                            <p>{{ __('view.backup_necessary') }}.</p>
                        </div>
                        <form class="form-horizontal" id="kt_form_1" action="{{ route('post.system.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-5">
                                <label for="file" class="col-md-12 control-label">{{ __('view.ZIP_file_to_import') }}</label>

                                <div class="col-md-12">
                                    <input id="file" type="file" class="form-control @error('zip_file') is-invalid @enderror" name="zip_file" required>

                                    @error('zip_file') 
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-0 text-right form-group">
                                <button type="button" id="confirm" class="btn btn-sm btn-primary">{{ __('view.update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="modal-title h6">{{__('view.are_you_sure') }}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-no">{{ __('view.no') }}</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-yes">{{ __('view.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Basic info-->
    @section('scripts')    
    <script>

        var modalConfirm = function(callback){
        
            $("#confirm").on("click", function(){
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
                //Acciones si el usuario confirma
                $("#confirm").html('Updating...');
                $('#confirm').prop('disabled', true);
                $( "#kt_form_1" ).submit();
            }
        });

    </script>
    @endsection
</x-base-layout>