// let Home = () => import ("./components/Home");
import Home from './components/Home'
let About = () => import ("./components/About");
let NotFound = () => import("./components/NotFound");
let SingIn = () => import("./components/SignIn");
let Register = () => import("./components/Register");
let History = () => import("./components/History");
import Favorites from "./components/Favorites";

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
        },
        {
            path: '/history',
            component: History
        },
        {
            path: '/favorites',
            component: Favorites
        }
    ]
}
