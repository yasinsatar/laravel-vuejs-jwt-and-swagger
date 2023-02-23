<template>
    <navbar></navbar>
    <router-view class="py-4"></router-view>
</template>
<script>
import Navbar from "@/components/navbar.vue";
export default {
    components: {
    Navbar
    }, 
}
</script>
<style scoped>
</style>