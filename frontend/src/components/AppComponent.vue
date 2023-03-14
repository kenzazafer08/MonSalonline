<template>
    <div>
      <nav-component></nav-component>
      <div  class="flex w-full items-center justify-center"><span class="mt-20 mb-0 text-purple-800 "><router-link to="/Booking"><i class="fa fa-long-arrow-left"></i> Book Now</router-link></span></div>
      <div class="book flex flex-col w-full items-center justify-center">
        <table  class="table-auto w-3/4 mt-10">
          <thead>
            <tr>
              <th class="border px-4 py-2 font-light">Date</th>
              <th class="border px-4 py-2 font-light">Heure</th>
              <th class="border px-4 py-2 font-light">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="appointment in bookedAppointments" :key="appointment.id">
              <td class="border px-4 py-2">{{ appointment.date }}</td>
              <td class="border px-4 py-2">{{ appointment.Heure }}</td>
              <td class="border px-4 py-2 flex justify-around">
                <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded" @click.prevent="editAppointment(appointment)">
                  Edit
                </button>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" @click.prevent="deleteAppointment(appointment.appointment_id)">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div v-if="cool" class="form">
          <div class="flex justify-center items-center w-full h-full ">
    <form class="mt-10 w-3/4 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="update(this.currentApp)">
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="date">
          Date
        </label>
        <input required :min="minDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" v-model="data.Date" @change="updateAvailableHours" />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="time">
          Heure
        </label>
        <div class="flex flex-wrap">
              <button v-for="(hour, index) in availableHours"
                      :key="index"
                      @click="data.Heure = hour.val"
                      :class="['m-2 py-2 px-4 border border-transparent font-medium rounded-md shadow-sm text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500', 
                        hour.etas ? 'bg-red-800 text-white cursor-not-allowed' : 'bg-white shadow-sm shadow-black hover:bg-white']">
                  {{ hour.val }}
              </button>
            </div>
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" >
          Update
        </button>
      </div>
    </form>
  </div>
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
  name: 'AppComponent',
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
    client_id : getCookie('client'),
     bookedAppointments : [],
     cool : false,
     currentApp : '',
    };
  },
  mounted(){
    this.updateAvailableHours()
    this.getAll();
  },
  methods: {
    async getAll(){
      const url = 'http://localhost/MonSalonito/appointements/readclient/';
      const response = await fetch(
        url,
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            referrence: this.client_id
          }), 
        }
      )
      const user = await response.json(); 
      if(user == null){
        this.$swal('You have no Appoinetement yet Book one');
        this.$router.push('/Booking')
      }
      this.bookedAppointments = user;
    },
    async deleteAppointment(appointment) {
        const url = 'http://localhost/MonSalonito/appointements/delete/' + appointment;
        const response = await fetch(
          url,
          {
            method: "DELETE",
            headers: {
              "Content-Type": "application/json",
            }, 
          }
        );
      const user = await response.json(); 
      console.log(user);
      this.$swal('Appoinetement deleted');
      this.getAll();
      },
      async editAppointment(appointment){
        
        this.currentApp = appointment.appointment_id
        const url = 'http://localhost/MonSalonito/appointements/readsingle/' + this.currentApp;
        const response = await fetch(
          url,
          {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
            }, 
          }
        );
      const user = await response.json(); 
      this.data.Date = user.date
      this.data.Heure = this.AvailableHours(appointment)
      console.log(this.data.Date);
      console.log(this.data.Heure);
      this.cool = true;
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
AvailableHours(Appoinetement) {
      const date = new Date(Appoinetement.date);
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
    async update(currentApp) {
      const url = 'http://localhost/MonSalonito/appointements/update/'+currentApp;
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
      this.$swal('Appointement Updated');
      this.getAll();
      this.cool=false
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
    min-height: 300px;
}
.form{
  height: 500px;
}
</style>