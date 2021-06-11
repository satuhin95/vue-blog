<template lang="">
    <div>
         <div class="singleblog-page-content">
            <h2>{{post.title}}</h2>
            <div class="blog-thumb">
                <img :src="imageLink(post.image)"alt="Blog">
            </div>
            <div class="post-meta">
                <a href="#"><i class="fa fa-user"></i> {{post.user.name}}</a>
                <a href="#"><i class="fa fa-clock-o" ></i> {{post.created_at|time}}</a>
            </div>
            <p v-html="post.content"></p>

     
        </div>

    </div>
</template>
<script>
export default {
    name:'PostDetails',
      data(){
       return{
            post:{},
        }
    },
    mounted(){
      this.getPost();
    },
    computed:{ },
    methods:{
        getPost(){
          let slug =this.$route.params.slug;
          axios.get('/get-post/' + slug)
          .then((response)=>{
            this.post = response.data;

          })
        }
         
    }
}
</script>
<style lang="">
    
</style>