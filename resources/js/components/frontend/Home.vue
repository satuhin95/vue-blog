<template lang="">
<div>
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-6" v-for="post in posts.data">
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
                    <div v-html="subStrWithHTML(post.content,100,'...')"></div>
                    <router-link  :to="`/post/${post.slug}`" class="load-more">Read More <i class="fa fa-angle-right"></i></router-link>
                </div>
            </div>
            

        </div>
    </div>
    <pagination :data="posts" @pagination-change-page="getResults"></pagination>
    </div>
</template>
<script>
export default {
    name:"Home",
       data(){
      return{
       posts:{}
      }
    },
    // mounted(){
    //   this.$store.dispatch("getAllPosts");
    // },
    // watch:{
    // },
    // computed:{
    //   posts(){
    //   return  this.$store.getters.getPost;
    //   }
    // },
  

    	mounted() {
		// Fetch initial results
		this.getResults();
	},

	methods: {
		// Our method to GET results from a Laravel endpoint
		getResults(page = 1) {
			axios.get('get-all-posts?page=' + page)
				.then(response => {
					this.posts = response.data;
				});
		},
        
	}
}
</script>
<style lang="">
    
</style>