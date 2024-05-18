import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
import {
    Carousel,
    initTWE,
} from "tw-elements";

Alpine.start();

// Initialization for ES Users
initTWE({ Carousel });
