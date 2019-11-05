require('./bootstrap');

window.Vue = require('vue');
import store from './store/index';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-post', require('./components/post/create.vue').default);
Vue.component('all-posts', require('./components/post/posts.vue').default);
Vue.component('view-post', require('./components/post/post.vue').default);

const app = new Vue({
    store,
    el: '#app',
});
