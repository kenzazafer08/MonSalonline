<template>
    <div>
      <nav-component></nav-component>
      <div class="book">
        <div class="flex justify-center items-center w-full h-full mx-auto py-8">
    <form class="w-1/2 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="book">
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="date">
          Date
        </label>
        <input required :min="minDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" v-model="data.Date" @change="updateAvailableHours"/>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="time">
          Heure
        </label>
        <select required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="time" v-model="data.Heure">
          <option v-for="hour, index in availableHours" :key="index" :value="hour.val" :disabled="hour.etas" >{{ hour.val }}</option>
        </select>
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Envoyer
        </button>
      </div>
    </form>
  </div>
      </div>
      <FooterComponent></FooterComponent>
    </div>
</template>
<script>
import NavComponent from './NavComponent.vue';
import FooterComponent from './FooterComponent.vue';
import { getCookie } from './../utils/cookies.js';
export default {
  components: { NavComponent ,FooterComponent},
  name: 'BookComponent',
  data() {
    return {
     data :{
      client_id : getCookie('client'),
      Date : '',
      Heure : '',
     },
     minDate: new Date().toISOString().split("T")[0],
     availableHours : [
     { val: "", etat: false },
     ],
     bookedAppointments : [],
    };
  },
  mounted(){
    this.getAll();
  },
  methods: {
    async getAll(){
      const url = 'http://localhost/MonSalonito/appointements/read/';
      const response = await fetch(
        url,
        {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        }
      )
      const user = await response.json(); 
      this.bookedAppointments = user;
    },
    updateAvailableHours() {
      const date = new Date(this.data.Date);
      const day = date.getDay();
      let startHour;
      let endHour;
      let lunchStart = 12;
      let lunchEnd = 13;
      if (day >= 1 && day <= 4 || day === 6) { // Du lundi au jeudi et le samedi
        startHour = 9;
        endHour = 20;
      } else if (day === 5) { // Le vendredi
        startHour = 9;
        endHour = 22;
      } else if (day === 0) { // Le dimanche
        startHour = 9;
        endHour = 12;
      }
      this.availableHours = [];
      for (let i = startHour; i <= endHour; i++) {
        if(i< lunchStart || i>lunchEnd ){
          this.availableHours.push( {
          val : `${i.toString().padStart(2, '0')}:00`,
          etas : false
        } );
      }
      }
      this.availableHours.forEach(item=>{
        this.bookedAppointments.forEach(app => {
          if(this.data.Date == app.date && item.val == app.Heure){
            item.etas = true;
          }
        })
      });
      console.log(this.availableHours);
    },
    async book() {
      const url = 'http://localhost/MonSalonito/appointements/addappointement/';
      const response = await fetch(
        url,
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
          client_id: this.data.client_id,
          date : this.data.Date,
          Heure : this.data.Heure
          }), 
        }
      )
      const user = await response.json(); 
      console.log(user.message)
      this.$swal(user.message);
      this.$router.push('/Appointements')
      this.data.Date = ''
      this.data.Heure = ''
      this.availableHours = []
      this.bookedAppointments = []
      }
  },
}
</script>
<style scoped>
.book{
    height: 430px;
}
</style>