<template>
    <section class="content">
        <hr>
        <vue-good-table
            :columns="Columns"
            :rows="Posts"
             max-height="600px"
            :line-numbers="true"
            styleClass="vgt-table bordered condensed nocturnal custom-table"
            :search-options="{
                  enabled: true,
                }"
            :sort-options="{
                enabled: false,
                initialSortBy: {field: 'created_at', type: 'dsc'}
              }"
              :pagination-options="{
                enabled: true,
                mode: 'records',
                position: 'bottom',
                perPage: 10
              }"
              :select-options="{
                enabled: false,
              }"
            >
            <!-- <div slot="table-actions"  v-if="!Posts.length"> -->
            <div slot="table-actions"  >
                <button :class="loadclass()" @click.prevent="NewPostModal()" title="Add New Post">Add New Post <i class="fas fa-plus fw"></i></button>
            </div>
            <template slot="table-row" slot-scope="props">

                <span v-if="props.column.field == 'action'">
                    <span @click="EditPostModal(props.row)"   class="text-warning" style="text-decoration: undurline; cursor: pointer;">
                        <i class="far fa-edit text-danger" aria-hidden="true"> </i>
                    </span>
                </span>
            </template>
        </vue-good-table>
        <!-- post -->
        <div class="modal fade " id="PostModal" tabindex="-1" role="dialog" aria-labelledby="PostModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content" >
                  <form role="form" class="vld-parent" ref="formContainer" @submit.prevent="editmodePost ? updatePost() : addPost()" >
                      <div class="modal-body">
                          <div class="text-center">
                              <h2><label for="name" v-show="!editmodePost" class="uppercase col-form-label">New Post</label></h2>
                              <h2><label for="name" v-show="editmodePost" class="uppercase col-form-label">Edit Post</label></h2>
                              <div class="alert alert-danger" v-if="postform.errors.has('error')">
                                  <div class="text-red" v-html="postform.errors.get('error')"></div>
                               </div>
                          </div>
                           <div class="row">
                                <div class="col-md-6 form-group">
                                        <label for="title" class="uppercase col-form-label">Post Title</label>
                                        <input v-model="postform.title" id="title" type="text" class="form-control  text-blue-500" placeholder="Post Title" name="title" >
                                        <div class="text-red" v-if="postform.errors.has('title')" v-html="postform.errors.get('title')" />
                                </div>
                                <div class="col-md-6 form-group">
                                        <label for="website_id" class="uppercase col-form-label">Select Website</label>
                                        <select v-model="postform.website_id" class="form-control">
                                            <option disabled value=""  class="form-control">Please select one</option>
                                            <option v-for="website in Websites" :key="website.id" :value="website.id" class="form-control"> {{ website.name }}</option>
                                        </select>
                                        <div class="text-red" v-if="postform.errors.has('website_id')" v-html="postform.errors.get('website_id')" />
                                </div>
                                <div class="col-md-12 form-group">
                                        <label for="description" class="uppercase col-form-label">Post url</label>
                                        <textarea v-model="postform.description" id="url" type="text" class="form-control  text-blue-500" placeholder="Post description" name="last_name1" ></textarea>
                                        <div class="text-red" v-if="postform.errors.has('description')" v-html="postform.errors.get('description')" />
                                </div>
                            </div>
                      </div>
                      <div v-show="!editmodePost" class="modal-footer">
                          <button type="button" :class="loadclass()" class="text-red-600 border-red-200 hover:bg-red-600 focus:ring-red-600 " data-dismiss="modal">Close</button>
                          <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Create</button>
                      </div>
                      <div v-show="editmodePost" class="modal-footer">
                          <button type="button" :class="loadclass()" class="text-red-600 border-red-200 hover:bg-red-600 focus:ring-red-600 " data-dismiss="modal">Close</button>
                          <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Update</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
    </section>
  </template>

  <script>
  export default {
      name:'posts',
      components:{
      },
      data(){
          return{
               editmodePost:false,
              postform: new Form({
                    id: '',
                    //post
                    title:'',
                    description:'',
                    website_id:'',
                    fetchurl:               '/api/posts',
                    createurl:         '/api/post/create',
                    updateurl:        '/api/post/update/',
                    deleteurl:        '/api/post/destroy/',
                    fetchwebsitesurl: '/api/websites',
               }),
              columns: [
                 {
                   label: 'Title',
                   field: 'title',
                 },
                 {
                   label: 'Description',
                   field: 'description',
                 },
                 {
                   label: 'Website',
                   field: 'website.name',
                 },
                 {
                   label: 'Created On',
                   field: 'created_at',
                 },
                 {
                   label: 'Action',
                   field: 'action',
                 }
              ],
          };
      },
      mounted(){
          this.loadPosts();
          this.loadWebsites();
      },
      computed:{
          Posts() {
              return this.$store.getters.Posts;
          },
          Columns() {
            return this.columns;
          },
          Websites() {
              return this.$store.getters.Websites;
          },
      },
      methods:{
          loadPosts(){
              this.$store.dispatch('posts', this.postform.fetchurl)
              .then((response)=>{
                   Vue.nextTick(function(){
                   }.bind(this));
              })
              .catch(()=>{
                  this.Error();
              })
          },
          loadWebsites(){
              this.$store.dispatch('websites', this.postform.fetchwebsitesurl)
              .then((response)=>{
                   Vue.nextTick(function(){
                   }.bind(this));
              })
              .catch(()=>{
                  loader.hide();
                  this.Error();
              })
          },
          resetpostform(){
              this.editmodePost          = false;
              this.postform.id           ='';
              this.postform.title        ='';
              this.postform.description  ='';
              this.postform.website_id   ='';
          },
          NewPostModal(){
              this.resetpostform();
              this.editmodePost           = false;
              this.postform.id            ='';
              this.postform.title         ='';
              this.postform.description   ='';
              this.postform.website_id    ='';
              Vue.nextTick(function(){
                  $('#PostModal').modal('show');
              }.bind(this));
          },
          EditPostModal(post){
              this.resetpostform();
              this.editmodePost           = true;
              this.postform.id            = post.id;
              this.postform.title         = post.title;
              this.postform.description   = post.description;
              this.postform.website_id    = post.website_id;
              Vue.nextTick(function(){
                  $('#PostModal').modal('show');
              }.bind(this));
          },
          addPost(){
                  console.log(this.postform);
                  this.$store.dispatch("addPost", this.postform)
                  .then((response)=>{
                      this.editmodePost = false;
                      this.resetpostform();
                      this.Success(response);
                      this.loadPosts()
                      $('#PostModal').modal('hide')
                  })
                  .catch((error)=>{
                      this.Error(error);
                      $('#PostModal').modal('show')
                  })
          },
          updatePost(){
                  this.$store.dispatch("updatePost", this.postform)
                  .then((response)=>{
                      this.editmodePost = false;
                      this.resetpostform();
                      this.Success(response);
                      this.loadPosts()
                      $('#PostModal').modal('hide')
                  })
                  .catch((error)=>{
                      loader.hide();
                      this.Error(error);
                      $('#PostModal').modal('show')
                  })
          },
          DeletePost(post){
                  this.$store.dispatch("deletePost", this.postform)
                  .then((response)=>{
                      this.Success(response);
                      this.loadPosts()
                  })
                  .catch((error)=>{
                      loader.hide();
                      this.Error(error);
                  })
          },
      }
  }
  </script>

  <style    lang="scss">

  </style>












