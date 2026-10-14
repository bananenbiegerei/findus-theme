<nav class="bb-navbar-simple fixed top-0 left-0 w-full z-50" x-data="{ open: false }">
    <div class="container bg-white/80 dark:bg-black/80 backdrop-blur-xl rounded-b-lg md:rounded-b-xl">
        <div class="flex items-center gap-4 justify-between flex-wrap p-4">
            <!-- Logo -->
            <div class="flex items-center flex-1 md:shrink-0">
                <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
                <?php else : ?>
                <a href="<?= esc_url(home_url('/')) ?>" class="text-xl">
                    <?= esc_html(get_bloginfo('name')) ?>
                </a>
                <?php endif; ?>
            </div>

            <button type="button" aria-label="Toggle dark mode" data-tooltip="Toggle dark mode" data-side="bottom"
                    onclick="document.dispatchEvent(new CustomEvent('basecoat:theme'))" class="md:order-3 btn-icon-outline size-8 flex-shrink">
                    <span class="hidden dark:block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4" />
                            <path d="M12 2v2" />
                            <path d="M12 20v2" />
                            <path d="m4.93 4.93 1.41 1.41" />
                            <path d="m17.66 17.66 1.41 1.41" />
                            <path d="M2 12h2" />
                            <path d="M20 12h2" />
                            <path d="m6.34 17.66-1.41 1.41" />
                            <path d="m19.07 4.93-1.41 1.41" />
                        </svg></span>
                    <span class="block dark:hidden"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                        </svg></span>
                </button>

            <!-- Hamburger (mobile only) -->
            <button type="button" class="shrink-0 btn-icon-ghost md:hidden bg-white size-8" :aria-expanded="open"
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

            <!-- Menu (single, responsive) -->
            <div class="items-center gap-6 flex w-full md:w-auto md:order-2" :class="open ? 'flex' : 'max-md:hidden'">
                <?php
                wp_nav_menu([
                    'theme_location' => 'top',
                    'container' => false,
                    'menu_class' => 'flex flex-col gap-4 md:flex-row text-xl',
                    'fallback_cb' => false,
                ]);
                ?>
            </div>

        </div>
    </div>
</nav>
