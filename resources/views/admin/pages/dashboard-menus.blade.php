@extends('admin.main')

@section('head-title', 'Dashboard - Menus - ' . Core::getOption('sitename'))

@section('title', 'Menus')

@section('content')
    @if(Session::has('menus-session'))
        <div class="message is-primary autohide_message">
            <button class="delete"></button>
            <div class="message-body">
                {{ Session::get('menus-session') }}
            </div>
        </div>
    @endif
    <div class="posts_count">
        @if( $menus->count() == 1 )
            {{ __('You have - ' . $menus->count() . ' menu on board.') }}
        @else
            {{ __('You have - ' . $menus->count() . ' menus on board.') }}
        @endif
    </div>
    <div class="post_list">
        <div class="page_actions header_actions">
            <div class="buttons">
                <a href="{{ route('my-admin-create-menu') }}" class="button is-small is-primary">Create New Menu</a>
            </div>
        </div>
        <table class="table is-bordered is-striped is-hoverable is-fullwidth admin_table">
            <thead>
                <tr>
                    <th>{{ __('Menu Name') }}</th>
                    <th>{{ __('Menu Location') }}</th>
                    <th class="menu_items_count_tbf">{{ __('Items') }}</th>
                    <th class="menu_items_count_tbf">{{ __('Delete') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td class="menu_name">
                            <a class="post_title" href="">{{ $menu->menu_name }}</a>
                        </td>
                        <td>{{ $menu->menu_location }}</td>
                        <td class="menu_items_count">
                            {{ $menu->items()->count() }}
                        </td>
                        <td class="menu_items_count delete_menu">
                            <a class="button is-small is-danger is-outlined" href="{{ route('my-admin-menu-delete', [$menu->id]) }}">
                                <i class="icofont-ui-delete"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('footer-scripts')
    <script>
        // Confirm deletion
        $('.delete_menu a').on('click', function(e){
            if (confirm('Are you sure you want delete this menu?')) {
                return true;
            } else {
                e.preventDefault();
            }
        });
    </script>
@endsection
