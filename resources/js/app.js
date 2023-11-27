import 'flowbite';
import Datepicker from 'flowbite-datepicker/Datepicker';

Hooks = {}

Hooks.Datepicker = {
    mounted() {
        const datepickerEl = this.el;
        new Datepicker(datepickerEl, {
            // options
        });
    },
    updated() {
        this.mounted();
    }
}
