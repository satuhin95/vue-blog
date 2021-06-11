<template lang="">
        <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-6" v-for="post in posts">
            <div class="single-blog-wrap" >
                <div class="blog-thumb">
                    <img :src="imageLink(post.image)" alt="Blog">
                </div>
                <div class="blog-text">
                    <div class="post-meta">
                       <router-link  :to="`/post/${post.slug}`"><i class="fa fa-user"></i> {{post.user.name}}</router-link>
                        <router-link  :to="`/post/${post.slug}`"><i class="fa fa-clock-o" aria-hidden="true"></i> {{post.created_at|time}}</router-link>
                    </div>
                    <h4><router-link  :to="`/post/${post.slug}`">{{post.title}}</router-link></h4>
                    <p>{{post.content|subString(200,'...')}}</p>
                    <router-link  :to="`/post/${post.slug}`" class="load-more">Read More <i class="fa fa-angle-right"></i></router-link>
                </div>
            </div>
        </div>
      
    </div>
</template>
<script>
export default {
    name:"Category",
        data(){
       return{
            posts:[],
        }
    },
    mounted(){
      this.getCategoryPost();
    },
    watch:{
        $route(){
            this.getCategoryPost();
        }
    },
  
    computed:{ },
    methods:{
        getCategoryPost(){
          let slug =this.$route.params.slug;
          axios.get('/get-post-by-category/' + slug)
          .then((response)=>{
            this.posts = response.data.posts;

          })
        }
         
    }
}
</script>
<style lang="">
    
</style>