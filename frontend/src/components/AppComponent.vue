<template>
    <div>
      <nav-component></nav-component>
      <div class="book"></div>
      <FooterComponent></FooterComponent>
    </div>
</template>
<script>
import NavComponent from './NavComponent.vue';
import FooterComponent from './FooterComponent.vue';
export default {
  components: { NavComponent ,FooterComponent},
  name: 'AppComponent',
}
</script>
<style scoped>
.book{
    height: 430px;
}
</style>