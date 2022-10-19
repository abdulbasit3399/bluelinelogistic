<x-base-layout>

    <x-slot name="pageTitle">
        @lang('menu::view.menus')
    </x-slot>

    {!! Menu::render() !!}


        
    {{-- Inject styles --}}
    @section('styles')
        <link href="{{asset('vendor/harimayco-menu/style.css')}}" rel="stylesheet"> 
        <link href="{{ asset('assets/custom/css/menus.css') }}" rel="stylesheet" />
    @endsection



    {{-- Inject Scripts --}}
    @section('scripts')
        {!! Menu::scripts() !!}
    @endsection

</x-base-layout>


