<template>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Sign In</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
                                  method="POST">
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
                                <div>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </div>
                                <button type="button" class="btn btn-success btn-lg float-right" id="btnLogin"
                                        @click="signIn">Sing In
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
                email: '',
                password: ''
            }
        },
        methods: {
            signIn() {
                let signInObject = {
                    email: this.email,
                    password: this.password
                };
                let headers = {
                    'Content-Type': 'application/json'
                };

                axios.post('http://localhost:8000/api/login', signInObject, {headers: headers}).then(response => {
                    console.log(response);

                    // Save the token
                    setCookie('acmet',response.data.success.token, 7);
                    this.$store.commit('SET_AUTH_TOKEN', response.data.success.token)
                    this.$router.push({path:'/'});
                }).catch(error => {
                    console.error(error);
                })
            },

        }
    }
</script>

<style scoped>

</style>
