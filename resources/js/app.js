import './bootstrap';

import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Swal = Swal;

// Dialog konfirmasi bergaya SweetAlert2, dipakai lewat Alpine di blade:
// @click="confirmAction('Yakin?').then(ok => ok && $wire.someAction())"
window.confirmAction = function (message, options = {}) {
    return Swal.fire({
        title: options.title ?? 'Konfirmasi',
        text: message,
        icon: options.icon ?? 'warning',
        showCancelButton: true,
        confirmButtonText: options.confirmText ?? 'Ya, Lanjutkan',
        cancelButtonText: 'Batal',
        confirmButtonColor: options.confirmColor ?? '#e11d48',
        cancelButtonColor: '#9ca3af',
        reverseButtons: true,
        focusCancel: true,
    }).then((result) => result.isConfirmed);
};
