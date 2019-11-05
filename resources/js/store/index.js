import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
Vue.use(require('vue-moment'));

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
  state: {
    posts: [],
  },

  actions: {
    async getAllPosts({ commit }) {
      return commit('setPosts', await axios.get('/post/all'))
    },
  },

  mutations: {
    setPosts(state, response) {
      state.posts = response.data.data;
    },
  },
  strict: debug
});