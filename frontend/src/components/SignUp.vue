
<template>
  <div class="test w-full h-screen flex items-center justify-center">
   <div class="form flex flex-col items-center justify-center shadow-lg shadow-green-500/50"> 
    <h1 class="font-bold text-2xl mb-6 text-green-700 hover:text-black">Salonline</h1>
     
<form class="flex flex-col items-center justify-around">
  <label for="reference" class="block mb-2 text-sm font-medium text-gray-900">Your first name</label>
  <input type="text" name="reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" placeholder="Kenza" required>
  <label for="reference" class="block mb-2 text-sm font-medium text-gray-900">Your last name</label>
  <input type="text" name="reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" placeholder="ZAFER" required>
  <label for="reference" class="block mb-2 text-sm font-medium text-gray-900">Your phone number</label>
  <input type="text" name="reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" placeholder="0634047964" required>
  <p class="m-2">You do have an acount ! <span class="font-bold text-green-700"><router-link to="/">Sign Up</router-link></span></p>
  <button type="submit" class="text-white align-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1.5 text-center ">Sign In</button>
</form>

   </div>
  </div>
</template>
<script>
export default {
  name: 'SignUp'
}
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
  height: 60%;
  border-radius: 5%;
}
</style>


