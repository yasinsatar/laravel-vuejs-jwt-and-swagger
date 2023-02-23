<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

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
                                    for="name"
                                    class="col-md-4 col-form-label text-md-end"
                                    >Name</label
                                >

                                <div class="col-md-6">
                                    <input
                                        v-model="form.name"
                                        id="name"
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        required
                                        autocomplete="name"
                                        autofocus
                                    />

                                    <span
                                        class="invalid-feedback"
                                        :class="{
                                            'd-block':
                                            errors.hasOwnProperty('errors')
                                        }"
                                        role="alert"
                                    >
                                        <div>
                                            <strong
                                                v-if=" errors.hasOwnProperty('errors')"
                                                v-for="error in errors.errors.name"
                                            >
                                                {{ error }}</strong
                                            >
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label
                                    for="email"
                                    class="col-md-4 col-form-label text-md-end"
                                    >Email</label
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
                                    />

                                    <span
                                        class="invalid-feedback"
                                        :class="{
                                            'd-block':
                                            errors.hasOwnProperty('errors')
                                        }"
                                        role="alert"
                                    >
                                        <div>
                                            <strong
                                                v-if="errors.hasOwnProperty('errors')"
                                                v-for="error in errors.errors.email"
                                            >
                                                {{ error }}</strong
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
                                        autocomplete="new-password"
                                    />
                                    <span
                                        class="invalid-feedback"
                                        :class="{
                                            'd-block':
                                            errors.hasOwnProperty('errors')
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
                                <label
                                    for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end"
                                    >Confirm Password</label
                                >

                                <div class="col-md-6">
                                    <input
                                        v-model="form.password_confirmation"
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    />
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Register
                                    </button>
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
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            errors: {},
        };
    },
    methods: {
        submitHandler() {
            this.$store
                .dispatch("register", { ...this.form })
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
