<template>
<div>
	<header class="aui-bar aui-bar-nav aui-bar-dark aui-gird">
	<div class="aui-col-xs-3">
    <span class="aui-iconfont aui-icon-left"></span>
	<router-link to="/login">
        返回
    </router-link>
	</div>
    <div class="aui-title">用户注册</div>   
</header>
<div class="content">
<mt-navbar v-model="selected">
  <mt-tab-item id="passenger"><label class="initclick">乘客注册</label></mt-tab-item>
  <mt-tab-item id="driver">司机注册</mt-tab-item>
</mt-navbar>
<mt-tab-container v-model="selected">
<mt-tab-container-item id="passenger">
	<div class="aui-content aui-margin-b-15">
	    <ul class="aui-list aui-form-list">
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    设置密码
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="password" placeholder="请设置密码">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    确认密码
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="password" placeholder="请再次输入密码">
	                </div>
	            </div>
	        </li>
		</ul>
		<mt-button type="primary" class="aui-col-xs-12">
        	提交信息
        </mt-button>
</div>
</mt-tab-container-item>
<mt-tab-container-item id="driver">
	<div class="aui-content aui-margin-b-15">
	    <ul class="aui-list aui-form-list">
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    设置密码
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="password" placeholder="请设置密码">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    确认密码
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="password" placeholder="请再次输入密码">
	                </div>
	            </div>
	        </li>
		</ul>
		<ul class="aui-list aui-list-in">
	        <li class="aui-list-header">
	            为确保信息真实性，请完善以下必要信息
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    姓名
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="text" placeholder="请填真实姓名">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    性别
	                </div>
					<div class="aui-list-item-input">
                    <label>
                    <input class="aui-radio" type="radio" name="sex" checked> 男
                    </label>
                    <label>
                    <input class="aui-radio" type="radio" name="sex"> 女
                    </label>
                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    年龄
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="text" placeholder="你的真实年龄">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    联系电话
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="text" placeholder="联系电话">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    身份证号
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="text" placeholder="真实身份证号码">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    车牌号
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="text" placeholder="请输入你的车牌号码">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    车型
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="text" placeholder="您的车型，如'宝马','奥迪'等">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
	                <div class="aui-list-item-label">
	                    车容量
	                </div>
	                <div class="aui-list-item-input">
	                    <input type="text" placeholder="车容量，如4座，6座等">
	                </div>
	            </div>
	        </li>
	        <li class="aui-list-item">
	            <div class="aui-list-item-inner">
                	<textarea placeholder="你想说明的情况（可不填）">
                	</textarea>
	            </div>
	        </li>
	        <li class="aui-card-list-content">
	        <upload-pic v-on:saveImg="saveImg"></upload-pic>
	        </li>
    	</ul>
        <mt-button type="primary" class="aui-col-xs-12 submit-info">
    	提交信息
    	</mt-button>
	</div>
</mt-tab-container-item>
</mt-tab-container>
</div>
</div>
</template>
<script>
import { Navbar, TabItem, Button } from 'mint-ui';
import jQuery from 'jquery';
import { Toast } from 'mint-ui';
import UploadPic from './uploadPic';
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
export default{
	mounted(){
		jQuery(".initclick").click();
		this.phoneNumber = this.$route.params.phoneNumber;
	},
	components:{
		Navbar,
		TabItem,
		'mt-button':Button,
		UploadPic
	},
	data(){
		return {
			selected : true,
			infos : {
				imgUrl : ''
			},
			phoneNumber:''
		}
	},
	methods:{
		saveImg:function(url){
			this.infos.imgUrl = url;
		}
	}
}
</script>
<style scoped>
.submit-info{
	margin-top: 2rem;
}
</style>