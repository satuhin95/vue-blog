
import Vue from 'vue'
Vue.mixin({
methods:{
    confirm(callback){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) callback();
          })
    },
    loadImage(e){
      let file = e.target.files[0];
      let reader = new FileReader();

       reader.onload = e => {
       this.form.image = e.target.result;
     };
       reader.readAsDataURL(file);
     },
     imageLink(name){
         
      return 'upload/image/' + name; 
   
  },
  subStrWithHTML(text,length,s){
    return text.substring(0,length) + s; 
}
}
});