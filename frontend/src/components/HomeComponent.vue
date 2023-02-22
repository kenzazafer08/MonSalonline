<template>
  <div class="test w-full h-screen flex items-center justify-center">
   <div class="home">
    <div class="nav rounded-t-lg bg-green-800 text-white">
      <h1 class="text-center  font-light text-sm p-4">Welcome {{full_name}}</h1>
      <div class="flex justify-between">
        <a class="mx-4"><i class="fa fa-sign-out"></i></a>
        <a class="mx-4"><i class="fa fa-plus"></i></a></div>
    </div> 
  <p class="title bg-gray-200 rounded-2xl px-4 py-2 w-min-24 m-4 shadow-xl text-center text-gray-800">Refference : {{ ref }}</p>
   </div>
  </div>
</template>
<script>
import { getCookie } from './../utils/cookies.js';
export default {
  name: 'HomeComponent',
  data() {
    return {
      full_name : '',
      ref : '',
    }
  },
  mounted () {
    console.log(this.ref);
    if (!getCookie('client')) {
      this.$router.push('/Login')
    } else {
      this.ref = getCookie('client');
      this.user();
      this.getAll();
    }
  },
  methods : {
    async user() {
  const response = await fetch(
    "http://localhost/MonSalonito/clients/readsingle/",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ referrence: this.ref }),
    }
  );
  const login = await response.json();
  this.full_name = login.last_name + " " + login.first_name;
  
},
async getAll() {
  const test = await fetch(
    "http://localhost/MonSalonito/appointements/readclient/",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ referrence: this.ref }),
    }
  );
  const data = await test.json();
  console.log(data) ;
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
    width:50%;
    height: 60%;
    border-radius: 20px;
  }
  .nav{
    width: 100%;
    display :flex ;
    justify-content: space-between;
    align-items: center;
  }
  </style>