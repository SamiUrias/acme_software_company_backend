let Home = () => import ("./components/Home");
let About = () => import ("./components/About");
let NotFound = () => import("./components/NotFound");

export default {
    mode: 'history',
    routes: [
        {
            path:'*',
            component: NotFound
        },
        {
            path: '/',
            component: Home
        },
        {
            path: '/about',
            component: About
        }
    ]
}
