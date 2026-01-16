<?php
/**
 * Template Name: Components Test
 * Description: Test template to preview all BB components with sample data
 */

get_header();
?>

<div class="container py-10">
    <h1 class="mb-10">BB Components Test</h1>

    <!-- Heading -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Heading Component</h2>
        <hr class="mb-6">
        <?php
        // Simulate flexible content row data
        $GLOBALS['bb_test_data'] = [
            'headline' => 'This is a Test Headline',
            'level' => 'h2',
            'anchor_title' => 'test-headline',
            'headline_link' => '',
            'headline_size' => 'h2',
            'bg_color' => 'none',
            'text_color' => 'none',
            'container_width' => 'default'
        ];
        include BB_BLOCKS_PATH . '/bb-block-heading/heading.php';
        ?>
    </section>

    <!-- Paragraph -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Paragraph Component</h2>
        <hr class="mb-6">
        <?php
        $GLOBALS['bb_test_data'] = [
            'paragraph' => '<p>This is a sample paragraph with some <strong>bold text</strong> and <em>italic text</em>. It demonstrates how the paragraph component renders rich text content. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
            'text_size' => 'base',
            'text_color' => 'default'
        ];
        include BB_BLOCKS_PATH . '/bb-block-paragraph/paragraph.php';
        ?>
    </section>

    <!-- Button -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Button Component</h2>
        <hr class="mb-6">
        <div class="space-y-4">
        <?php
        // Primary button
        $GLOBALS['bb_test_data'] = [
            'link' => ['title' => 'Primary Button', 'url' => '#', 'target' => '_self'],
            'size' => 'base',
            'position' => 'justify-start',
            'icon' => 'arrow-right',
            'color' => 'primary',
            'style' => 'default'
        ];
        include BB_BLOCKS_PATH . '/bb-block-button/button.php';

        // Secondary outline
        $GLOBALS['bb_test_data'] = [
            'link' => ['title' => 'Secondary Outline', 'url' => '#', 'target' => '_self'],
            'size' => 'base',
            'position' => 'justify-start',
            'icon' => 'none',
            'color' => 'secondary',
            'style' => 'outline'
        ];
        include BB_BLOCKS_PATH . '/bb-block-button/button.php';

        // Ghost button
        $GLOBALS['bb_test_data'] = [
            'link' => ['title' => 'Ghost Button', 'url' => '#', 'target' => '_self'],
            'size' => 'sm',
            'position' => 'justify-start',
            'icon' => 'info',
            'color' => 'neutral',
            'style' => 'ghost'
        ];
        include BB_BLOCKS_PATH . '/bb-block-button/button.php';
        ?>
        </div>
    </section>

    <!-- Spacer -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Spacer Component</h2>
        <hr class="mb-6">
        <div class="bg-neutral-100 p-4">
            <p class="text-sm text-neutral-500">Content before spacer (xs)</p>
            <?php
            $GLOBALS['bb_test_data'] = ['size' => 'xs', 'add_divider' => false];
            include BB_BLOCKS_PATH . '/bb-block-spacer/spacer.php';
            ?>
            <p class="text-sm text-neutral-500">Content after spacer</p>
        </div>
        <div class="bg-neutral-100 p-4 mt-4">
            <p class="text-sm text-neutral-500">Content before spacer (lg with divider)</p>
            <?php
            $GLOBALS['bb_test_data'] = ['size' => 'lg', 'add_divider' => true];
            include BB_BLOCKS_PATH . '/bb-block-spacer/spacer.php';
            ?>
            <p class="text-sm text-neutral-500">Content after spacer</p>
        </div>
    </section>

    <!-- Blockquote -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Blockquote Component</h2>
        <hr class="mb-6">
        <?php
        $GLOBALS['bb_test_data'] = [
            'text' => 'Design is not just what it looks like and feels like. Design is how it works.',
            'source' => 'Steve Jobs',
            'title' => 'Co-founder of Apple',
            'image' => null
        ];
        include BB_BLOCKS_PATH . '/bb-block-blockquote/blockquote.php';
        ?>
    </section>

    <!-- Accordion -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Accordion Component</h2>
        <hr class="mb-6">
        <?php
        $GLOBALS['bb_test_data'] = [
            'accordion_items' => [
                ['title' => 'What is ACF?', 'content' => '<p>Advanced Custom Fields (ACF) is a WordPress plugin that allows you to add custom fields to your content.</p>'],
                ['title' => 'What is Flexible Content?', 'content' => '<p>Flexible Content is a field type in ACF Pro that allows you to create layouts with multiple sub-fields that can be reordered.</p>'],
                ['title' => 'How does this work?', 'content' => '<p>Each component is a layout within the flexible content field. Editors can add, remove, and reorder components as needed.</p>']
            ]
        ];
        ?>
        <div class="bb-accordion-block mb-10">
            <ul>
                <?php foreach ($GLOBALS['bb_test_data']['accordion_items'] as $item): ?>
                <li>
                    <details>
                        <summary class="lg:text-xl py-6 cursor-pointer border-b border-neutral-light pr-10">
                            <?= esc_html($item['title']) ?>
                        </summary>
                        <div class="my-5 accordion-content">
                            <?= $item['content'] ?>
                        </div>
                    </details>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- Image (placeholder) -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Image Component</h2>
        <hr class="mb-6">
        <div class="bb-image-block my-4">
            <figure class="flex flex-col relative">
                <div class="bg-neutral-200 rounded-2xl flex items-center justify-center" style="height: 300px;">
                    <span class="text-neutral-500">Image Placeholder - Add an image via the editor</span>
                </div>
            </figure>
        </div>
    </section>

    <!-- Video (placeholder) -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Video Component</h2>
        <hr class="mb-6">
        <div class="bg-neutral-900 rounded-2xl flex items-center justify-center" style="height: 300px;">
            <span class="text-neutral-400">Video Placeholder - Add a video via the editor</span>
        </div>
    </section>

    <!-- Gallery Lightbox (placeholder) -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Gallery Lightbox Component</h2>
        <hr class="mb-6">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="aspect-w-1 aspect-h-1 bg-neutral-200 rounded-2xl flex items-center justify-center">
                <span class="text-neutral-500 text-sm">Image <?= $i ?></span>
            </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- Gallery Swiper (placeholder) -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Gallery Swiper Component</h2>
        <hr class="mb-6">
        <div class="flex items-center mb-4">
            <div class="grow">
                <h2 class="text-primary">Sample Swiper Gallery</h2>
            </div>
            <div class="relative flex space-x-2 items-center">
                <span class="text-neutral-400">← 1/4 →</span>
            </div>
        </div>
        <div class="bg-neutral-200 rounded-2xl flex items-center justify-center" style="height: 400px;">
            <span class="text-neutral-500">Swiper Gallery - Add images via the editor</span>
        </div>
    </section>

    <!-- Group -->
    <section class="mb-16">
        <h2 class="text-sm uppercase tracking-wide text-neutral-500 mb-4">Group Component</h2>
        <hr class="mb-6">
        <div class="bb-group-block bg-primary-light p-6 rounded-lg">
            <p class="text-neutral-700">This is a group component with a primary-light background. Groups can be used to visually organize content sections.</p>
        </div>
    </section>

</div>

<?php get_footer(); ?>
