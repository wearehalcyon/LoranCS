@extends('myadmin.main')

@section('head-title', 'Dashboard - All Posts - ' . Core::getOption('sitename'))

@section('title', 'All Posts')

@section('content')
    @if(Session::has('post-session'))
        <div class="notification is-primary">
            <button class="delete"></button>
            {!! Session::get('post-session') !!}
        </div>
    @endif
    <div class="posts_count">
        @if( $count == 1 )
            {{ __('You have - ' . $count . ' post on board.') }}
        @else
            {{ __('You have - ' . $count . ' posts on board.') }}
        @endif
    </div>
    <div class="post_list">
        <div class="page_actions header_actions">
            <div class="buttons">
                <a href="{{ route('my-admin-create-post') }}" class="button is-small is-primary">Create New</a>
            </div>
            <div class="filters">
                <ul class="filterlist">
                    <li>
                        <strong>Show Posts:</strong>
                        <div class="select is-primary">
                            <select class="showposts">
                                <option value="10" {{ !Request::get('showposts') || Request::get('showposts') == 10 ? 'selected' : null }}>10</option>
                                <option value="50" {{ Request::get('showposts') == 50 ? 'selected' : null }}>50</option>
                                <option value="100" {{ Request::get('showposts') == 100 ? 'selected' : null }}>100</option>
                                <option value="200" {{ Request::get('showposts') == 200 ? 'selected' : null }}>200</option>
                                <option value="400" {{ Request::get('showposts') == 400 ? 'selected' : null }}>400</option>
                            </select>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <table class="table is-bordered is-striped is-hoverable is-fullwidth admin_table">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Type</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ( $posts as $post )
                    <tr>
                        <th class="thumbnail">
                            @if ( Core::getPostMeta($post->id, 'post_thumbnail') )
                                <img src="{{ asset('public/uploads/' . Core::getPostMeta($post->id, 'post_thumbnail')->meta_value) }}" class="none" alt="{{ $post->title }}">
                            @else
                                <img src="{{ asset('public/includes/images/picture.svg') }}" class="none" alt="{{ __('No Thumbnail') }}">
                            @endif
                        </th>
                        <td class="title">
                            <a class="post_title" href="{{ route('my-admin-post-edit', [$post->id]) }}">{{ $post->title }}</a>
                            <div class="post_actions">
                                <ul class="post_actions_links">
                                    <li><a href="{{ route('my-admin-post-edit', [$post->id]) }}">Edit</a></li>
                                    <li><a href="{{ route('my-admin-post-delete', $post->id) }}" class="delete_post">Delete</a></li>
                                    <li><a href="{{ route('post', [$post->slug]) }}" target="_blank">View</a></li>
                                </ul>
                            </div>
                        </td>
                        @if($post->category_id)
                            <td class="category">{{ Core::getPostCategory($post->category_id)->name }}</td>
                        @else
                            <td class="category"></td>
                        @endif
                        <td class="author">{{ Core::getAuthor($post->user_id)->name }}</td>
                        <td class="comments">{{ Core::getComments('post_id', $post->id)->count() }}</td>
                        <td class="date">{{ date('F d, Y - H:i:s', strtotime($post->date)) }}</td>
                        <td class="type">{{ ucfirst($post->post_type) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="page_actions bottom">
            <div class="buttons">
                <a href="{{ route('my-admin-create-post') }}" class="button is-small is-primary">Create New</a>
            </div>
            <div class="links">
                {{ $posts->links('myadmin.partials.paginate') }}
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        // Show posts filter
        $('.select .showposts').on('change', function(){
            var value = $(this).val();
            if (value == 10) {
                window.location.replace('{{ Request::url() }}');
            } else {
                window.location.replace('{{ Request::url() }}?showposts=' + value);
            }
        });
        // Confirm deletion
        $('a.delete_post').on('click', function(e){
            if (confirm('Are you sure you want delete this item?')) {
                return true;
            } else {
                e.preventDefault();
            }
        });
    </script>
@endsection
