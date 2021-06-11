<template lang="">
    <div>
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 offset-md-2">
                    <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">All Category</h3>
                <div class="card-tools">
                        <router-link to="/category-add" class="btn  btn-info"><i class="fas fa-plus"></i></router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th><input type="checkbox" :disabled="emptyData()" @click="selectAll" v-model="selectedAll"/></th>
                      <th>Sl</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category,index) in categories">
                      <td><input type="checkbox" :value="category.id" v-model="selected"/></td>
                      <td>{{++index}}</td>
                      <td>{{category.name}}</td>
                      <td>{{category.slug}}</td>
                      <td><span class="badge" :class="statusColor(category.status)">{{statusName(category.status)}}</span></td>
                      <td>{{category.created_at| time}}</td>
                      <td>
                        <router-link :to="`/category-edit/${category.id}`" class="btn btn-info btn-sm">Edit</router-link>
                         <button type="button" class="btn btn-danger btn-sm" @click="removeCategory(category.id)">Delete</button>
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
                      <td colspan="7">
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
      this.$store.dispatch("getCategories");
    },
    watch:{
      selected(selected){
        this.isSelected = (selected.length > 0);
        this.selectedAll = (selected.length=== this.categories.length);
      }
    },
    computed:{
      categories(){
      return  this.$store.getters.categories;
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
        removeCategory(id){
          this.confirm(() => {
              axios.get('remove-category/' + id )
              .then((response)=>{
                this.$store.dispatch("getCategories");
                // toastr.success( 'Category Delete successfully')
              }).catch((error)=>{ });
              Swal.fire(
                'Deleted!',
                'Your data has been deleted.',
                'success'
              )
          })
          
        },
        emptyData(){
          return (this.categories.length < 1);
        },
        selectAll(event){
          if(event.target.checked == false){
            this.selected =[];
          }else{
            this.categories.forEach((category)=>{
              this.selected.push(category.id);
            });
          }
        },
        removeItems(selected){
          this.confirm(() => {
          
          axios.post('/category/remove-items',{ data : selected })
          .then((response)=>{
                this.selected=[];
                this.isSelected=false;
                this.selectedAll=false;
            this.$store.dispatch("getCategories");
            toastr.success(response.data.total + ' Category Delete successfully')
          });
          });
        },
        changeStatus(selected,status){
           axios.post('/category/change-status',{ data : selected,status:status })
          .then((response)=>{
                this.selected=[];
                this.isSelected=false;
                this.selectedAll=false;
            this.$store.dispatch("getCategories");
            toastr.success(response.data.total + ' Category Status successfully')
          });
        }
    }
}
</script>
<style lang="">
    
</style>