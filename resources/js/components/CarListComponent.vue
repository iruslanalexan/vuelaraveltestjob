<template>
  <vs-row>
      <vs-card>
        <transition-group name="list" tag="p">
          <vs-col
          v-for="item in car_list"
          v-bind:key="item.id"
          type="flex" vs-justify="center" vs-align="center">
              <CarBox class="list-item" v-bind:car="item" v-on:remove="removeCar"/>
          </vs-col>
      </transition-group>
      </vs-card>
  </vs-row>
</template>

<script>
export default {
    name: 'Hello',
    data() {
        return {
          'car_list' : []
        };
    },
    methods : {
      async loadCars() {
        this.$vs.loading();
        let res = await axios.get('/api/cars');
        this.car_list = res.data;
        this.$vs.loading.close();
      },
      async removeCar(id){
        console.log("hello from parent component!!!");
        let ind = 0;
        for(let [i,car] of this.car_list.entries()){
          if(id==car.id){
            ind = i;
          }
          // console.log(i,car.id);
        }
        let response = await axios({
          method: 'get',
          url: '/api/cars/delete',
          params : {
            id : id
          }
        });
        console.log(response);
        this.car_list.splice(ind,1);
      }
    },
    mounted() {
      this.loadCars();
    }
}
</script>

<style>
  .list-item {
    display: inline-block;
    margin-right: 10px;
  }
  .list-enter-active, .list-leave-active {
    transition: all 1s;
  }
  .list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
    opacity: 0;
    transform: translateY(30px);
  }
  .list-move {
    transition: transform 1s;
  }
</style>
