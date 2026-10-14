<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <script>
    (() => {
        const media = matchMedia('(prefers-color-scheme: dark)');

        const apply = () => {
            const dark = media.matches;
            document.documentElement.classList.toggle('dark', dark);
            document.documentElement.style.colorScheme = dark ? 'dark' : 'light';
        };

        try {
            localStorage.removeItem('themeMode');
        } catch (_) {}

        apply();
        media.addEventListener('change', apply);
    })();
    </script>
    <?php wp_head(); ?>
</head>