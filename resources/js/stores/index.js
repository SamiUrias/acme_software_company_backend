
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

import { getCookie, eraseCookie } from "../components/functions/cookieFunctions";


Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        auth_token: ''
    },
    mutations: {
        SET_AUTH_TOKEN(state, payload) {
            state.auth_token = payload;
        }
    },
    actions: {
        async logout ({state, commit, getters}) {
            console.log('Inside logout');
            console.log(getters.authToken);
            let headers = {
                'Content-Type': 'application/json',
                'Authorization':`Bearer ${getters.authToken}`
            };

            console.log(headers.Authorization);
            await axios.post('http://localhost:8000/api/logout','', {headers:headers}).then(response => {
                    console.log(response);
                    eraseCookie('acmet');
                    state.auth_token = '';
                })
                .catch(error => {
                    console.error(error);
                    console.error(error.response);
                })
        }
    },
    getters: {
        authToken: state => {
            if(state.auth_token) {
                return state.auth_token;
            } else {
                return getCookie('acmet');
            }
        }
    }
});


