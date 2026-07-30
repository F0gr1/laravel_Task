import axios from 'axios';
import $ from 'jquery';
import _ from 'lodash';
import Popper from 'popper.js';

window._ = _;
window.$ = window.jQuery = $;
window.Popper = Popper;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

await import('bootstrap');
