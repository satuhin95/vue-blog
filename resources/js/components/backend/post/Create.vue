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
                    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Post</h3>
                <div class="card-tools">
                        <router-link to="/post" class="btn  btn-info"><i class="fas fa-eye"></i></router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <form class="form-horizontal" @submit.prevent="addPost">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="category_id" class="col-sm-2 col-form-label"> Category</label>
                    <div class="col-sm-10">
                      <select id="category_id" v-model="form.category_id" class="form-control">
                        <option value="" >Select Category</option>
                        <option :value="cat.id" v-for="cat in categories">{{cat.name}}</option>
                      </select>
                        <div v-if="form.errors.has('category_id')" v-html="form.errors.get('category_id')" />

                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label"> Title</label>
                    <div class="col-sm-10">
                      <input type="text" v-model="form.title" class="form-control" id="title" placeholder="Title">
                        <div v-if="form.errors.has('title')" v-html="form.errors.get('title')" />

                    </div>
                  </div>
                    <div class="form-group row">
                    <label for="content" class="col-sm-2 col-form-label"> Content</label>
                    <div class="col-sm-10">
                    <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
                        <div v-if="form.errors.has('content')" v-html="form.errors.get('content')" />

                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="file" class="col-sm-2 col-form-label"> Image</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="image" name="image" @change="loadImage($event)" >
                        <div v-if="form.errors.has('image')" v-html="form.errors.get('image')" />

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
                        <img :src="form.image" width="100px" alt="">
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    data(){
        return{
            form : new Form({
                title:null,
                category_id: null,
                content:null,
                image:null,
                status:1
            }),
              editor: ClassicEditor,
                editorConfig: {},
        }
    },
    mounted(){
      this.$store.dispatch("getActiveCategories");
    },
    computed:{
      categories(){
      return  this.$store.getters.categories;
      }
    },
    methods:{
        addPost(){
        // let  test = this;
            this.form.post('/add-post')
            .then((response)=>{
              // console.log(response.data);
              //   Toast.fire({
              //   icon: 'success',
              //   title: 'Category Create successfully'
              // })
              toastr.success('Success!', 'Post Create successfully')

              // test.form.name=null;
              // test.form.status=null;
              this.$router.push('/post');
            })
        }
       
    }
}
</script>
<style lang="">
    
</style>