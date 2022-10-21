<template>
  <div>
    <vs-navbar  class="nabarx">
      <div slot="title">
        <vs-navbar-title>
          Hello world
        </vs-navbar-title>
      </div>
      <vs-navbar-item index="0">
        <router-link to="/">Список</router-link>
      </vs-navbar-item>
      <vs-navbar-item index="1">
        <router-link to="/create">Добавить</router-link>
      </vs-navbar-item>
    </vs-navbar>
  </div>
</template>
<script>
export default {}
</script>