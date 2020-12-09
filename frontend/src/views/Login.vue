<template>
    <div class="login">
        <b-container fluid="sm">
            <b-form-row>
                <b-col></b-col>
                <b-col>
                    <b-form @submit="login" v-if="show">
                        <b-form-group
                            id="input-group-1"
                            label="E-mail:"
                            label-for="email"
                        >
                            <b-form-input
                                id="user-email"
                                v-model="email"
                                type="email"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            id="input-group-2"
                            label="Senha:"
                            label-for="senha"
                        >
                            <b-form-input
                                id="user-password"
                                v-model="password"
                                type="password"
                                required
                            ></b-form-input>
                        </b-form-group>

                        <b-button-group>
                            <b-button type="submit" variant="success">Entrar</b-button>
                        </b-button-group>
                    </b-form>
                </b-col>
                <b-col></b-col>
            </b-form-row>
        </b-container>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            email: '',
            password: '',
            show: true
        }
    },
    methods: {
        login() {
            console.log(this)
        }
    }
}
</script>

<style>
    .login {
        margin-top: 50px;
    }
</style>