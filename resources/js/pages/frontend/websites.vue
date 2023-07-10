<template>
    <section class="content">
        <hr>
        <vue-good-table
            :columns="Columns"
            :rows="Websites"
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
            <!-- <div slot="table-actions"  v-if="!Websites.length"> -->
            <div slot="table-actions"  >
                <button :class="loadclass()" @click.prevent="NewWebsiteModal()" title="Add New Website">Add New Website <i class="fas fa-plus fw"></i></button>
            </div>
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'created_at'">
                  <span class="text-green-101">{{props.row.created_at | dateformat()}}</span>
              </span>
                
                <span v-else-if="props.column.field == 'action'">
                    <span @click="EditWebsiteModal(props.row)"    class="text-warning" style="text-decoration: underline; cursor: pointer;">
                        <i class="far fa-edit text-danger" aria-hidden="true"> </i>
                    </span>
                </span>
            </template>
        </vue-good-table>
        <!-- website -->
        <div class="modal fade " id="WebsiteModal" tabindex="-1" role="dialog" aria-labelledby="WebsiteModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content" >
                  <form role="form" class="vld-parent" ref="formContainer" @submit.prevent="editmodeWebsite ? updateWebsite() : addWebsite()" >
                      <div class="modal-body">
                          <div class="text-center">
                              <h2><label for="name" v-show="!editmodeWebsite" class="uppercase col-form-label">New Website</label></h2>
                              <h2><label for="name" v-show="editmodeWebsite" class="uppercase col-form-label">Edit Website</label></h2>
                              <div class="alert alert-danger" v-if="websiteform.errors.has('error')">
                                  <div class="text-red" v-html="websiteform.errors.get('error')"></div>
                               </div>
                          </div>
                           <div class="row">
                                <div class="col-md-6 form-group">
                                        <label for="name" class="uppercase col-form-label">Website Name</label>
                                        <input v-model="websiteform.name" id="name1" type="text" class="form-control  text-blue-500" placeholder="Website Name" name="name1" >
                                        <div class="text-red" v-if="websiteform.errors.has('name')" v-html="websiteform.errors.get('name')" />
                                </div>
                                <div class="col-md-6 form-group">
                                        <label for="url" class="uppercase col-form-label">Website url</label>
                                        <input v-model="websiteform.url" id="url" type="text" class="form-control  text-blue-500" placeholder="Website url" name="last_name1" >
                                        <div class="text-red" v-if="websiteform.errors.has('url')" v-html="websiteform.errors.get('url')" />
                                </div>
                            </div>
                      </div>
                      <div v-show="!editmodeWebsite" class="modal-footer">
                          <button type="button" :class="loadclass()" class="text-red-600 border-red-200 hover:bg-red-600 focus:ring-red-600 " data-dismiss="modal">Close</button>
                          <button type="submit" :class="loadclass()" class="text-green-600 border-green-200 hover:bg-green-600 focus:ring-green-600 ">Create</button>
                      </div>
                      <div v-show="editmodeWebsite" class="modal-footer">
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
      name:'websites',
      components:{
      },
      data(){
          return{
               editmodeWebsite:false,
              websiteform: new Form({
                    id: '',
                    //website
                    name:'',
                    url:'',                    
                    fetchurl:               '/api/websites',
                    createurl:         '/api/website/create',
                    updateurl:        '/api/website/update/',
                    deleteurl:        '/api/website/destroy/',
               }),
              columns: [
                 {
                   label: 'Website',
                   field: 'name',
                 },
                 {
                   label: 'Url',
                   field: 'url',
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
          this.loadWebsites();
      },
      computed:{
          Websites() {
              return this.$store.getters.Websites;
          },
          Columns() {
            return this.columns;
          },
      },
      methods:{
          loadWebsites(){
              this.$store.dispatch('websites', this.websiteform.fetchurl)
              .then((response)=>{
                   Vue.nextTick(function(){
                   }.bind(this));
              })
              .catch(()=>{
                  loader.hide();
                  this.Error();
              })
          },
          resetwebsiteform(){
              this.editmodeWebsite    = false;
              this.websiteform.id     ='';
              this.websiteform.name   ='';
              this.websiteform.url    ='';
          },
          NewWebsiteModal(){
              this.resetwebsiteform();
              this.editmodeWebsite    = false;
              this.websiteform.id     ='';
              this.websiteform.name   ='';
              this.websiteform.url    ='';
              Vue.nextTick(function(){
                  $('#WebsiteModal').modal('show');
              }.bind(this));
          },
          EditWebsiteModal(website){
              this.resetwebsiteform();
              this.editmodeWebsite    = true;
              this.websiteform.id     = website.id;
              this.websiteform.name   = website.name;
              this.websiteform.url    = website.url;
              Vue.nextTick(function(){
                  $('#WebsiteModal').modal('show');
              }.bind(this));
          },
          addWebsite(){
                  console.log(this.websiteform);
                  this.$store.dispatch("addWebsite", this.websiteform)
                  .then((response)=>{
                      this.editmodeWebsite = false;
                      this.resetwebsiteform();
                      this.Success(response);
                      this.loadWebsites()
                      $('#WebsiteModal').modal('hide')
                  })
                  .catch((error)=>{
                      this.Error(error);
                      $('#WebsiteModal').modal('show')
                  })
          },
          updateWebsite(){
                  this.$store.dispatch("updateWebsite", this.websiteform)
                  .then((response)=>{
                      this.editmodeWebsite = false;
                      this.resetwebsiteform();
                      this.Success(response);
                      this.loadWebsites()
                      $('#WebsiteModal').modal('hide')
                  })
                  .catch((error)=>{
                      this.Error(error);
                      $('#WebsiteModal').modal('show')
                  })
          },
          DeleteWebsite(website){
                  this.websiteform.id    = website.id;
                  this.websiteform.name  = website.name;
                  this.websiteform.url   = website.url;
                  
                  this.$store.dispatch("deleteWebsite", this.websiteform)
                  .then((response)=>{
                      this.Success(response);
                      this.loadWebsites()
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
  
  
  
  
  
  
  
  
  
  
  