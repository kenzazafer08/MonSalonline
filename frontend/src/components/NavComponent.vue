<template>
<div class="nav bg-white h-16 text-white shadow-2xl"> 
      <div class="mx-12"> 
        <router-link to="/Home"><img src="../assets/logo.png" class="logo"/></router-link>
      </div>
      <div class="flex"> 
        <h1 class="mx-4 bg-white text-green-800 px-4 py-2 rounded-sm cursor-pointer hover:text-white hover:bg-green-800"><router-link to="/Appointements">{{full_name}}</router-link> </h1>
      <button  class="mx-12 cursor-pointer bg-white text-green-800 px-4 py-2 rounded-sm hover:text-white hover:bg-green-800" @click="logout()"><i class="fa fa-sign-out"></i></button>
      </div>
</div>
</template>
<style scoped>
.nav{
    width: 100%;
    display :flex ;
    justify-content: space-between;
    align-items: center;
  }
  .logo{
    width: 50px;
    height: 50px;
  }
</style>
<script>
import {eraseCookie} from './../utils/cookies.js';
import {getCookie} from './../utils/cookies.js';
export default {
name: 'nav-component',
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
logout(){
      eraseCookie('client');
      this.$router.push('/Login')
    },
},
}
</script>
