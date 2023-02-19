<template>
    <div>
           <div  v-if="isLogin">
            <span class="d-block">You are logged in!</span>
            <span>Name: <strong v-text="user.hasOwnProperty('name')? user.name : ''"></strong></span>
           </div>
           <span v-else>{{errors.hasOwnProperty('message')? errors.message : "" }}</span>

    </div>
</template>
<script>
export default {
    data() {
        return {
            user:{},
            isLogin: false,
            errors: {}
        };
    },
    created(){
        let token = localStorage.getItem("token");
            axios
                .get("api/userDetail", { headers: {"Authorization" : `Bearer ${token}`} } )
                .then((res) => {
                    this.isLogin= true;
                    this.user= res.data;
                })
                .catch((err) => {
                   this.errors= err.response.data;
                });
    }
}
</script>
<style></style>
