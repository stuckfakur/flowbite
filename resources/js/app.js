import 'flowbite';
import Pikaday from 'pikaday';
import moment from 'moment';
import { createPopper } from "@popperjs/core";

window.createPopper = createPopper;
window.Pikaday = Pikaday;
window.moment = moment;



//
// document.addEventListener('DOMContentLoaded', function() {
//     var picker = new Pikaday({
//         field: document.getElementById('datepicker'),
//         format: 'YYYY-MM-DD',
//         onSelect: function(date) {
//             window.Livewire.dispatch('dateSelected', date);
//         }
//     });
// });


