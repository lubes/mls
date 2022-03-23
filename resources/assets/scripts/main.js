// import external dependencies
import 'jquery';

// Import everything from autoload
import 'bootstrap';

// Import Datatables
import 'datatables.net';
// import 'datatables.net-buttons';
import 'datatables.net-colreorder';
import './plugins/pdfmake.js';
import './plugins/vfs_fonts';
// import 'datatables.net-bs';

import 'datatables.net-bs5';
// import '../plugins/dataTables.bootstrap.min.js';
import 'datatables.net-buttons/js/buttons.colVis.js';
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-buttons/js/buttons.print.js';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
