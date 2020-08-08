window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('jquery/dist/jquery');
    require('@fancyapps/fancybox/dist/jquery.fancybox');
    require('@fortawesome/fontawesome-free/js/all');
    require('jquery.easing/jquery.easing');
    require('jquery.easing/jquery.easing.compatibility');
    require('jquery-scrollify/jquery.scrollify');
    require('../vendor/form');
} catch (e) {}
