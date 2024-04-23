<template>
    <section class="vh-100 mt-5" style="background-color: #eee;">
        <div class="container h-50">
            <div class="row d-flex justify-content-center align-items-center h-50">
                <div class="col-lg-12 col-xl-11 " style="margin-top: 35px;">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                    <form @submit.prevent="register" method="post" action="#" class="mx-1 mx-md-4">
                                        <csrf-token-input />
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <label for="You last name">
                                                <i class="fas fa-user fa-lg fa-fw"></i>
                                            </label>
                                            <div class="form-outline flex-fill ">
                                                <input v-model="lname" type="text" id="form3Example1c"
                                                    class="form-control1" placeholder="Your last name" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <label for="You name">
                                                <i class="fas fa-user fa-lg fa-fw"></i>
                                            </label>
                                            <div class="form-outline flex-fill ">
                                                <input v-model="fname" type="text" id="form3Example1c"
                                                    class="form-control1" placeholder="Your last name" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <label for="your email">
                                                <i class="fas fa-envelope fa-lg  fa-fw "></i>
                                            </label>
                                            <div class="form-outline flex-fill ">
                                                <input v-model="email" type="email" id="form3Example3c"
                                                    class="form-control1" placeholder=" Your Email" value="" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <label for="password">
                                                <i class="fas fa-lock fa-lg fa-fw "></i>
                                            </label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input v-model="password" type="password" id="form3Example4c"
                                                    placeholder="Password" class="form-control1" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <label for="password_confirmed">
                                                <i class="fas fa-lock fa-lg fa-fw "></i>
                                            </label>
                                            <div class="form-outline flex-fill mb-0">
                                                <input v-model="password_confirmed" type="password" id="form3Example4c"
                                                    placeholder="Password confirmed" class="form-control1" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term">
                                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I
                                                agree all statements in <a href="#" class="term-service">Terms of
                                                    service</a></label>
                                        </div>
                                        <div class="form-group form-button mt-4">
                                            <button type="submit" class="btn btn-primary btn-lg w-100">Register</button>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="w-8/12 lg:w-1/2 col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img alt="Image d'un événement Meetup en personne" width="500" height="400"
                                        decoding="async" data-nimg="1" style="color: transparent;"
                                        srcset="https://img.freepik.com/vecteurs-libre/paiement-par-carte-credit-concept-pour-page-destination_23-2148298985.jpg?w=740"
                                        src="https://img.freepik.com/vecteurs-libre/paiement-par-carte-credit-concept-pour-page-destination_23-2148298985.jpg?w=740">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            lname: '',
            fname: '',
            email: '',
            password: '',
            password_confirmed: '',

            acceptConditions: false,
        };
    },

    methods: {
        async register() {
            try {
                const response = await axios.post('http://127.0.0.1:8000/api/register', {
                    last_name: this.lname,
                    first_name: this.fname,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmed,
                }
                );

                console.log(response.data);
                this.$router.push('/login');

            } catch (error) {
                console.error('Registration failed:', error);
            }
        },
    },
}
</script>

<style>
.form-control1 {
    width: 100%;
    display: block;
    border: none;
    border-bottom-width: medium;
    border-bottom-style: none;
    border-bottom-color: currentcolor;
    border-bottom: 1px solid #999;
    padding: 6px 15px;
    font-family: Poppins;
    box-sizing: border-box;
}
</style>