<template>
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">Page Heading
                    <small>Secondary Text</small>
                </h1>
                <div class="media simple-post" v-for="post in filterPosts" :key="post.id">

                    <img class="mr-3" :src="'/assets/img/'+post.image" alt="Generic placeholder image">
                    <div class="media-body">
                        <h4 class="mt-0"><router-link :to="'/post/'+post.slug">{{ post.title}}</router-link></h4>
                        {{post.body}}
                        <ul class="list-inline list-unstyled d-flex post-info">
                            <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary" v-if="post.user">{{post.user.name}}</strong> </span></li>
                            <li>|</li>
                            <li><span><i class="fa fa-calendar"></i>{{post.created_at}} </span></li>
                            <li>|</li>
                            <span><i class="fa fa-comment"></i> {{ post.numComments }} comments</span>

                        </ul>
                    </div>

                </div>
                <!-- Pagination -->
<!--                <nav aria-label="...">-->
<!--                    <ul class="pagination float-right">-->
<!--                        <li class="page-item disabled">-->
<!--                            <span class="page-link">Previous</span>-->
<!--                        </li>-->
<!--                        <li class="page-item"><a class="page-link" href="#">1</a></li>-->
<!--                        <li class="page-item active">-->
<!--              <span class="page-link">-->
<!--                2-->
<!--                <span class="sr-only">(current)</span>-->
<!--              </span>-->
<!--                        </li>-->
<!--                        <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--                        <li class="page-item">-->
<!--                            <a class="page-link" href="#">Next</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </nav>-->

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">


                <search-component @searchPost="searchEmit"></search-component>

                <categories-component @passPostInCategory="equalPosts"></categories-component>


            </div>

        </div>
        <!-- /.row -->
    </div>


</template>

<script>
export default {
    data(){
        return {
            posts:[],
            filterPosts:[]

        }
    },

    mounted() {
        console.log('Component mounted.');

        this.getPosts();
    },
    methods:{
        getPosts(){
            this.$router.push('/postCategory/'+this.$route.params.slug+'/posts').catch(()=>{
                console.log("error");
            });
            axios.get('/api/postCategory/'+this.$route.params.slug+'/posts')
                .then(res=>{
                   // console.log(res);

                    this.posts=res.data;
                    this.filterPosts=this.posts;


                })
                .catch(err=>console.log(err));
        },
        equalPosts(e){
            axios.get('/api/postCategory/'+e+'/posts')
                .then(res=>{

                    this.posts=res.data;
                    this.filterPosts=this.posts;

                    // console.log('in Category:'+this.passPostInCategory);
                })
                .catch(err=>console.log(err));
            },

        searchEmit(e){
            console.log(e.trim());

            if (e.trim()  !=''){
                this.filterPosts=this.posts.filter(function (el){
                    return el.title.match(e.trim());
                });
            }else{
                this.filterPosts=this.posts;
            }
        }
    },

}
</script>
