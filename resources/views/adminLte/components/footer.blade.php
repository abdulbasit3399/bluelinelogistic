<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">{{ \Str::title(get_general_setting('company_name', config('app.name'))) }}</a>.</strong>

    <div class="float-right d-sm-inline-block">
        <b>Version</b> {{ preg_replace('/[\\\@\;\" "]+/', '', get_general_setting('current_version')) }}
    </div>
</footer>
