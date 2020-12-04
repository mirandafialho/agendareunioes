<template>
    <div>
        <b-form @submit.prevent="login" v-if="show">
            <b-form-group
                id="input-group-1"
                label="E-mail"
                label-for="input-1"
                description="Nós não vamos compartilhar seu e-mail com ninguém."
            >
                <b-form-input
                id="input-1"
                v-model="email"
                type="email"
                required
                placeholder="Digite seu endereço de e-mail."
                ></b-form-input>
            </b-form-group>
            
            <b-form-group id="input-group-2" label="Senha" label-for="input-2">
                <b-form-input
                id="input-2"
                v-model="password"
                required
                placeholder="Digite sua senha."
                ></b-form-input>
            </b-form-group>
            <b-button type="submit" variant="success">Entrar</b-button>
        </b-form>
    </div>
</template>

<script>
    export default {
        name: login,
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login() {
                this.$store.dispatch('retrieveToken', {
                    username: this.username,
                    password: this.password
                })
            }
        }
    }
</script>