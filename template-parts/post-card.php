<?php
// Path: template-parts/post-card.php

$thumbnail_url  = get_the_post_thumbnail_url();
$title          = get_the_title();
$link           = get_the_permalink();

$excerpt        = (function(){
    if (has_excerpt()) {
        $text = get_the_excerpt();
    } else {
        $text = get_post_field('post_content', get_the_ID());
    }
    $text = wp_strip_all_tags((string) $text);
    return wp_trim_words($text, 24, '…');
})();


?>

<div class="item-article wow fadeInUp">
    <figure>
        <?php
        if (has_post_thumbnail()) {
            echo get_the_post_thumbnail(
                get_the_ID(),
                'medium_large',
                ['alt' => esc_attr($title)]
            );
        }
        ?>
    </figure>

    <div class="txt-article">
        <span><?php echo esc_html(get_the_date()); ?></span>
        <h5><?php echo esc_html($title); ?></h5>
        <p><?php echo esc_html($excerpt); ?></p>
        <a href="<?php echo esc_url($link); ?>"><?php echo esc_html__('Read more', 'adeco'); ?></a>
    </div>
</div>