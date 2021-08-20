<ul class="sidebar_menu">
    <li class="menu_title">{{ __('Content') }}</li>
    <li class="dashboard-menu-item @if(Request::route()->getName() == 'my-admin'){{ 'active' }}@endif">
        <a href="{{ route('my-admin') }}"><i class="icofont-speed-meter"></i>{{ __('Dashboard') }}</a>
    </li>
    @if(Auth::user()->role == 0 || Auth::user()->role == 1)
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/posts'){{ 'active' }}@endif">
            <a href="{{ route('my-admin-posts') }}"><i class="icofont-file-text"></i>{{ __('Posts') }}</a>
        </li>
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/pages'){{ 'active' }}@endif">
            <a href="{{ route('my-admin') }}"><i class="icofont-page"></i>{{ __('Pages') }}</a>
        </li>
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/comments'){{ 'active' }}@endif">
            <a href="{{ route('my-admin') }}"><i class="icofont-comment"></i>{{ __('Comments') }}</a>
        </li>
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/library'){{ 'active' }}@endif">
            <a href="{{ route('my-admin') }}"><i class="icofont-multimedia"></i>{{ __('Media Library') }}</a>
        </li>
    @endif
</ul>
@if(Auth::user()->role == 0 || Auth::user()->role == 1)
    <ul class="sidebar_menu">
        <li class="menu_title">{{ __('Appearance') }}</li>
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/themes'){{ 'active' }}@endif">
            <a href="{{ route('my-admin-themes') }}"><i class="icofont-ui-theme"></i>{{ __('Themes') }}</a>
        </li>
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/plugins'){{ 'active' }}@endif">
            <a href="{{ route('my-admin') }}"><i class="icofont-plugin"></i>{{ __('Plugins') }}</a>
        </li>
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/menus'){{ 'active' }}@endif">
            <a href="{{ route('my-admin-menus') }}"><i class="icofont-navigation-menu"></i>{{ __('Menus') }}</a>
        </li>
    </ul>
@endif
<ul class="sidebar_menu">
    <li class="menu_title">{{ __('Accounts') }}</li>
    <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/account'){{ 'active' }}@endif">
        <a href="{{ route('my-admin') }}"><i class="icofont-user-alt-4"></i>{{ __('My Account') }}</a>
    </li>
    @if(Auth::user()->role == 0 || Auth::user()->role == 1)
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/accounts'){{ 'active' }}@endif">
            <a href="{{ route('my-admin') }}"><i class="icofont-users-alt-4"></i>{{ __('All Users') }}</a>
        </li>
    @endif
</ul>
<ul class="sidebar_menu">
    <li class="menu_title">{{ __('Engine') }}</li>
    @if(Auth::user()->role == 0 || Auth::user()->role == 1)
        <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/settings'){{ 'active' }}@endif">
            <a href="{{ route('my-admin') }}"><i class="icofont-ui-settings"></i>{{ __('Settings') }}</a>
        </li>
    @endif
    <li class="dashboard-menu-item @if(Route::getCurrentRoute()->getPrefix() == 'cs-admin/documentation'){{ 'active' }}@endif">
        <a href="{{ route('my-admin-docs') }}"><i class="icofont-document-folder"></i>{{ __('Docs') }}</a>
    </li>
</ul>
