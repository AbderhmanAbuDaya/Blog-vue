<template>
    <!-- Edit Modal HTML -->
    <div id="addPostModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Post</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>title</label>
                            <input type="text" class="form-control" v-model="title">
                            <div class="alert-danger" v-if="allValidate||titleValidate">
                                title is require
                            </div>
                        </div>
                        <div class="form-group">
                            <label>body</label>
                            <textarea v-model="body" name=""  cols="30" class="form-control"
                                      rows="10"></textarea>
                            <div class="alert-danger" v-if="allValidate||bodyValidate">
                                body is require
                            </div>
                        </div>
                        <div class="form-group">
                            <label>category</label>
                            <select name="" class="form-control" v-model="category" >
                                <option v-if="categories" v-for="cate in categories" :value="cate.id" :key="cate.id" >{{cate.name}}</option>
                            </select>
                            <div class="alert-danger" v-if="allValidate||categoryValidate">
                                category is require
                            </div>
                        </div>
                        <div class="form-group">
                            <label>image</label>
                            <input type="file" name="image" class="form-control" @change="onChangeImage($event)" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add" @click.prevent="addPost">
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
             title:'',
             body:'',
             category:'',
             image:'',
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
         addPost(){
             let config= {
                 headers:{"content-type":"multipart/form-data"}
             };
             let formData=new FormData();
             formData.append('title',this.title);
             formData.append('body',this.body);
             formData.append('category',this.category);
             formData.append('image',this.image);
             console.log(formData);
             axios.post('api/admin/addPost',formData,config)
             .then(res=>{
                 console.log(res.data);
                this.$emit('showPostAdded', res.data.post)
                 this.title='';
                 this.body='';
                 this.category='';
                 this.image='';
                 $('#addPostModal').removeClass('show');
                 $('.modal-backdrop').css('display','none');

             }).catch(err=>{
                 console.log(err);
             });
         },
         onChangeImage(event){
            var  $image=event.target.files[0];
            this.image=$image;
         }
     }
 }
</script>
