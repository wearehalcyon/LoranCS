<ul class="sidebar_menu">
    <li class="menu_title">{{ __('Content') }}</li>
    <li>
        <a href="{{ route('my-admin') }}"><i class="icofont-speed-meter"></i>{{ __('Dashboard') }}</a>
    </li>
    @if(Auth::user()->role == 0 || Auth::user()->role == 1)
        <li>
            <a href="{{ route('my-admin-posts') }}"><i class="icofont-file-text"></i>{{ __('Posts') }}</a>
        </li>
        <li>
            <a href="{{ route('my-admin') }}"><i class="icofont-page"></i>{{ __('Pages') }}</a>
        </li>
        <li>
            <a href="{{ route('my-admin') }}"><i class="icofont-comment"></i>{{ __('Comments') }}</a>
        </li>
        <li>
            <a href="{{ route('my-admin') }}"><i class="icofont-multimedia"></i>{{ __('Media Library') }}</a>
        </li>
    @endif
</ul>
@if(Auth::user()->role == 0 || Auth::user()->role == 1)
    <ul class="sidebar_menu">
        <li class="menu_title">{{ __('Appearance') }}</li>
        <li>
            <a href="{{ route('my-admin-themes') }}"><i class="icofont-ui-theme"></i>{{ __('Themes') }}</a>
        </li>
        <li>
            <a href="{{ route('my-admin') }}"><i class="icofont-plugin"></i>{{ __('Plugins') }}</a>
        </li>
        <li>
            <a href="{{ route('my-admin-menus') }}"><i class="icofont-navigation-menu"></i>{{ __('Menus') }}</a>
        </li>
    </ul>
@endif
<ul class="sidebar_menu">
    <li class="menu_title">{{ __('Accounts') }}</li>
    <li>
        <a href="{{ route('my-admin') }}"><i class="icofont-user-alt-4"></i>{{ __('My Account') }}</a>
    </li>
    @if(Auth::user()->role == 0 || Auth::user()->role == 1)
        <li>
            <a href="{{ route('my-admin') }}"><i class="icofont-users-alt-4"></i>{{ __('All Users') }}</a>
        </li>
    @endif
</ul>
<ul class="sidebar_menu">
    <li class="menu_title">{{ __('Engine') }}</li>
    @if(Auth::user()->role == 0 || Auth::user()->role == 1)
        <li>
            <a href="{{ route('my-admin') }}"><i class="icofont-ui-settings"></i>{{ __('Settings') }}</a>
        </li>
    @endif
    <li>
        <a href="{{ route('my-admin-docs') }}"><i class="icofont-document-folder"></i>{{ __('Docs') }}</a>
    </li>
</ul>
