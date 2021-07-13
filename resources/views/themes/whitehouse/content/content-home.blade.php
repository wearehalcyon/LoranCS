<h3 class="section_title">{{ __('Latest Posts') }}</h3>
<?php
    $posts = Core::getPosts();
    if ($posts) :
?>
    <div class="latest_posts">
        <?php foreach ($posts as $post) : ?>
            <div class="post-id-{{ $post->id }} post-name-{{ $post->slug }} single_post">
                <div class="article_header">
                    <a href="{{ Core::getHomeUrl($post->slug) }}" title="{{ $post->title }}" class="single_post_title">{{ $post->title }}</a>
                    <p class="post_meta"><i>Author: </i>{{ Core::getAuthor($post->user_id)->name }} | <i>Published: </i>{{ Core::getTime('F d, Y (H:i)', $post->date) }}</p>
                </div>
                <div class="single_post_content">
                    {{ Core::trimWords($post->content, 300, '...') }}
                </div>
                <div class="readmore">
                    <a href="{{ Core::getHomeUrl($post->slug) }}">{{ __('Read More') }}</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
