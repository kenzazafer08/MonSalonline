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
              Appointement
            </label>
            <div  v-if="data.Date">
              <div class="flex flex-wrap" v-if="day"> 
                <div v-for="(hour, index) in availableHours"
                      :key="index"
                      :class="['m-2 py-2 px-4 border border-transparent font-medium rounded-md shadow-sm text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500', 
                        hour.etas ? 'bg-red-800 text-white cursor-not-allowed' : 'bg-white shadow-sm shadow-black hover:bg-white']">
                 <button v-if="hour.etas" @click.prevent="cancelday()">{{ hour.val }}</button>
                 <button  v-else @click.prevent="cancelday()"> {{ hour.val }} </button>
            </div>
              </div> 
              <div class="flex flex-wrap" v-else> 
                <div v-for="(hour, index) in availableHours"
                      :key="index"
                      :class="['m-2 py-2 px-4 border border-transparent font-medium rounded-md shadow-sm text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500', 
                        hour.etas ? 'bg-red-800 text-white cursor-not-allowed' : 'bg-white shadow-sm shadow-black hover:bg-white']">
                 <button v-if="hour.etas" @click.prevent="cancel()">{{ hour.val }}</button>
                 <button  v-else @click="data.Heure = hour.val"> {{ hour.val }} </button>
            </div>
              </div>
            </div>
            <div v-else class="text-center w-full text-purple-400 font-bold">Choose a Date</div>
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
      day : false,
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
     userbookedAppointments : [],
    };
  },
  mounted(){
    this.getAll();
    this.getApp();
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
    cancel(){
      this.$swal("This appointement is already reserved");
      this.data.Heure = '';
    },
    cancelday(){
      this.$swal("You have already an appointement in this day");
      this.data.Heure = '';
    },
    async getApp(){
      const url = 'http://localhost/MonSalonito/appointements/readclient/' + this.data.client_id;
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
      this.userbookedAppointments = user;
      console.log(this.userbookedAppointments)
    },
    updateAvailableHours() {
      this.day = false;
      if(this.userbookedAppointments){
        this.userbookedAppointments.forEach(app => {
          if(this.data.Date == app.date){
            this.day = true;
          }
        })
      }
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
          this.availableHours.push({
          selected: false,
          etas: false,
          val: `${i.toString().padStart(2, '0')}:00`
        });
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
      if (!this.data.Heure) {
        this.$swal("Veuillez sélectionner une heure disponible.");
        return;
      }
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