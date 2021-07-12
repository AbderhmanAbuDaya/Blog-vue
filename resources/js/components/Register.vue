<template>
    <!--register-->
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form action="/examples/actions/confirmation.php" method="post" nonValidate>
                            <h2 class="text-center">Create New Account</h2>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="name"  v-model="name">
                                <div class="text-danger" v-show.keypass="nameError">
                                   ... the firstName is too short
                                </div>
                            </div>
<!--                            <div class="form-group">-->
<!--                                <input type="text" class="form-control" placeholder="lastname"  v-model="lastName">-->
<!--                                <div class="text-danger" v-show.keypass="lastNameError">-->
<!--                                    ... the lastName is too short-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="email"  v-model="email">
                                <div class="text-danger" v-show.keypass="emailError">
                                    ... the email is not valid
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password"  v-model="password">
                                <div class="text-danger" v-show.keypass="passwordError">
                                    ... the password is too short
                                </div>
                            </div>
                            <div class="form-group">
                                <button :disabled="!isValidForm" @click.prevent="submitRegister" type="submit" class="btn btn-primary btn-block">Create Account</button>
                            </div>
                            <div class="clearfix">
                                <a href="#" class="pull-right">Forgot Password?</a>
                            </div>
                        </form>

                        <p class="text-center">having account ?
                            <strong class="switch-tologin-modal" ><a href="#">Login</a></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name:"Register",
    data(){
        return {
            name:"",
            // lastName:"",
            email:"",
            password:"",
            profile_img:'profile_img.png'
        }
    },
    computed:{
        nameError(){
         return this.name.length>0&&this.name.length<4
        },
        // lastNameError(){
        //     return this.lastName.length>0&&this.lastName.length<4
        // },
        emailError(){

                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return !re.test(String(this.email).toLowerCase())&&this.email.length>0;

        },
        passwordError(){
            return this.password.length>0&&this.password.length<7
        },
        isValidForm(){
            return (this.password.length>=7 &&this.name.length>=4);
        }
    },
    methods:{
        submitRegister(){
            let {name,email,password,profile_img}=this;
            this.$store.dispatch('RegisterUser',{name,email,password});

        }
    }

}
</script>
