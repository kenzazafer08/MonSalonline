<template>
    <h1>hello</h1>
</template>
<script>
import { getCookie } from './../utils/cookies.js';
export default {
  name: 'HomeComponent',
  mounted () {
    if (!getCookie('client')) {
      this.$router.push('/Login')
    } 
  }
}
</script>