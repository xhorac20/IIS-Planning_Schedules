import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function cancelCreateUser() {
    window.location.href = "{{ route('users.index') }}";
}
