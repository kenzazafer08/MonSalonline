<template>
  <div class="test w-full h-screen flex items-center justify-center">
   <div class="home">
    <div class="nav rounded-t-lg bg-green-800 text-white">
      <h1 class="text-center  font-bold text-sm p-4">Welcome {{client}}</h1>
      <div class="flex justify-between">
        <a class="mx-4"><i class="fa fa-sign-out"></i></a>
        <a><i class="fa fa-plus"></i></a></div>
    </div> 
    
   </div>
  </div>
</template>
<script>
import { getCookie } from './../utils/cookies.js';
export default {
  name: 'HomeComponent',
  data() {
    return {
      client : getCookie('client')
    }
  },
  mounted () {
    if (!getCookie('client')) {
      this.$router.push('/Login')
    } 
  }
}
</script>
<style scoped>
@import '~@fortawesome/fontawesome-free/css/all.css';
  .test{
    background-image: url('../assets/bg.jpg');
    background-size: cover;
    background-position: 0%;
  }
  .home{
    background-color: white;
    width:80%;
    height: 60%;
    border-radius: 20px;
  }
  .nav{
    width: 100%;
    display :flex ;
    justify-content: space-around;
    align-items: center;
  }
  </style>