<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form @submit.prevent="submitHandler">
                            <div class="row mb-3 text-center">
                                <span
                                    class="invalid-feedback"
                                    :class="{
                                        'd-block':
                                        !errors.hasOwnProperty('errors')
                                    }"
                                    role="alert"
                                >
                                    <strong
                                        v-if="!errors.hasOwnProperty('errors')"
                                    >
                                        {{ errors.message }}</strong
                                    >
                                </span>
                            </div>
                            <div class="row mb-3">
                                <label
                                    for="email"
                                    class="col-md-4 col-form-label text-md-end"
                                    >Email Address</label
                                >

                                <div class="col-md-6">
                                    <input
                                        v-model="form.email"
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        required
                                        autocomplete="email"
                                        autofocus
                                    />

                                    <span
                                        class="invalid-feedback"
                                        :class="{
                                            'd-block':
                                                errors.hasOwnProperty('errors'),
                                        }"
                                        role="alert"
                                    >
                                        <div>
                                            <strong
                                                v-if="errors.hasOwnProperty('errors')"
                                                v-for="error in errors.email"
                                            >
                                                {{ error }}}</strong
                                            >
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-end"
                                    >Password</label
                                >

                                <div class="col-md-6">
                                    <input
                                        v-model="form.password"
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        required
                                        autocomplete="current-password"
                                    />

                                    <span
                                        class="invalid-feedback"
                                        :class="{
                                            'd-block':
                                                errors.hasOwnProperty('errors'),
                                        }"
                                        role="alert"
                                    >
                                        <div>
                                            <strong
                                                v-if="errors.hasOwnProperty('errors')"
                                                v-for="error in errors.errors.password"
                                            >
                                                {{ error }}</strong
                                            >
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input
                                        v-model="form.remember_me"
                                            class="form-check-input"
                                            type="checkbox"
                                            name="remember"
                                            id="remember"
                                        />

                                        <label
                                            class="form-check-label"
                                            for="remember"
                                        >
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Login
                                    </button>

                                    <a
                                        class="btn btn-link"
                                        href="javascriprt:void(0)"
                                    >
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
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
            form: {
                email: "",
                password: "",
                remember_me: false,
            },
            errors: {},
        };
    },
    methods: {
        submitHandler() {
            this.$store
                .dispatch("login", { ...this.form })
                .then((response) => {
                    this.$router.push("/");
                })
                .catch((err) => {
                    this.errors = err.response.data;
                });
        },
    },
};
</script>
<style></style>
