<template>
<mt-tabbar v-model="selected" fixed>
  <mt-tab-item id="/">
        <i class="aui-iconfont aui-icon-home"></i>
            车信息
  </mt-tab-item>
  <mt-tab-item id="/publish">
        <i class="aui-iconfont aui-icon-star"></i>
            发布信息
  </mt-tab-item>
  <mt-tab-item id="/person">
        <i class="aui-iconfont aui-icon-my"></i>
            我的空间
  </mt-tab-item>
</mt-tabbar>
</template>
<style scope>
    a{
        color: black;
    }
    .mint-tabbar{
        height: 2.5rem;
    }
    .mint-tab-item-label{
      margin-top:0.5rem;
    }
</style>
<script>
import { Tabbar, TabItem } from 'mint-ui';
export default {
    components:{
        Tabbar,
        TabItem
    },
    props: ['path'],
    data:function () {
        return{
            selected:this.path
        }
    },
    watch:{
        selected:function (val) {
            this.$router.push({path:val});
        }
    }
}
</script>