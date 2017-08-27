<template>
<div>
    <Banner></Banner>
    <keep-alive>
      <scroller style="top: 44px;"
                :on-refresh="refresh"
                :on-infinite="infinite"
                ref="my_scroller">
        <div v-for="(item, index) in items" @click="onItemClick(index, item)"
            class="row" :class="{'grey-bg': index % 2 == 0}">
          {{ item }}
        </div>
      </scroller>
    </keep-alive>
<main-footer>
</main-footer>
</div>
</template>
<script>
import Banner from './mainBanner';
import MainFooter from './footer';
export default {
    data () {
      return {
        items: []
      }
    },
    mounted() {
      for (let i = 1; i <= 20; i++) {
        this.items.push(i + ' - keep walking, be 2 with you.')
      }
      this.top = 1
      this.bottom = 20
      this.wjcao.get('/api/getCars',{params:{'id':1,'name':'wjcao'}}).then(function(r){
          console.log(r);
      }).catch(function(e){
          console.log(e.data);
      });
    },
    components: {
      Banner,
      MainFooter
    },
    methods: {
      refresh(done) {
        setTimeout(() => {
          let start = this.top - 1

          for (let i = start; i > start - 10; i--) {
            this.items.splice(0, 0, i + ' - keep walking, be 2 with you.')
          }

          this.top = this.top - 10;

          done()
        }, 1500)
      },

      infinite(done) {
        console.log('infinite called')
        setTimeout(() => {
          let start = this.bottom + 1

          for (let i = start; i < start + 10; i++) {
            this.items.push(i + ' - keep walking, be 2 with you.')
          }

          this.bottom = this.bottom + 10

          done()
        }, 1500)
      },

      onItemClick(index, item) {
        console.log(index)
      }
    }
}
</script>

<style scoped>
  .my-scroller{
    top: 2rem;
    padding-bottom: 2rem; 
    overflow-y:scroll; 
  }
</style>