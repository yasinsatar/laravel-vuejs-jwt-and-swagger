<template lang="">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link to="/" class="navbar-brand"> Laravel </router-link>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <template v-if="!$store.getters.isAuthenticated">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/login"
                            >Login</router-link
                        >
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" to="/register"
                            >Register</router-link
                        >
                    </li>
                    </template>
                    <template v-else>
                    <li class="nav-item dropdown">
                        <a
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                        {{ user.hasOwnProperty("name") ? user.name : "" }}
                        </a>
                      
                        <div
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdown"
                        >
                            <a class="dropdown-item" @click="logout">
                                Logout
                            </a>
                        </div>
                    </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    data(){
        return{
            user: {}
        }
    },
    methods: {
        logout() {
            this.$store
                .dispatch("logout")
                .then((response) => {
                    this.$router.push("/login");
                })
                .catch((err) => {
                    this.$router.push("/login");
                    console.log(err.response.data);
                });
        },
    },
    created(){
      this.user= this.$store.getters.getUser;
    },
    updated(){   
      this.user= this.$store.getters.getUser;
    }
};
</script>
<style></style>
