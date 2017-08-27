<template>
<div>
<Banner></Banner>
<div class="content">
<div class="account aui-content">
	<section class="aui-gird">
		<div class="aui-row">
        <router-link to="/login">
			<mt-button type="default" class="login aui-col-xs-6 aui-flex-offset-3">
				注册/登陆
			</mt-button>
		</router-link>
		</div>
	</section>
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
<main-footer>
</main-footer>
</div>
</template>
<script>
import Banner from './personBanner';
import { Button } from 'mint-ui';
import MainFooter from './footer';
export default{
	components:{
		Banner,
		'mt-button':Button,
	  	 MainFooter
	}
}
</script>
<style scoped>
.content{
	margin-top: 3rem;
	margin-bottom: 3rem;
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
	min-height: 10rem;
	border : 1px solid silver;
	background-color: white;
}
.aui-bar{
	background-color: silver;
	color: white;
}
</style>