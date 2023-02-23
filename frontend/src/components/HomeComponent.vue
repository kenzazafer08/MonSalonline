<template>
  <div class="test">
    <nav-component></nav-component>
      <div class="hero w-full flex justify-around items-center shadow-sm"> 
      <div class="mx-12 mt-12 w-1/2 h-2/3 flex flex-col justify-around items-center">   
       <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-black text-2xl">Treat Yourself to a Luxurious Experience</h1>
        <p class="mb-6 text-lg font-normal text-black lg:text-xl dark:text-gray-400">Welcome to MonSaloLine, where men can get a top-quality haircut, shave, or beard trim in a modern setting. Book your appointment today and let our skilled barbers help you look and feel your best.</p>
        <a href="#" class="inline-flex items-center px-5 py-3 text-base font-medium text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:ring-blue-300 ">
          <router-link to="/Booking"> Book Now </router-link>
            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </a>
</div> 
<img src="../assets/barber.jpg" class="h-full w-1/2 object-cover" />
      </div>
    <div class="serv flex flex-col justify-around items-center w-full "> 
       <div class="flex justify-center items-center h-3/4">
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="flex flex-col items-center justify-items-center rounded-lg shadow p-4">
      <img src="..//assets/Haircut.jpg" class="img rounded-full"/>
      <h3 class="text-2xl font-bold mb-2">Haircuts</h3>
      <p class="text-gray-700 text-lg">Our barbers are experts at creating the perfect haircut for your unique style and needs.</p>
      
    </div>
    <div class="flex flex-col items-center justify-items-center rounded rounded-lg shadow p-4">
      <img src="..//assets/ClassicShave.jpg" class="img rounded-full"/>
      <h3 class="text-2xl font-bold mb-2">Classic Shaves</h3>
      <p class="text-gray-700 text-lg">Experience the luxury and precision of a classic straight razor shave, complete with hot towel treatment and soothing aftershave.</p>
      
    </div>
    <div class="flex flex-col items-center justify-items-center rounded rounded-lg shadow p-4">
      <img src="..//assets/BeardTrim.jpg" class="img rounded-full"/>
      <h3 class="text-2xl font-bold mb-2">Beard Trims</h3>
      <p class="text-gray-700 text-lg">Whether you're going for a rugged or polished look, our barbers will help you achieve the perfect beard style.</p>
      
    </div>
  </div>
</div>

    </div>
    <div class="bg-white  py-8">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h2 class="text-3xl font-bold mb-4">Contact Us</h2>
        <p class="text-lg mb-4">We're located at:</p>
        <p class="text-lg mb-4">123 Boulvard kenedy.</p>
        <p class="text-lg mb-4">Safi, Morocco 46000</p>
        <p class="text-lg mb-4">Phone: +212 6 12 34 56 78</p>
        <p class="text-lg mb-4">Email: info@monsalonline.com</p>
      </div>
      <div class="h-96">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15507.232597711677!2d-9.237964572144926!3d32.28875268785696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdae38215289d04f%3A0x4f1a417ca4734e4!2sSafi%2046000%2C%20Morocco!5e0!3m2!1sen!2sus!4v1645738072378!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </div>
</div>
<FooterComponent></FooterComponent>
</div>
</template>
<script>
import { getCookie } from './../utils/cookies.js';
import NavComponent from './NavComponent.vue';
import FooterComponent from './FooterComponent.vue';
export default {
  components: { NavComponent ,FooterComponent},
  name: 'HomeComponent',
  data() {
    return {
      ref : '',
    }
  },
  mounted () {
  this.ref = getCookie('client');
  },
  methods : {

  }
}
</script>
<style scoped>
@import '~@fortawesome/fontawesome-free/css/all.css';
  .test{
    
    background-size: cover;
    background-position: 0%;
    height: 550px;
  }
  .img{
    width: 100px;
    height: 100px;
  }
  .hero{
    height: 550px;
  }
  
  .serv{
    height: 400px;
  }
  
  </style>