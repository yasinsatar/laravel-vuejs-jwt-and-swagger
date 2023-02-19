<template >
    <div>
        <form @submit.prevent="submitHandler">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col-md-6">
                                <input  v-model="form.email" id="email" type="email" class="form-control " name="email"  required autocomplete="email" autofocus>

                             
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ message }}</strong>
                                    </span>
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input v-model="form.password" id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                               
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ message }}</strong>
                                    </span>
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" >

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Login
                                </button>

                              
                                    <a class="btn btn-link" href="javascriprt:void(0)">
                                        Forgot Your Password?
                                    </a>
                               
                            </div>
                        </div>
                    </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            message: "",
        };
    },
    methods: {
        submitHandler() {
            axios
                .post("api/auth/login", { ...this.form })
                .then((res) => {
                    localStorage.setItem("token",res.data.access_token);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
}
</script>
<style >
    
</style>