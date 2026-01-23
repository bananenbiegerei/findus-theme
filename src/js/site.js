//import * as TW from './tailwindhelpers';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

// Swiper core + modules
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper';

// Make Swiper available globally for block scripts
window.Swiper = Swiper;
window.Navigation = Navigation;
window.Pagination = Pagination;
window.Autoplay = Autoplay;
window.EffectFade = EffectFade;

// Swiper styles loaded via CSS (src/css/site.css)

// Init Alpine
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();
