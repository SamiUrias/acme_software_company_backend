// let Home = () => import ("./components/Home");
import Home from './components/Home'
import About from "./components/About";
import NotFound  from "./components/NotFound";
import SignIn from "./components/SignIn";
import Register from "./components/Register";
import History from "./components/History";
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
            component: SignIn
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
            path: '/favorite',
            component: Favorites
        }
    ]
}
