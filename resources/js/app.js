import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
import {
    Carousel,
    initTWE,
} from "tw-elements";

/* Pickr */
import '@simonwep/pickr/dist/themes/nano.min.css';
import Pickr from '@simonwep/pickr';

Alpine.start();

initTWE({ Carousel });

// Simple example, see optional options for more configuration.
const pickr = Pickr.create({
    el: '.color-picker',
    theme: 'nano',
    default: '#000',
    swatches: [],
    components: {
        preview: true,
        hue: true,
        interaction: {
            hex: true,
            input: true,
            clear: true,
            save: true
        },
    },
    i18n: {
        'btn:save': 'Guardar',
        'btn:cancel': 'Cancelar',
        'btn:clear': 'Limpiar',
    }
});
pickr.on('save', (color, instance) => {
    document.getElementById('color_hex').value = color.toHEXA().toString();
});
