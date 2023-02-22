
<template>
    <div class="test w-full h-screen flex items-center justify-center">
     <div class="form flex flex-col items-center justify-center shadow-lg shadow-green-500/50"> 
      <h1 class="font-bold text-2xl mb-6 text-green-700 hover:text-black">Salonline</h1>
       
  <form class="flex flex-col items-center justify-around" @submit.prevent="Signin">
    <label for="reference" class="block mb-2 text-sm font-medium text-gray-900">Your reference</label>
    <input type="text" v-model="referrence" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" placeholder="X1234H" required>
    <p class="m-2">You don't have an acount ! <span class="font-bold text-green-700"><router-link to="/">Sign In</router-link></span></p>
    <button type="submit" class="text-white align-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1.5 text-center ">Log In</button>
  </form>
  
     </div>
    </div>
  </template>
  <script>
  import { setCookie } from './../utils/cookies.js';
  export default {
    name: 'SignIn',
    data() {
    return {
      referrence : ""
      }
    },
  methods : {
    async Signin() {
      console.log('hi')
      const response = await fetch(
        "http://localhost/MonSalonito/clients/login/" +this.referrence,
        {
          method: "POST",
          headers: {
          "Content-Type": "application/json", },
          body: JSON.stringify({ referrence: this.referrence }), 
        }
      )
      
      const login = await response.json();
      
      if(login.message == true){
        this.$swal(`Login succesfuly`);
        setCookie('client', login.client, 1);
        this.$router.push('/Home')
        this.referrence = ""
      }else{
        this.$swal(`Wrong reffrence`);
        this.referrence = ""
      }
    }
  }}
  </script>
  <style scoped>
  .test{
    background-image: url('../assets/bg.jpg');
    background-size: cover;
    background-position: 0%;
  }
  .form{
    background-color: white;
    width:25%;
    height: 40%;
    border-radius: 5%;
  }
  </style>
  
  
  