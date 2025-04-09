<template>
    <section class="get-in-touch">
        <h1 class="title">Semem Distributors</h1>
        <form class="contact-form row" @submit.prevent="submitForm">

            <div class="form-field col-lg-6">
                <input id="email" class="input-text js-input" type="email" name="email" v-model="form.email" required>
                <label class="label" for="email">Mail</label>
            </div>
            <div class="form-field col-lg-6">
                <input id="mdp" class="input-text js-input" type="password" name="password" v-model="form.password"
                    required>
                <label class="label" for="mdp">Mot de passe</label>
            </div>
            <div class="form-field col-lg-6">
                <input id="agence" class="input-text js-input" type="text" name="agence" v-model="form.agence"
                    required>
                <label class="label" for="agence">Agence</label>
            </div>
            <div class="form-field col-lg-12">
                <input class="submit-btn" type="submit" value="Connexion">
            </div>

            <!-- Affichage des erreurs si elles existent -->
            <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
        </form>

        <p v-if="errorMessage" class="error">{{ errorMessage }}</p>


    </section>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';

const errorMessage = ref('');

const form = useForm({
    email: '',
    password: '',
    agence: '', // Ajout du champ agence, pour l'agence de l'utilisateur
    // _token: document.querySelector('meta[name="csrf-token"]').getAttribute("content") // Ajout du token
});

const submitForm = () => {
    form.post('/connexion', {
        onError: (errors) => {
            if (errors.email) {
                errorMessage.value = errors.email;
            } else {
                errorMessage.value = 'Email ou mot de passe incorrect';
            }
            alert(errorMessage.value); // Affiche une alerte
        }
    });
};


</script>


<style>
        .get-in-touch {
            max-width: 800px;
            margin: 50px auto;
            position: relative;
    
        }
    
        .get-in-touch .title {
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 3.2em;
            line-height: 48px;
            padding-bottom: 48px;
            color: #5543ca;
            background: #5543ca;
            background: -moz-linear-gradient(left, #f4524d 0%, #5543ca 100%) !important;
            background: -webkit-linear-gradient(left, #f4524d 0%, #5543ca 100%) !important;
            background: linear-gradient(to right, #f4524d 0%, #5543ca 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
    
        .contact-form .form-field {
            position: relative;
            margin: 32px 0;
        }
    
        .contact-form .input-text {
            display: block;
            width: 100%;
            height: 36px;
            border-width: 0 0 2px 0;
            border-color: #5543ca;
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
        }
    
        .contact-form .input-text:focus {
            outline: none;
        }
    
        .contact-form .input-text:focus+.label,
        .contact-form .input-text.not-empty+.label {
            -webkit-transform: translateY(-24px);
            transform: translateY(-24px);
        }
    
        .contact-form .label {
            position: absolute;
            left: 20px;
            bottom: 11px;
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
            color: #5543ca;
            cursor: text;
            transition: -webkit-transform .2s ease-in-out;
            transition: transform .2s ease-in-out;
            transition: transform .2s ease-in-out,
                -webkit-transform .2s ease-in-out;
        }
    
        .contact-form .submit-btn {
            display: inline-block;
            background-color: #000;
            background-image: linear-gradient(125deg, #a72879, #064497);
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 16px;
            padding: 8px 16px;
            border: none;
            width: 200px;
            cursor: pointer;
        }
</style>