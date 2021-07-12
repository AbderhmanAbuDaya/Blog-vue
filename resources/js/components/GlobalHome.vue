<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Ayat Amine</a>
            <notification></notification>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active" v-if="userData" v-show="userData.is_admin">
                        <router-link class="nav-link" to="/admin"  >Admin
                            <span class="sr-only">(current)</span>
                        </router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/">Home
                            <span class="sr-only">(current)</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">blog</a>
                    </li>
                    <li class="nav-item">
                        <router-link to="/contact" class="nav-link" >Contact</router-link>
                    </li>



                    <li v-if="!isLogged" class="nav-item reg-login-btn" data-toggle="modal" data-target="#login-modal">
                        <a class="btn btn-primary text-weight nav-link" href="#">Login</a>
                    </li>


                    <li  v-if="!isLogged" class="nav-item register-btn reg-login-btn" data-toggle="modal" data-target="#register-modal">
                        <a class="btn btn-info nav-link"  data-toggle="modal" data-target="#register-modal"href="">Register</a>
                    </li>
                    <li class="nav-item dropdown"   >
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            v-if="userData" @click="isShow=false" >
                            {{userData.name}}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" id="logoutID" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               @click="logout()" >
                                Logout
                            </a>


                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <router-view :passPosts="this.passPosts"  ></router-view>
</div>
</template>

<script>
import notification from './Notification.vue'
export default {

name:'GlobalHome',

    data(){
    return {
        passPosts:[],
        isShow:true

    }

    },
    components:{
    notification
    },
    computed:{
        isLogged(){
            return this.$store.getters.isLogged;
        },
        userData(){
             return  this.$store.getters.getUser;
        }
    },
    methods:{
        logout(){
            this.$store.commit('logout');
            document.getElementById('logoutID').classList.remove('show')
        }
    }

}
</script>
