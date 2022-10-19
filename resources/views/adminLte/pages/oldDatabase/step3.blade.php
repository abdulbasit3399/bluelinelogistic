@extends('adminLte.pages.oldDatabase.layout')
@section('content')
    <div id="wizard">
        <h4>Database setup</h4>
        <a class="steps"><span class="current-info audible"></span><span class="number">1.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">2.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">3.</span> </a>
        <a class="steps current"><span class="current-info audible">current step: </span><span class="number">4.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">5.</span> </a>
        <a class="steps"><span class="current-info audible"></span><span class="number">6.</span> </a>
        <a class="steps last"><span class="current-info audible"></span><span class="number">7.</span> </a>
        <section>
            <div class="form-row">
                <div class="tooltip"> Fill this form with valid database credentials. </div>
            </div>

            @if (isset($error))
            <div class="row" style="margin: 20px 0;">
                <div class="col-md-12">
                <div class="tooltip alert alert-danger">
                    <strong>Invalid Database Credentials!! </strong>Please check your database credentials carefully
                </div>
                </div>
            </div>
            @endif
            
            <form method="POST" action="{{ route('install.db') }}">
                @csrf
                <input type="hidden" id="db_host" name = "DB_CONNECTION_SECOND" value="mysql">
                <input type="hidden" name = "types[]" value="DB_CONNECTION_SECOND">

                <input type="hidden" id="db_host" name = "DB_PORT_SECOND" value="3306">
                <input type="hidden" name = "types[]" value="DB_PORT_SECOND">
                <div class="form-row">
                    <label for="db_host">Old Database Host</label>
                    <input type="text" class="form-control" id="db_host" name = "DB_HOST_SECOND" required autocomplete="off">
                    <input type="hidden" name = "types[]" value="DB_HOST_SECOND">
                </div>
                <div class="form-row">
                    <label for="db_name">Old Database Name</label>
                    <input type="text" class="form-control" id="db_name" name = "DB_DATABASE_SECOND" required autocomplete="off">
                    <input type="hidden" name = "types[]" value="DB_DATABASE_SECOND">
                </div>
                <div class="form-row">
                    <label for="db_user">Old Database Username</label>
                    <input type="text" class="form-control" id="db_user" name = "DB_USERNAME_SECOND" required autocomplete="off">
                    <input type="hidden" name = "types[]" value="DB_USERNAME_SECOND">
                </div>
                <div class="form-row">
                    <label for="db_pass">Old Database Password</label>
                    <input type="password" class="form-control" id="db_pass" name = "DB_PASSWORD_SECOND" autocomplete="off">
                    <input type="hidden" name = "types[]" value="DB_PASSWORD_SECOND">
                </div>
                <div class="actions">
                    <ul>
                        @php
                            $phpVersion = number_format((float)phpversion(), 2, '.', '');
                        @endphp
                        @if ($permission['curl_enabled'] == 1 && $permission['db_file_write_perm'] == 1 && $permission['routes_file_write_perm'] == 1 && $phpVersion >= 8.0)
                            @if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1')
                                <li><a href="{{ route('step1') }}" class="next">Previous</a></li>
                            @else
                                <li><a href="{{ route('step2') }}" class="next">Previous</a></li>
                            @endif
                        @endif
                        <li><button type="submit" class="next">Next</button></li>
                    </ul>
                </div>
            </form>
        </section>
    </div>
@endsection
