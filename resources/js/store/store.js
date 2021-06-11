import Axios from "axios";

export default{
    state: {
       categoryData:[],
       postData:[],
      },
      getters: {
        categories(state){
            return state.categoryData;
        },
        posts(state){
          return state.postData;
      },
      getPost(state){
          return state.postData;
      },

      getActiveTopCategories(state){
        return state.categoryData;
      }
      },
      actions:{
        getCategories(data){
          axios.get('get-categories')
          .then((response)=>{
            data.commit('categories',response.data.categories)

          }).catch((error)=>{
          });
        },
        getActiveCategories(data){
          axios.get('get-active-categories')
          .then((response)=>{
            data.commit('categories',response.data.categories)

          }).catch((error)=>{
          });
        },
        getActiveTopCategories(data){
          axios.get('get-active-top-categories')
          .then((response)=>{
            data.commit('activeTopCategories',response.data.categories)

          }).catch((error)=>{
          });
        },
        getPosts(data){
          axios.get('get-posts')
          .then((response)=>{
           
            data.commit('posts',response.data.posts)

          }).catch((error)=>{
          });
        },
        getAllPosts(data){
          axios.get('get-all-posts')
          .then((response)=>{
           
            data.commit('posts',response.data.posts)

          }).catch((error)=>{
          });
        }
      },
      mutations: {
        categories(state,data){
          return state.categoryData = data;
        },
        activeTopCategories(state,data){
          return state.categoryData = data;
        },
        
        
        posts(state,data){
          return state.postData = data;
        }
      }
}