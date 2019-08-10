<template>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Register</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
                                  method="POST">
                                <div class="form-group">
                                    <label for="uname1">Name</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="name"
                                           id="name" required="" v-model="name">
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label for="uname1">Email</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="uname1"
                                           id="uname1" required="" v-model="email">
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="pwd1"
                                           required="" autocomplete="new-password" v-model="password">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="pwdc"
                                           required="" autocomplete="new-password" v-model="confirmPassword">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <div>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </div>
                                <div v-if="errorArray.length">
                                    <ul>
                                        <li v-for="(error, index) in errorArray" style="color: red">{{error}}</li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-success btn-lg float-right" id="btnLogin"
                                        @click="signIn">Register
                                </button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->

    <!--/container-->
</template>

<script>
    import axios from 'axios';
    import { setCookie } from "./functions/cookieFunctions";

    export default {
        name: "SignIn",
        data() {
            return {
                name: '',
                email: '',
                password: '',
                confirmPassword:'',

                errorArray: []
            }
        },
        methods: {
            validate(){

            },
            signIn() {
                this.errorArray = [];
                let signInObject = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    confirmPassword: this.confirmPassword
                };
                let headers = {
                    'Content-Type': 'application/json'
                };

                axios.post('http://localhost:8000/api/register', signInObject, {headers: headers}).then(response => {
                    console.log(response);

                    // Save the token
                    setCookie('acmet',response.data.success.token, 7);
                    this.$store.commit('SET_AUTH_TOKEN', response.data.success.token)
                    this.$router.push({path:'/'});
                }).catch(error => {
                    console.log('Here')
                    console.error(error.response);
                    if(error.response.data.errors) {
                        let errorValues = Object.values(error.response.data.errors);
                        errorValues.forEach(errorArray => {
                            errorArray.forEach(message => {
                                console.log(message)
                                this.errorArray.push(message);
                            })
                        })
                    }
                })
            },

        }
    }
</script>

<style scoped>

</style>
