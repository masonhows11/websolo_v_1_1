import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();
// for add bootstrap js file
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
// import 'bootstrap/dist/js/bootstrap.bundle.min';

// for load jquery
global.$ = global.jQuery = require('jquery');

// for load sweet_alert2 as global
import swal from 'sweetalert2';
window.Swal = swal;
