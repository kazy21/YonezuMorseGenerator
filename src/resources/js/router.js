import Vue from "vue";
import Router from "vue-router";
 
Vue.use(Router);
 
import Index from "./components/Index";
const routes = [
    { path: "/", name: 'index', component: Index },
];

const router = new Router({
    mode: "history",
    routes
});

export default router;