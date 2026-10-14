<nav class="bb-navbar-animated fixed left-0 w-full z-50 transition-all duration-500 ease-out"
    x-data="{ open: false, scrolled: false, nearBottom: false }"
    @scroll.window="
        scrolled = window.scrollY > 1;
        nearBottom = (window.scrollY + window.innerHeight) >= (document.body.scrollHeight - 100);
    "
    :class="[
        nearBottom ? 'opacity-0 md:opacity-100 pointer-events-none md:pointer-events-auto' : 'opacity-100',
        scrolled ? 'text-xl pb-4 px-4 top-full -translate-y-full md:translate-y-0 md:top-4' : 'top-0 translate-y-0 text-xl lg:text-3xl'
    ]">
    <div class="mx-auto h-full transition-all duration-500 ease-out"
        :class="scrolled ? 'max-w-sm md:max-w-xl bg-white/60 dark:bg-black/60 backdrop-blur-lg shadow-lg rounded-lg' : 'max-w-screen-2xl bg-white/60 dark:bg-black/60 backdrop-blur-lg rounded-b-lg md:rounded-b-xl'">
        <div class="flex items-center h-full justify-between transition-all duration-500 ease-out flex-wrap py-4 px-6 gap-4">
            <!-- Menu (single, responsive) -->
            <div class="items-center gap-6 flex w-full md:w-auto md:order-2" :class="open ? 'flex' : 'max-md:hidden'">
                <?php
                wp_nav_menu([
                    'theme_location' => 'top',
                    'container' => false,
                    'menu_class' => 'flex flex-col gap-2 md:gap-4 md:flex-row font-medium',
                    'fallback_cb' => false,
                ]);
                ?>
            </div>
            <!-- Logo -->
            <div class="flex items-center flex-1 md:shrink-0 md:order-1">
                <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
                <?php else : ?>
                <a href="<?= esc_url(home_url('/')) ?>" class=" font-medium">
                    <?= esc_html(get_bloginfo('name')) ?>
                </a>
                <?php endif; ?>
            </div>

            <!-- Hamburger (mobile only) -->
            <button type="button" class="size-8 shrink-0 btn-icon-outline  md:hidden" :aria-expanded="open"
                @click="open = !open">
                <span class="sr-only"><?php esc_html_e('Open main menu', 'flavor'); ?></span>
                <svg x-show="!open" class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="open" x-cloak class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</nav>
