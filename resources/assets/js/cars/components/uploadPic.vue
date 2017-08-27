<template>
<div>
    <div class="image-list">
        <div class="list-default-img" v-show="isPhoto" @click.stop="addPic">
            <span>
                <mt-button>上传真实头像照片</mt-button>
            </span>
            <input type="file" accept="image/jpeg,image/jpg,image/png" capture="camera"
            @change="onFileChange" style="display: none;">
        </div>
        <ul class="list-ul" v-show="!isPhoto">
            <li class="list-li" v-for="(iu, index) in imgUrls">
<!--                 <a class="list-link" @click='previewImage(iu)'>
    <img :src="iu">
</a> -->
				<img :src="iu">	
				<div v-show="!isUpload">
				<mt-button type="primary" @click='saveImage()' class="aui-col-xs-6 button">
                	确定使用该图片
                </mt-button>
                <mt-button type="danger"@click='delImage(index)' class="aui-col-xs-6 button">
                	重新上传图片
                </mt-button>
                </div>
            </li>
<!--             <li class="list-li-add">
    <span class="add-img" @click.stop="addPic">
    </span>
</li> -->
        </ul>
    </div>
<!--     <div class="add-preview" v-show="isPreview" @click="closePreview">
    <img :src="previewImg">
</div> -->
</div>
</template>
<script>
import $ from 'jquery';
import lrz from 'lrz';
import { Button } from 'mint-ui';
export default {
		components:{
			'mt-button':Button
		},
        data:
        function() {
            return {
                imgUrls:
                [],
                urlArr: [],
                isPhoto: true,
                btnTitle: '',
                isModify: false,
                previewImg: '',
                isPreview: false,
                isUpload:false
            }
        },
        watch: {
            imgUrls: 'toggleAddPic'
        },
        methods: {
            toggleAddPic: function() {
                let vm = this;
                if (vm.imgUrls.length >= 1) {
                    vm.isPhoto = false;
                } else {
                    vm.isPhoto = true;
                }
            },
            addPic: function(e) {
                let vm = this;
                $('input[type=file]').trigger('click');
                return false;
            },
            onFileChange: function(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;
                this.createImage(files, e);
            },
            createImage: function(file, e) {
                let vm = this;
                lrz(file[0], {
                    width: 480
                }).then(function(rst) {
                    vm.imgUrls.push(rst.base64);
                    return rst;
                }).always(function() {
                    // 清空文件上传控件的值
                    e.target.value = null;
                });
            },
            delImage: function(index) {
                let vm = this;
                vm.imgUrls.splice(index, 1);
                  
            },
            previewImage: function(url) {
                let vm = this;
                vm.isPreview = true;
                vm.previewImg = url;
            },
            closePreview: function() {
                let vm = this;
                vm.isPreview = false;
                vm.previewImg = "";
            },
            saveImage: function() {
                let vm = this;
                let urlArr = [],
                imgUrls = this.imgUrls;
                for (let i = 0; i < imgUrls.length; i++) {
                    if (imgUrls[i].indexOf('file') == -1) {
                        urlArr.push(imgUrls[i].split(',')[1]);
                    } else {
                        urlArr.push(imgUrls[i]);
                    }
                }
                //数据传输操作
                this.$emit('saveImg', urlArr[0]);
                this.isUpload = true;
            }
        }
    }
</script>
<style scoped>
	.button{
		border-radius: 0;
	}
</style>