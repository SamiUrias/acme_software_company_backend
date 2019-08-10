let Home = () => import ("./components/Home");
let About = () => import ("./components/About");
let NotFound = () => import("./components/NotFound");
let SingIn = () => import("./components/SignIn");
let Register = () => import("./components/Register");

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
        },
        {
            path: '/sign-in',
            component: SingIn
        },
        {
            path: '/register',
            component: Register
        }
    ]
}
