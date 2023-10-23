import { createRouter, createWebHistory } from 'vue-router'
import storage from "./storage";

const baseRoutes = []

const routes = baseRoutes.concat(
    storage,
)

const router = createRouter({
    history: createWebHistory(),
    scrollBehavior() {
        return { top: 0 }
    },
    routes
})

export default router
