<template>
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="my-4">Page Heading
                    <small>Secondary Text</small>
                </h1>
    <div class="media simple-post" v-for="post in filterPosts.data" :key="post.id">

        <img class="mr-3" :src="'assets/img/'+post.image" alt="Generic placeholder image">
        <div class="media-body">
            <h4 class="mt-0"><router-link :to="'/post/'+post.slug">{{ post.title}}</router-link></h4>
            {{post.body}}
            <ul class="list-inline list-unstyled d-flex post-info">
                <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary">{{post.user.name}}</strong> </span></li>
                <li>|</li>
                <li><span><i class="fa fa-calendar"></i>{{post.created_at}} </span></li>
                <li>|</li>
                <span><i class="fa fa-comment"></i> {{ post.numComments }} comments</span>

            </ul>
        </div>

    </div>
                <!-- Pagination -->
                <pagination :data="filterPosts" @pagination-change-page="getPosts"></pagination>


            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">


                <search-component @searchPost="searchEmit"></search-component>

                <categories-component ></categories-component>


            </div>

        </div>
        <!-- /.row -->
    </div>


</template>

<script>
    export default {
        data(){
           return {
               posts:{},
               filterPosts:{},

           }
           },

        mounted() {
            this.getPosts();
        },
        methods:{
            getPosts(page = 1){
                axios.get('/api/post?page='+page)
                    .then(res=>{
                        this.posts=res.data;
                        this.filterPosts=this.posts;
                        console.log(this.posts.data);

                    })
                    .catch(err=>console.log(err));

            },
            equalPosts(e){
                console.log(e)
            },
            searchEmit(e){
                if (e.trim()  !=''){
                   // console.log(Object.values(this.posts['1']));

                this.filterPosts= {
                    data: this.posts.data.filter(function (el) {

                        return el.title.match(e.trim());
                    })
                }
                    console.log(this.filterPosts);
                }else{
                    this.filterPosts=this.posts;
                }
            }
        }
    }
</script>
