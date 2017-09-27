<template>
<div>
<header class="aui-bar aui-bar-nav aui-bar-dark aui-gird">
	<div class="aui-col-xs-3">
    <span class="aui-iconfont aui-icon-left"></span>
	<router-link to="/person">
        返回
    </router-link>
	</div>
    <div class="aui-title">用户登陆与注册</div>   
</header>
<div class="content">
<mt-navbar v-model="selected">
  <mt-tab-item id="login"><label class="initclick">登陆</label></mt-tab-item>
  <mt-tab-item id="register">注册</mt-tab-item>
</mt-navbar>
<mt-tab-container v-model="selected">
  <mt-tab-container-item id="login">

<div class="aui-content aui-margin-b-15">
    <ul class="aui-list aui-form-list">
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label">
                    手机号码
                </div>
                <div class="aui-list-item-input">
                    <input type="text" placeholder="请输入手机号码" v-model="loginnumber">
                </div>
            </div>
        </li>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label">
                    登录密码
                </div>
                <div class="aui-list-item-input">
                    <input type="password" placeholder="请输入登录密码" v-model="password">
                </div>
            </div>
        </li>
	</ul>
    <div class="aui-gird">
        <mt-button type="primary" class="aui-col-xs-6 button-type" v-on:click="login">
        登陆
        </mt-button>
        <mt-button type="danger" class="aui-col-xs-6 button-type">
        修改密码
        </mt-button>
    </div>
</div>

  </mt-tab-container-item>
  <mt-tab-container-item id="register">
    <ul class="aui-list aui-form-list">
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label">
                    手机号码
                </div>
                <div class="aui-list-item-input">
                    <input type="text" placeholder="请输入手机号码" v-model="phonenumber">
                </div>
            </div>
        </li>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label">
		            <div class="aui-btn" v-on:click="getverifycode">
		                验证码
		            </div>
                </div>
                <div class="aui-list-item-input">
                    <input placeholder="请输入手机验证码" v-model="verifycode">
                </div>
            </div>
        </li>
	</ul>
	<mt-button type="primary" @click.native="gotoregister" class="aui-col-xs-12 button-type">
	注册
	</mt-button>
  </mt-tab-container-item>
</mt-tab-container>
</div>
</div>
</template> 
<script>
import { Navbar, TabItem, Button } from 'mint-ui';
import jQuery from 'jquery';
import { Toast } from 'mint-ui';
import VueRouter from 'vue-router';
export default{
	before(){
		jQuery(".initclick").click();
        this.wjcao.get('/cars/is_login').then(function(r){
            console.log(r.data);
        }).catch(function(e){
            console.log(e);
        });
	},
	components:{
		 Navbar,
		 TabItem,
		 'mt-button':Button
	},
	data(){
		return {
			selected : true,
			verifycode : '',
			phonenumber : '',
            loginnumber : '',
            password : '',
            member : '',
            is_login : false
		}
	},
	methods:{
		getverifycode(){
			if (!this.phonenumber||this.phonenumber.length!=11||isNaN(this.phonenumber)) {
				Toast('请输入正确的手机号');
				return false;
			};
		    this.wjcao.post('/api/cars/getVerifyCode',
		    	{
		    		phonenumber:this.phonenumber
		    	}/*,
		    	{
		    	headers: {
         			'X-XSRF-TOKEN': document.cookie.match('XSRF-TOKEN')
     			}
     		}*/)
		    .then(function(r){
		    	if (r.data.code) {
                    Toast('验证码已经发送');
		    	}else{
		    		Toast('获取验证码失败');
		    	}
	        }).catch(function(e){
	            console.log(e.data);
	        });
		},
		gotoregister(){

            let postPhone = this.phonenumber;

            let v = this;

            this.wjcao.post('/api/cars/testVerifyCode',
                {
                    phonenumber:v.phonenumber,
                    verifycode:v.verifycode
                }).then(function(r){
                if(r.data.code==1){
                    v.gotoPath('/register/' + postPhone);
                }else{
                    Toast('手机号与验证码不匹配');
                }
                }).catch(function(e){
                    console.log(e);
                });
		},
        login(){

            let Phonenumber = this.loginnumber;

            let password = this.password;

            if (!Phonenumber){
                Toast('请输入您的手机号');
                return false;
            }else if(password===''){
                Toast('请输入登陆密码');
                return false;
            }else {
                let v= this;
                this.wjcao.post('/cars/login',
                    {
                        phone:v.loginnumber,
                        passwd:v.password
                    },
                    {
                        headers: {
                            'X-XSRF-TOKEN': document.cookie.match('XSRF-TOKEN')
                        }
                    }
                    ).then(function(r){
                    if(r.data.code==1){
                        v.gotoPath('/');
                    }else{
                        let msg = r.data.msg;
                        Toast(msg);
                    }
                }).catch(function(e){
                    console.log(e);
                });
            }
        },
        gotoPath:function(routePath) {
            let router = new VueRouter();
            router.push({ path: routePath});
        }
	}
}
</script>
<style scoped>
.button-type{
	border-radius: 0
}
</style>