import { createRouter, createWebHistory } from "vue-router";


import store from "./store";
import Home from "@/views/home.vue"
import Login from "@/views/auth/login.vue" 
import Register from "@/views/auth/register.vue" 
import PageNotFound from "@/views/404.vue"



const  router = new createRouter({
    routes: [
        {
            path: "/",
            component: Home,
            beforeEnter(to,from,next){
                if(store.getters.isAuthenticated){
                    next()
                }else{
                    next("/login")
                }
            }
        },
        {
            path: "/login" , component: Login,
            beforeEnter(to,from,next){
                if(store.getters.isAuthenticated){
                    next("/")
                }else{
                    next()
                }
            }
        },
        {
            path: "/register" , component: Register,
            beforeEnter(to,from,next){
                if(store.getters.isAuthenticated){
                    next("/")
                }else{
                    next()
                }
            }
            
        },
        { path: '/:pathMatch(.*)*', component: PageNotFound },

    ],
    history: createWebHistory(),
});

export default router;