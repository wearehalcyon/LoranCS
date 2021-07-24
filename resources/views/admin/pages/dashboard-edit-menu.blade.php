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
            <h3 class="open_links active" data-type="posts">Posts</h3>
            <ul id="posts" class="post_list active">
                @if(Core::getPosts('post'))
                    @foreach(Core::getPosts('post') as $post)
                        <li>
                            <a class="choose_link_item" href="{{ asset($post->slug) }}" data-url="{{ asset($post->slug) }}" >
                                {{ $post->title }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <p>{{ __('Posts not found') }}</p>
                @endif
            </ul>
            <h3 class="open_links" data-type="pages">Pages</h3>
            <ul id="pages" class="post_list">
                @if(Core::getPosts('post'))
                    @foreach(Core::getPosts('page') as $post)
                        <li>
                            <a class="choose_link_item" href="#" data-url="{{ asset($post->slug) }}" >
                                {{ $post->title }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <p>{{ __('Posts not found') }}</p>
                @endif
            </ul>
            <h3 class="open_links" data-type="categories">Categories</h3>
            <ul id="categories" class="post_list">
                @if(Core::getCategories())
                    @foreach(Core::getCategories() as $category)
                        <li>
                            <a class="choose_link_item" href="#" data-url="{{ asset('/category/' . $category->slug) }}" >
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <p>{{ __('Posts not found') }}</p>
                @endif
            </ul>
        </div>
        <div class="create_menu_content">
            <form action="{{ route('my-admin-edit-menu-submit') }}" method="POST" class="submit_menu_form">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
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
                    <span class="edit_menu_field_desc">{{ __('Please don\'t use any specific symbols. Only words, numbers or underscores.') }}</span>
                </div>
                <div class="formcontroll">
                    <h3>{{ __('Menu Items') }}</h3>
                    <span class="edit_menu_field_desc">{{ __('Use parent field for detecting submenu items.') }}</span>
                </div>
                <div class="formcontroll">
                    <div id="repeater">
                        @if($menu_items)
                            @foreach($menu_items as $item)
                                <div class="items"  data-group="menu_item" data-index="{{ $item->order }}">
                                    <div class="menu_item_rpt">
                                        <div class="menu_field_input_order">
                                            <input class="input is-small menu_order" type="text" name="menu_item[{{ $item->order }}][menu_order]" data-name="menu_order" value="{{ $item->order }}" placeholder="1" id="menu_item_{{ $item->order }}_menu_order">
                                        </div>
                                        <div class="menu_field_input">
                                            <input class="input is-small menu_title" type="text" name="menu_item[{{ $item->order }}][menu_title]" data-name="menu_title" value="{{ $item->title }}" placeholder="Home" id="menu_item_{{ $item->order }}_menu_title">
                                        </div>
                                        <div class="menu_field_input">
                                            <input class="input is-small menu_url" type="text" name="menu_item[{{ $item->order }}][menu_url]" data-name="menu_url" value="{{ $item->url }}" placeholder="#" id="menu_item_{{ $item->order }}_menu_url">
                                        </div>
                                        <div class="menu_field_input_parent">
                                            <input class="input is-small menu_parent" type="text" name="menu_item[{{ $item->order }}][menu_parent]" data-name="menu_parent" value="{{ $item->parent }}" id="menu_item_1_menu_parent">
                                        </div>
                                        <div class="delete_input">
                                            <a href="javascript:;" data-action-remove="{{ route('my-admin-remove-menu-item-submit', [$item->id]) }}">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="items" data-group="menu_item">
                                <div class="menu_item_rpt">
                                    <input type="hidden" value="{{ $menu->id }}" name="menu_id" data-name="menu_id">
                                    <div class="menu_field_input_order new_input">
                                        <input class="input is-small menu_order" type="text" name="menu_order" data-name="menu_order" value="1" placeholder="1">
                                    </div>
                                    <div class="menu_field_input">
                                        <input class="input is-small menu_title" type="text" name="menu_title" data-name="menu_title" placeholder="Home">
                                    </div>
                                    <div class="menu_field_input">
                                        <input class="input is-small menu_url" type="text" name="menu_url" data-name="menu_url" placeholder="#">
                                    </div>
                                    <div class="menu_field_input_parent">
                                        <input class="input is-small menu_parent" type="text" name="menu_parent" data-name="menu_parent" value="0">
                                    </div>
                                    <div class="delete_input">
                                        <a href="javascript:;" onclick="$(this).parents('.items').remove()">{{ __('Remove') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="repeater-heading">
                            <a href="javascript:;" class="button is-small is-outlined repeater-add-btn">
                                {{ __('Add menu item') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="submit_new_menu">
                    <button type="submit" class="button is-small is-link is-outlined">{{ __('Update Menu') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script type="text/javascript" src="{{ asset('public/includes/admin/js/repeater.js') }}"></script>
    <script>
        // Repeater
        $("#repeater").createRepeater();
        // Confirm deletion menu
        $('a.delete_menu').on('click', function(e){
            if (confirm('Are you sure you want delete this menu?')) {
                return true;
            } else {
                e.preventDefault();
            }
        });
        // Confirm deletion menu item
        $('.delete_input a').on('click', function(e){
            if (confirm('Are you sure you want delete this menu item?')) {
                $(this).parents('.items').remove();
                var url = $(this).data('action-remove');

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: url,
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'link': url},
                    success: function(response){
                        console.log(response)
                    }
                });
            } else {
                e.preventDefault();
            }
        });
        // Menu list accordion
        $('.create_menu_sidebar h3').on('click', function(){
            var target = $(this).data('type');
            if( $(this).hasClass('active') ){
                $(this).removeClass('active');
                $('#' + target).removeClass('active');
            } else {
                $('.create_menu_sidebar h3.open_links, .post_list').each(function(){
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                    }
                });
                $(this).addClass('active');
                $('#' + target).addClass('active');
            }
        });
    </script>
@endsection
