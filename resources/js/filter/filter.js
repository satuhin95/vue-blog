import moment from 'moment';
import Vue from 'vue'
Vue.filter('time',(d)=>{
 return moment(d).format("MMM Do YYYY");  
});

Vue.filter('subString',(content,len,s)=>{
    return content.substring(0,len) + s;  
   });

   
