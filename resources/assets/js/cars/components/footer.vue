<template>
<mt-tabbar v-model="selected" fixed>
  <mt-tab-item id="tab1">
        <router-link to="/">
        <i class="aui-iconfont aui-icon-home"></i>
            车信息
        </router-link>
  </mt-tab-item>
  <mt-tab-item id="tab2">
        <router-link to="/publish">
        <i class="aui-iconfont aui-icon-star"></i>
            发布信息
        </router-link>
  </mt-tab-item>
  <mt-tab-item id="tab3">
        <router-link to="/person">
        <i class="aui-iconfont aui-icon-my"></i>
            我
        </router-link>
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
        data () {
          return {
            selected: true,
            fixed : true
          }
    },
    methods:{

    }
}
</script>