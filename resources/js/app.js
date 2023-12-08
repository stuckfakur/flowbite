import 'flowbite';
import Pikaday from 'pikaday';

document.addEventListener('DOMContentLoaded', function() {
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-DD',
        onSelect: function(date) {
            window.Livewire.dispatch('dateSelected', date);
        }
    });
});
