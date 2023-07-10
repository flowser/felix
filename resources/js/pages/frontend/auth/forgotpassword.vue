<template>
    <div id="forgot-password" class="">
        <form class="p-a30 dez-form text-center">
            <h3 class="form-title m-t0">Forget Password ?</h3>
            <div class="dez-separator-outer m-b5">
                <div class="dez-separator bg-primary style-liner"></div>
            </div>
            <p>Enter your e-mail address below to reset your password. </p>
            <div class="form-group">
                <input name="dzName" required="" class="form-control" placeholder="Email Id" type="text"/>
            </div>
            <div class="form-group text-left">
                <router-link class="site-button outline gray" v-if="!this.$authcheck()" :to="{name:'Login'}">Login</router-link>
                <button class="site-button pull-right">Reset</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name:'forgotpassword',
    components:{
    },
    data(){
        return{
        };
    },
    mounted(){
    },
    computed:{
        Hideheader(){
        }
    },
    methods:{
        Unhideheader(){
             window.location.replace('/')
        }
    },
    watch: {
        $route(to, from) {
        },

    }
}
</script>

<style>

</style>
