// Import Tailwind CSS (plain CSS for proper v4 processing)
import '../css/tailwind.css';
// Import additional SCSS styles
import '../scss/site.scss';

// Import utilities
import * as TW from './tailwindhelpers';

// Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Swiper (import only if needed)
import Swiper from 'swiper';
import { Navigation, Pagination, Keyboard, Autoplay, EffectFade, Thumbs } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Make Swiper available globally for inline scripts
window.Swiper = Swiper;
window.SwiperModules = { Navigation, Pagination, Keyboard, Autoplay, EffectFade, Thumbs };

// Swiper configuration object for blocks
window.SwipersConfig = window.SwipersConfig || {};

// Initialize Swipers after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
	for (const [selector, config] of Object.entries(window.SwipersConfig)) {
		const element = document.querySelector(selector);
		if (element) {
			const swiperContainer = element.querySelector('.swiper-container');
			if (swiperContainer) {
				new Swiper(swiperContainer, {
					modules: [Navigation, Pagination, Keyboard, Autoplay, EffectFade, Thumbs],
					...config,
				});
			}
		}
	}
});
