window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {

    // require('bootstrap');
    require('jquery/dist/jquery');
    require('../vendor/ajax');
    require('../vendor/custom-js');
    require('../vendor/MetaServices');
    require('../vendor/MetaProjects');
    require('../vendor/media-uploader');
    require('../vendor/options-custom');
    require('@fortawesome/fontawesome-free/js/all');
} catch (e) {}