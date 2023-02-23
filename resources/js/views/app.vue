<template>
    <navbar></navbar>
    <router-view class="py-4"></router-view>
</template>
<script>
import Navbar from "@/components/navbar.vue";
export default {
   data(){
    return{
      user: {}
    }
   },
    components: {
    Navbar
    }, 
    created(){
      this.$store.dispatch("initAuth");
    },
    updated(){   
      this.$store.dispatch("initAuth");
    }
}
</script>
<style scoped>
</style>