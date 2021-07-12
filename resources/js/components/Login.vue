 <template>
         <!--login-->
         <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <div class="login-form">
                             <form action="/examples/actions/confirmation.php" method="post">
                                 <h2 class="text-center">Log in</h2>
                                 <div class="form-group">
                                     <input type="email" class="form-control" placeholder="email" v-model="email">
                                     <div class="text-danger" v-show.keypass="emailError">
                                         ... the email is not valid
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <input type="password" class="form-control" placeholder="Password" v-model="password">
                                     <div class="text-danger" v-show.keypass="passwordError">
                                         ... the password is too short
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <button :disabled="!isValidForm" @click.prevent="submitLogin" type="submit" class="btn btn-primary btn-block">Log in</button>
                                 </div>
                                 <div class="clearfix">
                                     <a href="#" class="pull-right">Forgot Password?</a>
                                 </div>
                             </form>
                             <p class="text-center"><a class="switch-toregister-modal" href="#">Create an Account</a></p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

 </template>

 <script>
 export default {
     name:"Login",
     data(){
         return {

             email:"",
             password:"",
         }
     },
     computed:{

             emailError(){

                 const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                 return !re.test(String(this.email).toLowerCase())&&this.email.length>0;

             },
             passwordError(){
                 return this.password.length>0&&this.password.length<6
             },
             isValidForm(){
                 return (this.password.length>=6&&this.email);
             }
     },
     methods:{
         submitLogin(){
             let {email,password}=this;
         this.$store.dispatch('LoginUser',{email,password});

         }
     }

 }
 </script>
