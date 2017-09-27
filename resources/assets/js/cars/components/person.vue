<template>
<div>
<Banner></Banner>
<div class="getposition"></div>
<div class="content">
<div v-cloak>
<div class="account aui-content">
	<section class="aui-gird" v-if="is_login">
		<div class="aui-row">
			<section class="aui-grid aui-margin-b-15">
				<div class="aui-row">
					<div class="aui-col-xs-4">
						<i class="aui-iconfont aui-icon-cert"></i>
						<div class="aui-grid-label">约车记录</div>
					</div>
					<div class="aui-col-xs-4" v-on:click="sheetVisible=true">
						<i class="aui-iconfont aui-icon-gear"></i>
						<div class="aui-grid-label">个人设置</div>
					</div>
				</div>
			</section>
		</div>
	</section>
	<section class="aui-gird" v-else="is_login">
		<div class="aui-row">
        <router-link to="/login">
			<mt-button type="default" class="login aui-col-xs-6 aui-flex-offset-3">
				注册/登陆
			</mt-button>
		</router-link>
		</div>
	</section>
</div>
</div>
<div class="story aui-content">
	<section class="aui-gird">
		<div class="aui-row">
			<header class="aui-bar aui-bar-nav">
				<div class="aui-title">身边故事</div>
			</header>
		</div>
		<div class="aui-row">
		正在努力开发中。。。<br>届时，会开放一些互动的功能供大家使用，敬请期待。
		</div>
	</section>
</div>
<div class="suggestions aui-content">
	<section class="aui-gird">
		<div class="aui-row">
			<header class="aui-bar aui-bar-nav">
				<div class="aui-title">意见栏</div>
			</header>
		</div>
		<div class="aui-row">
			好什么好的意见以及新的想法，请加我的微信（cwj016）讨论,让我们共同打造属于我们自己的生态圈。
		</div>
	</section>
</div>
</div>
<mt-actionsheet
		:actions = "actions"
		v-model="sheetVisible"
		:cancelText="cancel"
>
</mt-actionsheet>
<main-footer>
</main-footer>
</div>
</template>
<script>
import Banner from './personBanner';
import { Button } from 'mint-ui';
import MainFooter from './footer';
import { Actionsheet } from 'mint-ui';
import VueRouter from 'vue-router';
export default{
    mounted(){
		let vue = this ;
        this.wjcao.get('/cars/is_login').then(function(r){
            if (r.data.code == 1){
                vue.is_login = true;
                vue.member = r.data.data;
			}
			console.log(r.data.data);
        }).catch(function(e){
            console.log(e);
        });
    },
    data() {
        return {
            is_login:false,
            member:'',
            sheetVisible:false,
			cancel:'取消',
            actions:[{name:'修改账号信息',method:this.account},{name:'退出登陆',method:this.logout}]
        }
    },
	components:{
		Banner,
		'mt-button':Button,
	  	 MainFooter,
        'mt-actionsheet':Actionsheet
	},
	methods:{
        logout(){
            let vue = this ;
            this.wjcao.get('/cars/logout').then(function(r){
                if (r.data.code == 1){
					console.log(r.data.msg);
                }
                vue.gotoPath('/');
                console.log(r.data.data);
            }).catch(function(e){
                console.log(e);
            });
		},
        account(){
            console.log(222222);
		},
		gotoPath:function(routePath) {
			let router = new VueRouter();
			router.push({ path: routePath});
		}

	}
}
</script>
<style scoped>
[v-cloak]{
	display: none;
}
.content{
	margin-bottom: 3rem;
	position: absolute;
	z-index: -1;
}

.getposition{
	height: 3rem;
}
.account{
	margin:1rem 1rem 1rem 1rem;
	min-height: 6rem;
	border : 1px solid silver;
	background-color: white;
}
.login{
	border: 1px solid blue;
	color: blue;
	margin-top:1.8rem;
}
.story{
	margin:1rem 1rem 1rem 1rem;
	min-height: 10rem;
	border : 1px solid silver;
	background-color: white;
}
.suggestions{
	margin:1rem 1rem 1rem 1rem;
	min-height: 12rem;
	border : 1px solid silver;
	background-color: white;
}
.aui-bar{
	background-color: silver;
	color: white;
}
</style>