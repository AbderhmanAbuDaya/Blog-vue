import Vue from 'vue';
import VueRouter from 'vue-router'
  Vue.use(VueRouter);
import PostsComponent from "../components/PostsComponent";
import  PostDetails  from "../components/PostDetails";
import PostsInCategory from "../components/PostsInCategory";
import AdminIndex from "../components/admin/AdminIndex";
import AllNotifications from "../components/AllNotifications";
import ContactUs from "../components/Contact";

const routes=[
    {path:'/',component:PostsComponent,name:'Post'},
    {path:'/post/:slug',component: PostDetails,name:'PostDetails'},
    {path:'/postCategory/:slug/posts',component:PostsInCategory ,name:'PostsInCategory'},
    {path:'/admin',component:AdminIndex ,name:'AdminIndex'},
    {path:'/allNotifications',component:AllNotifications},
    {path:'/contact',component:ContactUs},


];
const router =new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'

});
export default router;


