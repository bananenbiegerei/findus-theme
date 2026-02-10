//import * as TW from './tailwindhelpers';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

// Swiper core + modules
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper';

// Plyr video player
import Plyr from 'plyr';

// Make Swiper available globally for block scripts
window.Swiper = Swiper;
window.Navigation = Navigation;
window.Pagination = Pagination;
window.Autoplay = Autoplay;
window.EffectFade = EffectFade;

// Make Plyr available globally for block scripts
window.Plyr = Plyr;

// Swiper styles loaded via CSS (src/css/site.css)

// Set fixed aspect ratio on .wp-block-columns via explicit height
function applyColumnsAspectRatio() {
	const ratio = 1.414 / 1;
	document.querySelectorAll('.xxwp-block-group-is-layout-grid').forEach((el) => {
		el.style.height = el.offsetWidth / ratio + 'px';
	});
}
applyColumnsAspectRatio();
window.addEventListener('resize', applyColumnsAspectRatio);

// Init Alpine
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();
