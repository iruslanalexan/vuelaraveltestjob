<template>
  <vs-row>
      <vs-card>
        <vs-col 
        v-for="item in car_list" 
        v-bind:key="item.id"
        type="flex" vs-justify="center" vs-align="center">
            <CarBox v-bind:name="item.name" v-bind:description="item.description"/>
        </vs-col>
      </vs-card>
  </vs-row>
</template>

<script>
export default {
  name: 'Hello',
  data() {
      return {
          'car_list' : [
              {name: 'Toyota Camry', description : 'Открывает наш рейтинг Toyota Camry. Этот седан настоящий бестселлер. Не раз данный автомобиль был самым продаваемым в России, США и других странах. Конкурентами этой иномарки являются Mazda 6, Nissan Teana, Skoda Superb.'},
              {name: 'Skoda Superb', description : 'На втором месте в рейтинге лучших автомобилей класса седан расположился первый конкурент Toyota Camry. При покупке Skoda Superb в базовой комплектации вы будете наслаждаться уже включенными в стоимость ABS, подушками безопасности, электростеклоподъемниками передние и задние, регулировкой руля по высоте и вылету. '},
          ]
      }
  }
}
</script>

<style lang="stylus">

</style>