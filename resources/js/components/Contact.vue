<template>
    <div class="container intro-container">

        <div class="">
            <div class="col-sm-8 form-container p-5 border mb-2" >
                <h2 class="mb-3" style="    text-decoration: underline;">Our Contact information :</h2>
                <h6>Address: <strong> address example</strong></h6>
                <h6>Email: <strong> example@email.com</strong></h6>
            </div>
            <div class="col-sm-8 form-container p-5 border mb-2" >


                <h2 style="    text-decoration: underline;">Contact us</h2>
                <form action="/action_page.php">
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" class="form-control" id="name" v-model="name">
                        <div class="text-danger" v-show.keypass="nameError">
                            ... the name is required
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email :</label>
                        <input type="email" class="form-control" id="email" v-model="email">
                        <div class="text-danger" v-show.keypass="emailError">
                            ... the email is not valid
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject :</label>
                        <input type="subject" class="form-control" id="subject" v-model="subject">

                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea name="content" cols="30" rows="10" id="message"  v-model="message"
                                  class="form-control"></textarea>

                    </div>
                    <button  type="submit" @click.prevent="sendEmail" class="btn btn-primary btn-block">Send</button>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
</template>

<script>
export default {
    data(){
        return {
            name:'',
            email:'',
            subject:'',
            message:''

        }
    },
    computed:{
        nameError(){
          return this.name.length >0 && this.name.length <4;
        },
        emailError(){
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return !re.test(String(this.email).toLowerCase())&&this.email.length>0;
        },
        isValidForm(){
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            let value= re.test(String(this.email).toLowerCase())&&this.email.length>0;
            return !(this.name.length<=4 && value);
        }
    },
    methods:{
        sendEmail(){
            let {name,email,subject,message} = this;
             axios.post('/api/sendEmail/',{name,email,subject,message})
                  .then(res=>{
                        if (res.data.msg =="ok"){
                            alert('successful to send message')
                            this.email='';
                            this.name='';
                            this.subject='';
                            this.message='';
                        }
                  })
                 .catch(err=>{
                     console.log(err);
                 });
        }
    }
}
</script>

<style>

</style>
