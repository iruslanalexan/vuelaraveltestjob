<template>
    <vs-card>
        <div class="img"></div>
        <div slot="header">
            <h3>
                {{name}}
            </h3>
        </div>
        <div>
            <span>{{description}}</span>
        </div>
         <div class="spacer" style="clear: both;"></div>
    </vs-card>
</template>

<script>
export default {
    props: ['name','description'],
    created() {
        console.log('created',this.name);
    }
}
</script>

<style scoped>
.img{
    margin-right:20px;
    width:300px;
    height:300px;
    display:block;
    background: #aaaaaa;
    float:left;
}
</style>