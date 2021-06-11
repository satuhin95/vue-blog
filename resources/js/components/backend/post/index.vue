<template lang="">
    <div>
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Post</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">All Post</h3>
                <div class="card-tools">
                        <router-link to="/post-add" class="btn  btn-info"><i class="fas fa-plus"></i></router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                    <th><input type="checkbox" :disabled="emptyData()" @click="selectAll" v-model="selectedAll"/></th>
                      <th>Sl</th>
                      <th>User</th>
                      <th>Category</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(post,index) in posts">
                      <td><input type="checkbox" :value="post.id" v-model="selected"/></td>
                      <td>{{++index}}</td>
                      <td>{{post.user.name}}</td>
                      <td>{{post.category.name}}</td>
                      <td>{{post.title| subString(10,'...')}}</td>
                      <td>{{post.content|subString(20,'...')}}</td>
                      <td>
                        <img :src="imageLink(post.image)" alt="Img" width="100px">
                      </td>
                      <td><span class="badge" :class="statusColor(post.status)">{{statusName(post.status)}}</span></td>
                      <td>{{post.created_at| time}}</td>
                      <td style="width:130px">
                        <router-link :to="`/post-edit/${post.id}`" class="btn btn-info btn-sm">Edit</router-link>
                         <button type="button" class="btn btn-danger btn-sm" @click="removePost(post.id)">Delete</button>
                      </td>
                    </tr>
                     <tr v-if="!emptyData()">
                      <td colspan="7">
                          <div class="dropdown">
                        <button type="button" :disabled="!isSelected" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                          Action
                        </button>
                        <div class="dropdown-menu">
                          <button type="button" @click="changeStatus(selected,1)" class="dropdown-item">Active</button>
                          <button type="button" @click="changeStatus(selected,0)" class="dropdown-item">Inactive</button>
                          <button type="button" @click="removeItems(selected)" class="dropdown-item">Remove</button>
                        </div>
                      </div>
                      </td>
                    </tr>
                    <tr v-if="emptyData()">
                      <td colspan="9">
                        <h2 class="text-center text-danger">Data not found!!</h2>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                </div>
                
            </div>
            
        </div>
     

    </section>
    <!-- /.content -->
    </div>
</template>
<script>
export default {
    name:'index',
    data(){
      return{
        selected:[],
        isSelected:false,
        selectedAll:false,
      }
    },
    mounted(){
      this.$store.dispatch("getPosts");
    },
     watch:{
      selected(selected){
        this.isSelected = (selected.length > 0);
        this.selectedAll = (selected.length=== this.posts.length);
      }
    },
    computed:{
      posts(){
      return  this.$store.getters.posts;
      }
    },
    methods:{
      statusName(status){
        let data ={0:"Inactive",1:"Active"};  
          return data[status]
        },
        statusColor(status){
        let data ={0:"bg-danger",1:"bg-success"};  
          return data[status]
        },
        removePost(id){
          this.confirm(() => {
            axios.get('remove-post/' + id )
                .then((response)=>{
                  this.$store.dispatch("getPosts");
                  // toastr.success( 'Category Delete successfully')
                }).catch((error)=>{ });
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
          });
          
        },
        emptyData(){
          return (this.posts.length < 1);
        },

        selectAll(event){
          if(event.target.checked == false){
            this.selected =[];
          }else{
            this.posts.forEach((post)=>{
              this.selected.push(post.id);
            });
          }
        },
        removeItems(selected){
          this.confirm(() => {
          
          axios.post('/post/remove-items',{ data : selected })
          .then((response)=>{
                this.selected=[];
                this.isSelected=false;
                this.selectedAll=false;
            this.$store.dispatch("getPosts");
            toastr.success(response.data.total + ' Post Delete successfully')
          });
          });
        },
        changeStatus(selected,status){
           axios.post('/post/change-status',{ data : selected,status:status })
          .then((response)=>{
                this.selected=[];
                this.isSelected=false;
                this.selectedAll=false;
            this.$store.dispatch("getPosts");
            toastr.success(response.data.total + ' Post Status successfully')
          });
        },
        imageLink(name){
          return 'upload/image/' + name; 
        }
    }
}
</script>
<style lang="">
    
</style>