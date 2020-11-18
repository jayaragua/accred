/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import router from './router'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import common from './common'
import moment from 'moment'
import store from './store';

import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy)

// import Vuetable from 'Vuetable';
// import VuetablePagination from 'VuetablePagination';
// import VuetablePaginationDropdown  from 'VuetablePaginationDropdown';

// import iviewTablePage from 'iview-table-page'

// import iviewTablePage from 'iview-table-page'

// Vue.use(iviewTablePage)

// Vue.use(Table)
// Vue.use(Input)


Vue.mixin(common)


Vue.use(ViewUI);


Vue.config.productionTip = false
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY')
  }
});

Vue.component('mainapp', require('./components/mainapp.vue').default);

// Vue.component('vuetable', Vuetable);
// Vue.component('vuetable-pagination', VuetablePagination)
// Vue.component('vuetable-pagination-dropdown', VuetablePaginationDropdown)

const app = new Vue({
    el: '#app',
    router,
    store, 
});


  
