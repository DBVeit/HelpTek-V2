<template>
  <div class="container">
    <div class="logo">
      <img src="../assets/img/LogoHelpTek.png" alt="Logo HelpTek" />
    </div>
    <form method="POST" class="login-form" @submit.prevent="onLogin()">
      <div class="input-group">
        <input
          type="text"
          id="username"
          v-model="User.username"
          placeholder="Nome de usuário"
          name="username"
          autocomplete="off"
          required
        />
      </div>
      <div class="input-group">
        <input
          type="password"
          id="password"
          v-model="User.password"
          placeholder="Senha"
          name="password"
          autocomplete="off"
          required
        />
      </div>
      <div class="forgot-recover">
        <a href="#" class="recover-password">Recuperar Login</a>
      </div>
      <button type="submit">Entrar</button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "LoginForm",
  data() {
    return {
      User: { username: "", password: "" },
    };
  },
  methods: {
    onLogin() {
      if (!this.User.username || !this.User.password) {
        alert("Por favor, preencha todos os campos.");
        return;
      }

      let data = new FormData();
      data.append("username", this.User.username);
      data.append("password", this.User.password);
      axios
        .post(
          "http://localhost/projeto/helptek/php/api/api.php?action=login",
          data
        )
        .then((res) => {
          console.log("Server response:", res.data.code);
          if (res.data.code !== 200) {
            //console.log("Error: ", res.data.code);
            alert(res.data.msg);
          } else {
            //console.log("Success", res.data.code);
            alert(res.data.msg);
            this.$router.push("/HomeView");
          }
        })
        .catch((err) => {
          console.log("Err", err);
        });
    },
  },
};
</script>
<style>
@import "../assets/css/component/LoginForm.css";
</style>
