<template>
  <div>
    <nav class="navbar navbar-expand navbar-primary navbar-dark">
       <ul class="navbar-nav ml-auto">
          <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
             <i class="fas fa-expand-arrows-alt"></i>
             </a>
          </li>
          <li class="nav-item">
             <router-link class="nav-link text-white" data-widget="control-sidebar" data-slide="true" to="/" role="button" @click.prevent="logout()">Websites
             </router-link>
          </li>
          <li class="nav-item">
             <router-link class="nav-link text-white" data-widget="control-sidebar" data-slide="true" to="/websites" role="button" @click.prevent="logout()">CreateWebsites
             </router-link>
          </li>
          <li class="nav-item">
             <router-link class="nav-link text-white" data-widget="control-sidebar" data-slide="true" to="/posts" role="button" @click.prevent="logout()"> CreatePosts
             </router-link>
          </li>
          <li class="nav-item">
             <router-link class="nav-link text-white" data-widget="control-sidebar" data-slide="true" to="/subscribers" role="button" @click.prevent="logout()"> availableSubscribers
             </router-link>
          </li>
       </ul>
    </nav>
    <div class="content-wrapper">
          <section class="content">
            <div class="container-fluid">
              <router-view></router-view>
            </div>
          </section>
    </div>
   </div>
</template>
<script>
export default {
    name:'frontendmaster',
    components:{
    },
    data(){
        return{
        };
    },
    mounted(){

   },
    computed:{
    },
    methods:{

    },
    watch: {
    }
}
</script>

<style>
@import url(https://fonts.googleapis.com/css?family=Lato:400,700);

body {
	background:#11BCAF;
	font-family: 'Lato', sans-serif;
	font-weight: bold;
	font-size: 14px;
	color: #171D23;
	margin: 00;
}

.modal-content .form-control {
    color: #000000;
}
.container {
	width: 300px;
	height: 300px;
	margin: auto;
}

.login_bar {
	width: 300px;
	height: 50px;
	background: white;
	border-radius: 10px;
	top: 50%;
	position: relative;
  z-index: 1;
	overflow: hidden;
}

.login {
	background: transparent;
	position: absolute;
	height: 100%;
	width: 190px;
	padding-left: 10px;
	text-align: left;
	line-height: 50px;
	vertical-align: middle;
	z-index: 10;
	-webkit-transition: transform 0.2s ease-in-out 0s;
	   -moz-transition: transform 0.2s ease-in-out 0s;
	     -o-transition: transform 0.2s ease-in-out 0s;
	        transition: transform 0.2s ease-in-out 0s;
}

.login_active {
	-webkit-transform: translateX(300px);
	   -moz-transform: translateX(300px);
	    -ms-transform: translateX(300px);
	     -o-transform: translateX(300px);
	        transform: translateX(300px);
}

.subscribe_button:hover{
	background-color: #222A33;
	cursor:pointer;
}

.subscribe_button {
	background: #171D23;
	position: absolute;
	top: -50px;
	left: 200px;
	border-top-right-radius: 10px;
	border-bottom-right-radius: 10px;
	height: 150px;
	width: 100px;
	text-align: center;
	line-height: 150px;
	vertical-align: middle;
	color: white;
	-webkit-transition: transform 0.5s ease 0s;
	   -moz-transition: transform 0.5s ease 0s;
	     -o-transition: transform 0.5s ease 0s;
	        transition: transform 0.5s ease 0s;
}

.subscribe_button_active{
	-webkit-transform: translateY(50px);
	   -moz-transform: translateY(50px);
	    -ms-transform: translateY(50px);
	     -o-transform: translateY(50px);
	        transform: translateY(50px);
}

.subscribing{
	background: #CDD4DC;
	height: 100%;
	width: 300px;
	z-index: 5;
	position: absolute;
	left:-300px;
	display: inline-block;
	-webkit-transition: transform 1s ease 0s ;
	   -moz-transition: transform 1s ease 0s ;
	     -o-transition: transform 1s ease 0s ;
	        transition: transform 1s ease 0s ;
}

.subscribing_active {
	-webkit-transform: translateX(300px);
	   -moz-transform: translateX(300px);
	    -ms-transform: translateX(300px);
	     -o-transform: translateX(300px);
	        transform: translateX(300px);
}

.thanks{
	background: transparent;
	height: 100%;
	width: 300px;
	z-index: 5;
	text-align: left;
	line-height: 50px;
	vertical-align: middle;
	padding-left: 10px;
	position: absolute;
	top:50px;
	display: inline-block;
	-webkit-transition: transform 0.5s ease 0s ;
	   -moz-transition: transform 0.5s ease 0s ;
	     -o-transition: transform 0.5s ease 0s ;
	        transition: transform 0.5s ease 0s ;
}

.thanks_active {
	-webkit-transform: translateY(-50px);
	   -moz-transform: translateY(-50px);
	    -ms-transform: translateY(-50px);
	     -o-transform: translateY(-50px);
	        transform: translateY(-50px);
}

</style>
