import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import Welcome from './components/Welcome'
import Page from './components/Page'
import Doc from './components/Doc'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'welcome',
            component: Welcome,
            props: { title: "This is the SPA home" }
        },
        {
            path: '/spa-page',
            name: 'page',
            component: Page,
            props: { 
                title: "This is the SPA Second Page",
                author : {
                    name : "Felik",
                    role : "Software Engineer",
                    code : "Hime hime"
                }
            }
        },
        {
            path: '/doc',
            name: 'documentation',
            component: Doc,
            props: {
                title: "Documents"
            }
        },
    ],
})
const app = new Vue({
    el: '#app',
    components: { App },
    router,
});