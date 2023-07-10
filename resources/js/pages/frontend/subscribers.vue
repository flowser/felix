<template>
    <section class="content">
        <hr>
        <vue-good-table
            :columns="Columns"
            :rows="Subscribers"
             max-height="600px"
            :line-numbers="true"
            styleClass="vgt-table bordered condensed nocturnal custom-table"
            :search-options="{
                  enabled: true,
                }"
            :sort-options="{
                enabled: true,
                initialSortBy: {field: 'created_at', type: 'dsc'}
              }"
              :pagination-options="{
                enabled: false,
                mode: 'records',
                position: 'bottom',
                perPage: 10
              }"
              :select-options="{
                enabled: false,
              }"
            >
            <!-- <div slot="table-actions"  v-if="!Subscribers.length"> -->
            <div slot="table-actions"  >
            </div>
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'email'">
                  <span class="text-green-101">{{props.row.email}}</span>
              </span>
                <span v-else-if="props.column.field == 'website_id'">
                  <span class="text-green-101">{{props.row.website.name}}</span>
              </span>
              <span v-else-if="props.column.field == 'created_at'">
                  <span class="text-green-101">{{props.row.created_at | dateformat()}}</span>
              </span>
            </template>
        </vue-good-table>
    </section>
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
                    id: '',                   
                    fetchurl:               '/api/subscribers',
               }),
              columns: [
                 {
                   label: 'Email',
                   field: 'email',
                 },
                 {
                   label: 'Website',
                   field: 'website_id',
                 },
                 {
                   label: 'Created On',
                   field: 'created_at',
                 },
              ],
          };
      },
      mounted(){
          this.loadSubscribers();
      },
      computed:{
          Subscribers() {
              return this.$store.getters.Subscribers;
          },
          Columns() {
            return this.columns;
          },
      },
      methods:{
          loadSubscribers(){
              this.$store.dispatch('subscribers', this.subscriberform.fetchurl)
              .then((response)=>{
                   Vue.nextTick(function(){
                   }.bind(this));
              })
              .catch(()=>{
                  loader.hide();
                  this.Error();
              })
          },
      }
  }
  </script>
  
  <style    lang="scss">
  
  </style>
  
  
  
  
  
  
  
  
  
  
  

