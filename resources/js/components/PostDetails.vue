<template>
 <div class="container">
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4">Page Heading
                <small>Secondary Text</small>
            </h1>
     <!-- Post Content Column -->

         <!-- Title -->
         <h1 class="mt-4">{{ post.title }}</h1>


         <!-- Author -->
         <p class=" alert alert-info" style="width: fit-content;
        padding: 5px;
        color: #142d31;" v-if="post.category">{{ post.category.name}}
         </p>

         <hr>

         <!-- Date/Time -->
         <p>Posted on <strong class="badge badge-primary p-1">{{ post.created_at }}</strong>
             <span class="float-right"><strong class="badge badge-info p-1">{{comments.length}}</strong> comments</span></p>

         <hr>

         <!-- Preview Image -->
         <img class="img-fluid rounded" :src="'http://localhost:8000/assets/img/'+post.image" style="width:900px;max-height:300px" alt="">

         <hr>

         <!-- Post Content -->
     <p class="lead">{{post.body}}</p>


         <hr>

         <!-- Comments Form -->
         <div class="card my-4">
             <h5 class="card-header">Leave a Comment:</h5>
             <div class="card-body">
                 <input type="hidden" name="post_id" v-model="post_id" >
                 <form>
                     <div class="form-group">
                         <textarea class="form-control" v-model="body" rows="3"></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary" @click.prevent="addComment">Submit</button>
                 </form>
             </div>
         </div>

         <!-- Single Comment -->
         <div class="media mb-4 comment" v-if="post.comments" v-for="(comment,index) in post.comments" :key="index">
             <img class="d-flex mr-3 rounded-circle" :src="comment.user.profile_img" style="width: 50px;height: 50px" alt="">
             <div class="media-body">
                 <h5 class="mt-0" v-if="comment.user">{{comment.user.name}}</h5>
                 {{comment.body}}             </div>
         </div>


            <!-- Pagination -->
            <nav aria-label="...">
                <ul class="pagination float-right">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
              <span class="page-link">
                2
                <span class="sr-only">(current)</span>
              </span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

           <search-component></search-component>

           <categories-component></categories-component>


        </div>

    </div>
    <!-- /.row -->
     </div>
</template>

<script>

import SearchComponent from "./SearchComponent";
import CategoriesComponent from "./CategoriesComponent";
export default {
    components: {CategoriesComponent, SearchComponent},
    methods:{
    getPost(){
        axios.get('/api/post/'+this.$route.params.slug)
             .then(res=> {
                 console.log(res.data);
                 this.post=res.data;
                 this.post_id=this.post.id;
                 this.comments=this.post.comments;
                 this.initializeListener();


             })
             .catch(err=>console.log(err));
    },
        addComment(){

            console.log(this.$store.getters.getUser);
        let {body,post_id,user_id}=this;
           axios.post('/api/comment/create',{body,post_id,user_id}).then(res=>{
               console.log(res);
               this.comments.unshift(res.data);
           }).catch(err=>console.log(err) );
        },
        initializeListener(){
            Echo.private(`newComment.${this.post_id}`)
                .listen('NewComment', (e) => {
                    console.log(e);
                    this.comments.unshift(e.comment)

                    document.querySelectorAll('.comment').forEach(item =>{
                        item.classList.remove('new')
                    })
                    document.querySelectorAll('.comment')[0].classList.add('new')
                    console.log('listen to new comment event');
                });
        }

},
    created() {
        console.log("aaaaaaaaaaaaaaaaaaaaaa")
        console.log(this.$store.state.user);
     this.getPost();

    },
    computed:{
      isLogged(){
          return this.$store.getters.isLogged;
      }
    },
    data(){
      return {
          post:{},
          body:'',
          post_id:'',
          comments:[]
      }
    },


}
</script>
<style scoped>
.comment{
    padding: 0.5rem;
    background: #fff;
}
/* The element to apply the animation to */
.comment.new {
    background-color: #fff;
    animation-name: newComment ;
    -webkit-animation-name: newComment;
    animation-duration: 6s;
    -webkit-animation-duration: 6s;
    animation-iteration-count: 1;
    -webkit-animation-iteration-count: 1;
}
@keyframes newComment {
    from {background-color: rgb(241, 245, 24);}
    to {background-color: inherit;}
}
</style>
