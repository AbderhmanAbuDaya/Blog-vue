/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import router from './routes/routes';
import Axios from 'axios';

window.axios = Axios;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('posts', require('./components/PostsComponent.vue').default);
Vue.component('global-home', require('./components/GlobalHome.vue').default);
Vue.component('categories-component', require('./components/CategoriesComponent.vue').default);
Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('register', require('./components/Register.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('AddPost', require('./components/admin/AddPost.vue').default);
Vue.component('EditPost', require('./components/admin/EditPost.vue').default);
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
     state:{
         userToken:null,
         user:null,
         editedPost: {},
         notifications:[]
     },
    getters:{
         isLogged(state){
             return !!state.userToken;
         },
        getUser(state){
             return state.user;
        },
        getEditPost(state){
             return state.editedPost;
        },
        getNotifications(state){
            return state.notifications;
        }

    },
    mutations:{
         setUserToken(state,userToken){
             state.userToken=userToken;
             localStorage.setItem('userToken',userToken);
             axios.defaults.headers.common.Authorization= `Bearer ${userToken}`
         },
        removeUserToken(state){
            state.userToken=null;
            localStorage.removeItem('userToken');
            axios.defaults.headers.common.Authorization='';
        },
        setUserData(state,userData){
             state.user=userData;
            Echo.connector.pusher.config.auth.headers.Authorization = `Bearer ${state.userToken}`;
            Echo.private('App.User.' + this.state.user.id)
                .notification((notification) => {
                    console.log('notify',notification);
                    state.notifications.unshift(notification);

                });

        },
        logout(state){
             state.userToken=null;
             state.user=null;
             localStorage.removeItem('userToken');
        },
        editPost(state,post){
             state.editedPost=post;
        }
    },
    actions:{
         RegisterUser({ commit, dispatch },payLoad){
             axios.post('/api/register',payLoad)
                 .then(res=>{
                     console.log(res)
                     commit('setUserToken',res.data.token);
                     dispatch('GetUser');

                 })
                 .catch(err =>{
                     console.log(err);
                 });

         },
        LoginUser({commit,dispatch},payLoad){
            axios.post('/api/login',payLoad)
                .then(res=>{
                    commit('setUserToken',res.data.token);
                    dispatch('GetUser');


                })
                .catch(err =>{
                    console.log(err);
                });

        },
        GetUser({commit,state},payLoad){
             if (state.userToken) {
                 axios.get('/api/user', null, {
                     Authorization: 'Bearer ' + localStorage.getItem('userToken')
                 }).then(res => {
                     commit('setUserData', res.data.user);
                 }).catch(err => {
                     console.log(err);
                 });
             }

        }
    }


});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router:router,
    store:store,
    created(){
        this.updateToken();
        this.user();
    },
    methods:{
        updateToken(){
            let token= localStorage.getItem('userToken');
            if (token)
            this.$store.commit('setUserToken',token);
        },
        user(){
            this.$store.dispatch('GetUser');
        },

    }
});

