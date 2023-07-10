			// <a href="" @click.prevent="Unhideheader()"><img src="/assets/themes/front/assets/images/logo-white-2.png" alt=""></a>
<template>
    <div id="developement-1" class="">
        <form class="p-a30 dez-form text-center text-center">
            <h3 class="form-title m-t0">Sign Up</h3>
            <div class="dez-separator-outer m-b5">
                <div class="dez-separator bg-primary style-liner"></div>
            </div>
            <p>Enter your personal details below: </p>
            <div class="form-group">
                <input name="dzName" required="" class="form-control" placeholder="Full Name" type="text"/>
            </div>
			<div class="form-group">
                <input name="dzName" required="" class="form-control" placeholder="User Name" type="text"/>
            </div>
            <div class="form-group">
                <input name="dzName" required="" class="form-control" placeholder="Email Id" type="text"/>
            </div>
            <div class="form-group">
                <input name="dzName" required="" class="form-control" placeholder="Password" type="password"/>
            </div>
            <div class="">
                <input name="dzName" required="" class="form-control" placeholder="Re-type Your Password" type="password"/>
            </div>
            <div class="m-b30">
				<input id="check2" type="checkbox"/>
				<label for="check2">
                    I agree to the
                    <a href="javascript:void(0);">Terms of Service </a>&
                    <a href="javascript:void(0);">Privacy Policy</a>
                </label>
            </div>
            <div class="form-group text-left ">
                <router-link class="site-button outline gray" v-if="!this.$authcheck()" :to="{name:'Login'}">Login</router-link>
                <button class="site-button pull-right">Register</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    name:'register',
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
