<template>
    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6" v-for="(category,index) in categories" :key="index">
                    <ul class="list-unstyled mb-0">
                        <li>
                          <router-link :to="'/postCategory/'+category.slug+'/posts'" ><a  @click="sendEvent(category.slug)">{{category.name}}</a></router-link>
                        </li>
                    </ul>
                </div>
<!--                <div class="col-lg-6">-->
<!--                    <ul class="list-unstyled mb-0">-->
<!--                        <li>-->
<!--                            <a href="#">JavaScript</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">Laravel tutorial</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">bootstrap</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'CategoriesComponent',
    data(){
        return{
            categories:{},
            passPostInCategory:[]
        }
    },
    created() {
        this.getCategory();
    },
    methods:{
        getCategory(){
            axios.get('/api/category')
                 .then(res=>{
                     this.categories=res.data
                 })
                 .catch(err=>console.log(err));
        },
        sendEvent(slug){
            //console.log("inside")

            this.$emit('passPostInCategory',slug);
        }

    }
}
</script>
