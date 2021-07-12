<template>
    <!-- Edit Modal HTML -->
    <div id="editPostModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form enctype="multipart/form-data" novalidate >
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Post</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>title</label>
                            <input type="text" class="form-control" v-model="editPost.title">
                        </div>
                        <div class="form-group">
                            <label>body</label>
                            <textarea name=""  cols="30" class="form-control"
                               v-model="editPost.body"       rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label>category</label>
                            <select name="" class="form-control" v-if="editPost.category" v-model="editPost.category.id" >
                                <option  :value="cate.id" v-if="categories.length>0" v-for="cate in categories"  >{{cate.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>image</label>
                            <input type="file" class="form-control" @change="onChangeImage($event)" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn " value="Save" @click.prevent="updatePost">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            categories:[]
        }
    },
    computed:{
        titleValidate(){
            return !!this.title;
        },
        bodyValidate(){
            return  !!this.body;
        },
        categoryValidate(){
            return !!this.category;
        } ,
        allValidate(){
            return  this.titleValidate && this.bodyValidate && this.categoryValidate;
        },
        editPost(){
            return  this.$store.getters.getEditPost;

        }
    },
    created() {
        this.getCategory();
    },
    methods:{
        getCategory(){
            axios.get('api/admin/categories')
                .then(res=>{
                    this.categories=res.data
                    console.log(res);
                }).catch(err=>{
                console.log(err);
            });
        },
        updatePost(){
            let config= {
                headers:{"content-type":"multipart/form-data"}
            };
            let formData=new FormData();
            formData.append('title',this.editPost.title);
            formData.append('id',this.editPost.id);
            formData.append('body',this.editPost.body);
            formData.append('category',this.editPost.category.id);
            formData.append('image',this.editPost.image);
            console.log(formData);
            axios.post('api/admin/updatePost',formData,config)
                .then(res=>{
                    this.editPost.image=res.data.post.image;
                    $('#editPostModal').removeClass('show');
                    $('.modal-backdrop').css('display','none');


                }).catch(err=>{
                console.log(err);
            });
        },
        onChangeImage(event){
            var  $image=event.target.files[0];
            this.editPost.image=$image;
        }
    }
}
</script>
