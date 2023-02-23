import { createStore } from "vuex";
import axios from "axios";
import router from "./router";

const store = new createStore({
    state() {
        return {
            user: {},
        };
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
            localStorage.setItem("user", JSON.stringify(user));
        },
        clearUser(state) {
            state.user = {};
        },
    },
    actions: {
        login({ commit, dispatch, state }, authData) {
            return axios
                .post("/api/auth/login", {
                    email: authData.email,
                    password: authData.password,
                })
                .then((response) => {
                    commit("setUser", response.data);
                });
        },
    },
    getters: {
        isAuthenticated(state) {
            return state.user.hasOwnProperty("token");
        },
        getUser(state) {
            return state.user;
        }
    },
});

export default store;
