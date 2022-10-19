<x-base-layout>

    <x-slot name="pageTitle">
        @lang('view.dashboard')
    </x-slot>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @if (app('hook')->get('dashboard_count'))
                @foreach(app('hook')->get('dashboard_count') as $componentView)
                    {!! $componentView !!}
                @endforeach
            @endif
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            @if (app('hook')->get('dashboard_latest_list'))
                @foreach(app('hook')->get('dashboard_latest_list') as $componentView)
                    {!! $componentView !!}
                @endforeach
            @endif
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</x-base-layout>