@extends('admin.main')

@section('head-title', 'Dashboard - Menus - ' . Core::getOption('sitename'))

@section('title', 'Menus')

@section('content')
    @if(Session::has('menus-session'))
        <div class="message autohide_message is-primary">
            <button class="delete"></button>
            <div class="message-body">
                {{ Session::get('menus-session') }}
            </div>
        </div>
    @endif
    <div class="create_menu_container">
        <div class="create_menu_sidebar">
            <h4>{{ __('Available Menus: ' . $menus->count()) }}</h4>
            @if($menus)
                <ul>
                    @foreach($menus as $menu)
                        <li><a href="{{ route('my-admin-edit-menu', [$menu->id]) }}">{{ $menu->menu_name }}<i class="edit_txt">{{ __('Edit') }}</i></a></li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="create_menu_content">
            <form action="{{ route('my-admin-create-menu-submit') }}" method="POST" class="submit_menu_form">
                @csrf
                <div class="formcontroll">
                    <label>
                        <span>{{ __('Menu name') }}</span>
                        <input class="input is-small name" type="text" placeholder="Primary menu" name="menu_name" required>
                    </label>
                </div>
                <div class="formcontroll">
                    <label>
                        <span>{{ __('Menu location') }}</span>
                        <input class="input is-small name" type="text" placeholder="primary_menu" name="menu_location" required>
                    </label>
                </div>
                <div class="submit_new_menu">
                    <button type="submit" class="button is-small is-link is-outlined">{{ __('Create Menu') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        //Slugify
        function get_slug (str) {
            str = str.replace(/^\s+|\s+$/g, '');
            str = str.toLowerCase();

            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '_')
                .replace(/-+/g, '_');

            return str;
        }
        $('.create_menu_content .formcontroll input.name[name="menu_name"]').on('change', function(){
            var value = $(this).val();
            $('.create_menu_content .formcontroll input.name[name="menu_location"]').attr('value', get_slug(value));
        });
    </script>
@endsection
