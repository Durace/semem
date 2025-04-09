import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


import Swal from 'sweetalert2';
window.Swal = Swal;


import './Pages/assets/assets/libs/jquery/dist/jquery.min'

import './Pages/assets/assets/libs/bootstrap/dist/js/bootstrap.bundle.min'
import './Pages/assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min'
import './Pages/assets/assets/extra-libs/sparkline/sparkline'

import './Pages/assets/dist/js/waves'

import './Pages/assets/dist/js/sidebarmenu'

import './Pages/assets/dist/js/custom.min'

import './Pages/assets/assets/libs/flot/excanvas'
import './Pages/assets/assets/libs/flot/jquery.flot'
import './Pages/assets/assets/libs/flot/jquery.flot.pie'
import './Pages/assets/assets/libs/flot/jquery.flot.time'
import './Pages/assets/assets/libs/flot/jquery.flot.stack'
import './Pages/assets/assets/libs/flot/jquery.flot.crosshair'
import './Pages/assets/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min'
import './Pages/assets/dist/js/pages/chart/chart-page-init'


