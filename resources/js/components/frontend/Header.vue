<template lang="">
    <div>
          <header id="header-area">
        <!-- PreHeader Area Start -->
        <div class="preheader-area home__2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                      
                    </div>

                    <div class="col-lg-6 text-center d-none d-lg-block">
                        <div class="preheader-item phone-mail">
                            <a href="#"><i class="fa fa-phone"></i>+009 998 885 550</a>
                            <a href="#"><i class="fa fa-envelope"></i>rajuahammad73@gmail.com</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 text-right">
                        <div class="preheader-item">
                            <div class="preheader-icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-vimeo"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PreHeader Area End -->

        <!-- Header Bottom Area Start -->
        <div class="header-bottom" id="fixheader">
            <div class="container">
                <div class="row">
                    <!-- Logo Area Start -->
                    <div class="col-lg-2">
                        <router-link to="/" class="logo-area">
                            <img src="img/logo.png" alt="Logo">
                        </router-link>
                    </div>
                    <!-- Logo Area End -->

                    <!-- Menu Area Start -->
                    <div class="col-lg-10">
                        <nav class="mainmenu pull-right">
                            <ul>
                                <li><router-link to="/"> Home</router-link> </li>
                                <li v-for="cat in categories"><router-link :to="`/category/${cat.slug}`"> {{cat.name}}</router-link></li>
                                
                            </ul>
                        </nav>
                    </div>
                    <!-- Menu Area End -->

                </div>
            </div>
        </div>
        <!-- Header Bottom Area End -->
    </header>
    </div>
</template>
<script>
export default {
    name:'Header',
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