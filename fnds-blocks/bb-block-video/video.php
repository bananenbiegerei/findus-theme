<?php
// Support both block context and template part $args
$video_file = $args['video'] ?? get_field('video');
$color_scheme = $args['color_scheme'] ?? get_field('color_scheme_color_scheme') ?: 'primary';
$autoplay = $args['autoplay'] ?? get_field('autoplay') ?: false;
$loop = $args['loop'] ?? get_field('loop') ?: false;
$aspect_ratio = $args['aspect_ratio'] ?? get_field('aspect_ratio') ?: 'default';
$cover_image_id = $args['cover_image'] ?? get_field('cover_image') ?: false;
$block_id = isset($block['id']) ? $block['id'] : 'video-' . uniqid();

// Get cover image URL for poster (twelve-columns-din-landscape size)
$cover_image_url = $cover_image_id ? wp_get_attachment_image_url($cover_image_id, 'twelve-columns-din-landscape') : '';

// Build video attributes
$video_attrs = 'playsinline';
if ($autoplay) {
    $video_attrs .= ' autoplay muted';
}
if ($loop) {
    $video_attrs .= ' loop';
}
if ($cover_image_url) {
    $video_attrs .= ' poster="' . esc_url($cover_image_url) . '"';
}

// Build container classes
$container_classes = 'bb-block-video w-full rounded-lg md:rounded-xl overflow-hidden';
if ($aspect_ratio && $aspect_ratio !== 'default') {
    $container_classes .= ' ' . $aspect_ratio;
}

// Build video classes
$video_classes = 'plyr-video';
if ($aspect_ratio && $aspect_ratio !== 'default') {
    $video_classes .= ' w-full h-full object-cover';
}

// In WordPress backend, show cover image as placeholder
if (is_admin() && $cover_image_url): ?>
<div class="<?= $container_classes ?>" id="<?= esc_attr($block_id) ?>">
    <div class="relative">
        <img src="<?= esc_url($cover_image_url) ?>" alt="Video cover" class="w-full h-full object-cover rounded-lg md:rounded-xl">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-black/50 rounded-full p-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
            </div>
        </div>
    </div>
</div>
<?php elseif ($video_file): ?>
<div class="<?= $container_classes ?>" id="<?= esc_attr($block_id) ?>" style="--plyr-color-main: var(--color-<?= esc_attr($color_scheme) ?>);">
    <video class="<?= $video_classes ?>" <?= $video_attrs ?>>
        <source src="<?php echo esc_url($video_file['url']); ?>" type="<?php echo esc_attr($video_file['mime_type']); ?>">
        Your browser does not support the video tag.
    </video>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('<?= esc_js($block_id) ?>');
    const video = container.querySelector('.plyr-video');
    if (video && window.Plyr) {
        new window.Plyr(video, {
            controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
            autoplay: <?= $autoplay ? 'true' : 'false' ?>,
            muted: <?= $autoplay ? 'true' : 'false' ?>,
            loop: { active: <?= $loop ? 'true' : 'false' ?> },
        });
    }
});
</script>
<?php endif; ?>
