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
}
</script>
<style></style>
