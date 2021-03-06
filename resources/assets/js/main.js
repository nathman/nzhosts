//browserify entrypoint

window.Vue = require('vue');

window.VueRouter = require('vue-router');

Vue.use(require('vue-resource'));

Vue.http.options.root = '/api';

var router = new VueRouter({
    history: true
});

var App = Vue.extend({
});


router.map({
    '/': {
        component: require('./components/home.vue')
    },
    '/about': {
        component: require('./components/about.vue')
    },
    '/contact': {
        component: require('./components/contact.vue'),
        subRoutes: {
            '/send': {
                component: require('./components/contact-sent.vue')
            },
            '/error': {
                component: require('./components/contact-error.vue')
            }
        }
    },
    '/suggest': {
        component: require('./components/suggest.vue'),
        subRoutes: {
            '/send': {
                component: require('./components/suggestion-sent.vue')
            },
            '/error': {
                component: require('./components/suggestion-error.vue')
            }
        }
    },
    '/host/:hostID': {
        name: 'host',
        component: require('./components/host.vue')
    }
});


router.redirect({
    // redirect any not-found route to home
    '*': '/'
});

router.start(App, 'body');