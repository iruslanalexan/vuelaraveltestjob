<template>
    <vs-card class="card">
        <div class="v-img_box" ref="img">
            <img class="v-img"  v-bind:src="'/api/cars/get_image?id='+car.id" :alt="car.name">
        </div>
        <div slot="header">
            <h3>
                {{car.name}}
            </h3>
        </div>
        <div>
            <p>Номер двиг. : {{car.engine_number}}</p>
            <p>Обьем двигателя : {{car.engine_volume}}</p>
            <p>Год выпуска : {{car.pub_year}}</p>
            <p>Цвета :  {{ getColors }} </p>
            <p>Описание {{car.description}}</p>
            <b-button-group class="btn-group">
                <b-button variant="primary">Редактировать</b-button>
                <b-button v-on:click="emitDeleteEvent">Удалить</b-button>
            </b-button-group>
        </div>
         <div class="spacer" style="clear: both;"></div>
    </vs-card>
</template>

<script>
export default {
    props: ['car'],
    methods : {
        emitDeleteEvent() {
            console.log('emitDeleteEvent');
            this.$emit('remove',this.car.id);
        }
    },
    computed : {
        getColors() {
            let colors = []
            for(let color of this.car.colors){
                colors.push(color.name);
            }
            return colors.join(",");
        }
    }
}
</script>

<style scoped>
.v-img_box{
    margin-right:20px;
    width:300px;
    height:300px;
    display:block;
    /* background: #aaaaaa; */
    float:left;
}
.v-img{
    height: 100%;
    width:100%;
}
.btn-group {
    position: absolute;
    bottom: 10px;
    right: 20px;
}
.card{
    position: relative;
}

</style>