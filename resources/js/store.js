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
            localStorage.removeItem("user");
        },
    },
    actions: {
        initAuth({ commit, dispatch }) {
            let user = JSON.parse(localStorage.getItem("user"));
            if (user){
                let time =  parseInt(new Date().getTime() / 1000);
                //let time_diff = user.expires_at - time;
                //console.log(time + ": " + user.expires_at + " : " + time_diff);
                if (time >= +user.expires_at) {
                    console.log("Token expired.");
                    dispatch("logout");
                } else {
                    commit("setUser", user);
                }
            } else {
                router.replace("/login");
                console.log("Unauthenticated.");
            }
        },
        register({ commit, dispatch, state }, authData) {
            return axios
                .post("/api/auth/register", {
                    ...authData
                })
                .then((response) => {
                    commit("setUser", response.data);
                });
        },
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
        logout({ commit, dispatch, state }) {
            return axios
                .get("/api/auth/logout",{headers:{"Authorization" : `Bearer ${state.user.token}`}})
                .then((response) => {
                    commit("clearUser");
                }).catch(err=>{
                    commit("clearUser");

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
