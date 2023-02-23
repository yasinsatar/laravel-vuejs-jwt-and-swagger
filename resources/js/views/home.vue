<template>
       <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">
           <div  v-if="isLogin">
            <span class="d-block">You are logged in!</span>
            <span>Name: <strong v-text="user.hasOwnProperty('name')? user.name : ''"></strong></span>
           </div>
           <span v-else>{{errors.hasOwnProperty('message')? errors.message : "" }}</span>
        </div>
                </div>
            </div>
        </div>
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
        if(this.$store.getters.isAuthenticated){
            this.user = this.$store.getters.getUser;
            this.isLogin = true;
        }
    },
    updated(){
        if(this.$store.getters.isAuthenticated){
            this.user = this.$store.getters.getUser;
            this.isLogin = true;
        }
    }
}
</script>
<style></style>
