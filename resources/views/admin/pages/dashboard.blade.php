@extends('admin.main')

@section('head-title', 'Dashboard - ' . Core::getOption('sitename'))

@section('title', 'Dashboard')

@section('content')
    <div class="deashboard_index">
        @if($version > Core::App()['ver'])
            <div class="notification is-warning is-light">
                {!! __('Available new version of LoranCS. Current version is <strong>' . Core::App()['ver'] . '</strong> and fresh version is <strong>' . $version . '</strong>. Please update your site.') !!}
            </div>
        @endif
        <div class="dashboard_index_columns columns">
            <div class="column is-one-third">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            {{ __('Latest Posts | Total: [' . $posts->count() . ']') }}
                        </p>
                        </button>
                    </header>
                    <div class="card-content">
                        @if($posts)
                            <ul class="posts_list_in_card">
                                @foreach($posts as $post)
                                    <li><a href="{{ route('my-admin-post-edit', $post->id) }}">{{ $post->title }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('There no created posts') }}</p>
                        @endif
                    </div>
                    <footer class="card-footer">
                        <a href="{{ route('my-admin-posts') }}" class="card-footer-item">{{ __('Manage Posts') }}</a>
                    </footer>
                </div>
            </div>
            <div class="column is-one-third">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            {{ __('Latest Pages | Total: [' . $pages->count() . ']') }}
                        </p>
                        </button>
                    </header>
                    <div class="card-content">
                        @if($pages)
                            <ul class="posts_list_in_card">
                                @foreach($pages as $page)
                                    <li><a href="{{ route('my-admin-post-edit', $page->id) }}">{{ $page->title }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('There no created pages') }}</p>
                        @endif
                    </div>
                    <footer class="card-footer">
                        <a href="{{ route('my-admin-posts') }}" class="card-footer-item">{{ __('Manage Pages') }}</a>
                    </footer>
                </div>
            </div>
        </div>
    </div>
@endsection
