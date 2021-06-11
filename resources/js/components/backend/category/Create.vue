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
                <div class="col-md-8 offset-md-2">
                    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Category</h3>
                <div class="card-tools">
                        <router-link to="/category" class="btn  btn-info"><i class="fas fa-eye"></i></router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <form class="form-horizontal" @submit.prevent="addCategory">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label"> Name</label>
                    <div class="col-sm-10">
                      <input type="text" v-model="form.name" class="form-control" id="name" placeholder="Name">
                        <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />

                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="status"  class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="active" value="1" v-model="form.status">
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  id="inactive" type="radio" value="0" v-model="form.status">
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
                          <div v-if="form.errors.has('status')" v-html="form.errors.get('status')" />
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" :disabled="form.busy" class="btn btn-info">Save</button>
                  <button type="reset" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>
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
    data(){
        return{
            form : new Form({
                name:null,
                status:1
            }),
        }
    },
    methods:{
        addCategory(){
        let  test = this;
            this.form.post('/add-Category')
            .then(function(data){
              //   Toast.fire({
              //   icon: 'success',
              //   title: 'Category Create successfully'
              // })
              toastr.success('Success!', 'Category Create successfully')

              test.form.name=null;
              test.form.status=null;
              // test.$router.push('/category');
            })
        }
    }
}
</script>
<style lang="">
    
</style>