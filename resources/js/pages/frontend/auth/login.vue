<template>
    <div id="login" class="text-center">
        <form class="p-a30 dez-form" ref="formContainer" @submit.prevent="login()" @keydown="loginform.onKeydown($event)">
            <h3 class="form-title m-t0">Sign In</h3>
            <div class="dez-separator-outer m-b5">
                <div class="dez-separator bg-primary style-liner"></div>
            </div>
            <p>Enter your e-mail address and your password. </p>
            <div class="form-group">
                <input v-model="loginform.email" name="email" required="" class="form-control" placeholder="User Name" type="text"/>
                <div class="text-red" v-if="loginform.errors.has('email')" v-html="loginform.errors.get('email')" />
            </div>
            <div class="form-group">
                <input v-model="loginform.password" name="password" type="password" class="form-control" placeholder="Password">
                <div class="text-red" v-if="loginform.errors.has('password')" v-html="loginform.errors.get('password')" />
            </div>
            <div class="form-group text-left">
                <button  type="submit" :disabled="loginform.busy" class="site-button dz-xs-flex m-r5">Login</button>
                <label>
					<input id="check1" type="checkbox"/>
					<label for="check1"> Remember me</label>
                </label>
                <router-link class="m-l5" v-if="!this.$authcheck()" :to="{name:'Forgot Password'}">
                    <i class="fa fa-unlock-alt"></i> Forgot Password
                </router-link>
			</div>
			<div class="dz-social clearfix">
				<h5 class="form-title m-t5 pull-left">Sign In With</h5>
				<ul class="dez-social-icon dez-border pull-right dez-social-icon-lg text-white">
					<li><a class="fab fa-facebook-f  fb-btn" href="javascript:;" target="bank"></a></li>
					<li><a class="fab fa-twitter  tw-btn" href="javascript:;" target="bank"></a></li>
					<li><a class="fab fa-linkedin-in link-btn" href="javascript:;" target="bank"></a></li>
					<li><a class="fab fa-google-plus-g  gplus-btn" href="javascript:;" target="bank"></a></li>
				</ul>
			</div>
        </form>
        <div class="bg-primary p-a15 bottom">
			<router-link class="text-white" v-if="!this.$authcheck()" :to="{name:'Register'}">Create an account</router-link>
		</div>
    </div>
</template>

<script>
import Form from 'vform';
export default {
    name:'login',
    components:{
    },
    data(){
        return{
            loginform: new Form({
                email:'',
                password:'',
                rememberme:null,
                fullpage:false,
                status:'email',//default login with
            }),
        };
    },
    mounted(){
        this.resetForm();
    },
    computed:{
        Hideheader(){
        }
    },
    methods:{
        login(){
            let loader = this.Loading();
            this.$store.dispatch('login', this.loginform)
            .then((response)=>{
                console.log('response34', response);
                console.log('response', this.$dashboard());
                loader.hide();
                this.resetForm();
                this.Success(response);

                const resolved = this.$router.resolve(this.$dashboard());
                console.log('resolved', resolved);
                window.location.replace(resolved.href);
            })
             .catch((error)=>{
                this.Error(error);
            })
        },
        Loading(){
            let loader = this.$loading.show({
                // Optional parameters
                container: this.loginform.fullpage ? null : this.$refs.formContainer,
                canCancel: true,
                // onCancel: this.Error(error),
                color: '#000000',
                loader: 'bars',
                width: 64,
                height: 64,
                backgroundColor: '#ffffff',
                opacity: 0.5,
                zIndex: 999,
            })
            return loader;
        },
        resetForm(){
            this.loginform.email        = '';
            this.loginform.password     = '';
            this.loginform.rememberme   = null;
            this.loginform.fullpage     = false;
        },
    },
    watch: {
        $route(to, from) {
        },
    }
}
</script>
<style>
</style>
