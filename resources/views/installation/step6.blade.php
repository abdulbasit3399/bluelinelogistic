@extends('installation.layout')
@section('content')
    <div id="wizard">
        <h4>Congratulations</h4>
        <a class="steps"><span class="current-info audible"></span><span class="number">1.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">2.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">3.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">4.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">5.</span> </a>
        <a class="steps current"><span class="current-info audible">current step: </span><span class="number">6.</span> </a>
        <section>
            <div class="form-row">
                <div class="tooltip alert-success"> You have successfully completed the installation process. Please Login to continue. </div>
                <ol class="list-group">
                    <li class="list-group-item text-semibold"><i class="la la-check"></i> EMAIL: admin@admin.com</li>
                    <li class="list-group-item text-semibold"><i class="la la-check"></i> PASSWORD: 123456</li>
                </ol>
                <div class="tooltip">
                    During the installation process, we will check if the files that are needed to be written (<strong>.env file</strong>) have <strong>write permission</strong>. We will also check if <strong>curl</strong> are enabled on your server or not.
                </div>
                <div class="tooltip">
                    Gather the information mentioned above before hitting the start installation button. If you are ready....
                </div>
            </div>
            
            <div class="actions">
                <ul>
                    <li><a href="#" class="disabled">Previous</a></li>
                    <li><a href="{{ Route::has('login') ? route('login') : '' }}" class="next success">Login to Admin panel</a></li>
                </ul>
            </div>
        </section>
    </div>
<script type="text/javascript">
  if({{ Route::has('login') }}){    
  	window.stop();
  }else{
    window.location.reload();
  }
</script>
@endsection
