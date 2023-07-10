<template>
    <div class="">
      <div class="row">
         <div class="col-md-3" v-for="website in Websites" :key="website.id">
           <div class="card bg-gradient-primary">
             <div class="card-header">
                 <h3 class="card-title"><i class="fas fa-exclamation-triangle"></i> Website {{website.id+1}} </h3>
             </div>
              <div class="card-body">
                 <h5> <span class="text-danger">Website :</span>{{ website.name }}</h5>
                 <button class="btn btn-success" type="button" @click.prevent="NewSubscriberModal(website)">Click to view</button>           
              </div>
           </div>
        </div>
     </div>
     <div class="modal fade " id="SubscriberModal" tabindex="-1" role="dialog" aria-labelledby="SubscriberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
           <div class="modal-content" >
                <form role="form" @submit.prevent="addSubscriber()" >
                    <div class="bg-gradient-primary m-4">
                        <h5> <span class="text-danger">Subscribe to:</span>{{ subscriberform.websitename }}</h5>
                       <div class="input-group">
                        <input v-model="subscriberform.email" id="email" type="email" class="form-control  text-blue-500" placeholder="Your email email" name="email" >
                         <div class="text-red" v-if="subscriberform.errors.has('email')" v-html="subscriberform.errors.get('email')" />
                          <span class="input-group-append">
                          <button class="btn btn-success" type="submit">Subscribe</button>
                          </span>
                       </div>
                </div>                 
             </form>           
           </div>
       </div>
     </div>
   </div>
</template>
<script>
 export default {
      name:'subscribers',
      components:{
      },
      data(){
          return{
               editmodeSubscriber:false,
              subscriberform: new Form({
                    id:'',                
                    email:'',                
                    website_id:'',                
                    websitename:'',                
                    fetchurl:               '/api/websites',
                    createurl:         '/api/subscriber/create',
               }),
          };
      },
      mounted(){
          this.loadWebsites();
      },
      computed:{
          Websites() {
              return this.$store.getters.Websites;
          },
      },
      methods:{
          loadWebsites(){
              this.$store.dispatch('websites', this.subscriberform.fetchurl)
              .then((response)=>{
                   Vue.nextTick(function(){
                   }.bind(this));
              })
              .catch(()=>{
                  this.Error();
              })
          },
          resetsubscriberform(){
              this.editmodeSubscriber           = false;
              this.subscriberform.id            ='';
              this.subscriberform.website_id    ='';
              this.subscriberform.email         ='';
              this.subscriberform.websitename   ='';
          },
          NewSubscriberModal(website){
              this.resetsubscriberform();
              this.editmodeSubscriber           = false;
              this.subscriberform.id            = website.id;
              this.subscriberform.website_id    = website.id;
              this.subscriberform.email         = '';
              this.subscriberform.websitename   = website.name;
              Vue.nextTick(function(){
                  $('#SubscriberModal').modal('show');
              }.bind(this));
          },
          addSubscriber(id){
                  this.$store.dispatch("addSubscriber", this.subscriberform)
                  .then((response)=>{
                      this.editmodeSubscriber = false;
                      this.resetsubscriberform();
                      this.Success(response);
                      Vue.nextTick(function(){
                          $('#SubscriberModal').modal('hide');
                      }.bind(this));
                  })
                  .catch((error)=>{
                      this.Error(error);
                  })
          },
      }
  }


</script>

