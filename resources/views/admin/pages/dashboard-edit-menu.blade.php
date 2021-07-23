@extends('admin.main')

@section('head-title', 'Dashboard - Edit Menu ' . $menu->menu_name . ' - ' . Core::getOption('sitename'))

@section('title', 'Edit Menu: ' . $menu->menu_name)

@section('content')
    <div class="back_to_all">
        <a href="{{ route('my-admin-menus') }}"><i class="icofont-long-arrow-left"></i>{{ __('Back to all menus') }}</a>
        <a href="{{ route('my-admin-menu-delete', [$menu->id]) }}" class="delete_menu">{{ __('Delete menu') }}</a>
    </div>
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
            1
        </div>
        <div class="create_menu_content">
            <form action="{{ route('my-admin-edit-menu-submit') }}" method="POST" class="submit_menu_form">
                @csrf
                <div class="formcontroll">
                    <label>
                        <span>{{ __('Menu name') }}</span>
                        <input class="input is-small name" type="text" placeholder="Primary menu" name="menu_name" value="{{ $menu->menu_name }}" required>
                    </label>
                </div>
                <div class="formcontroll">
                    <label>
                        <span>{{ __('Menu location') }}</span>
                        <input class="input is-small name" type="text" placeholder="primary_menu" name="menu_location" value="{{ $menu->menu_location }}" required>
                    </label>
                </div>
                <div class="submit_new_menu">
                    <button type="submit" class="button is-small is-link is-outlined">{{ __('Update Menu') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        // Confirm deletion
        $('a.delete_menu').on('click', function(e){
            if (confirm('Are you sure you want delete this menu?')) {
                return true;
            } else {
                e.preventDefault();
            }
        });
    </script>
@endsection
