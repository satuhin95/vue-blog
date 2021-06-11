<template lang="">
    <div>
        <div class="sidebar-area">
                            <!-- Single Sidebar Start -->
        <!-- <div class="single-sidebar">
            <div class="search-form">
                <form action="index.html">
                    <input type="text" placeholder="Search..">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div> -->
        <!-- Single Sidebar End -->
        <!-- Single Sidebar Start -->
        <div class="single-sidebar">
            <h3 class="sidebar-title">Categories</h3>
            <div class="sidebar-body">
                <ul class="sidebar-list">
                    <li v-for="cat in categories"><router-link :to="`/category/${cat.slug}`"> {{cat.name}}</router-link></li>
               
                </ul>
            </div>
        </div>
        <!-- Single Sidebar End -->
    </div>
        
    </div>
</template>
<script>
export default {
    name:"Sidebar",
       data(){
      return{
       
      }
    },
    mounted(){
      this.$store.dispatch("getActiveTopCategories");
    },
    watch:{
    },
    computed:{
      categories(){
      return  this.$store.getters.getActiveTopCategories;
      }
    },
}
</script>
<style lang="">
    
</style>