<template>

        <!-- Search Widget -->
        <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." v-model="textSearch" @keyup="sendEmit">
                    <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                </div>
            </div>
        </div>

</template>

<script>
export default {
    name:'SearchComponent',
    data(){
        return {
            textSearch:''
        }
    },
    methods:{
        sendEmit(){
            this.$emit('searchPost', this.textSearch);
        }
    }

}
</script>
