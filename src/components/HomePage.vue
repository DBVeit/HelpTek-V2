<template>
  <div>
    <div class="header">
      <img
        src="../assets/img/LogoHelpTek.png"
        alt="HelpTek Logo"
        class="logo"
      />
      <input type="search" placeholder="Pesquisar aqui" class="search-bar" />
      <button class="new-ticket-btn">Novo chamado</button>
    </div>
    <div class="main-container">
      <aside class="sidebar">
        <div class="welcome-message">
          Bem vindo, <strong>Demo Admin User</strong> (Admin)
        </div>
        <nav class="nav-menu">
          <a class="nav-item" @click.prevent="CriarChamadoForm = true"
            >Criar chamado</a
          >
          <a href="#" class="nav-item">Meus chamados</a>
          <a href="#" class="nav-item">Todos os chamados</a>
          <a href="#" class="nav-item">Caixa de entrada</a>
          <a href="#" class="nav-item">Dashboard</a>
          <a href="#" class="nav-item">Relatórios</a>
          <a href="#" class="nav-item">Perfil</a>
          <a href="#" class="nav-item">Configurações do sistema</a>
          <a href="#" class="nav-item">Configurações de usuários</a>
        </nav>
      </aside>
      <main class="main-content">
        <CriarChamado v-if="CriarChamadoForm" />
        <!--<MeusChamados />
        <TodosChamados />
        <CaixaEntrada />
        <Dashboard />
        <Relatorios />
        <Perfil />
        <ConfigSist />
        <ConfigUsers />-->
      </main>
    </div>
  </div>
</template>
<script>
import CriarChamado from "@/components/CriarChamado.vue";

export default {
  name: "HomePage",
  components: {
    CriarChamado,
  },

  created() {
    import("../assets/css/component/HomePage.css")
      .then(() => {
        console.log("HomeView style loaded");
      })
      .catch((err) => {
        console.error("HomeView style load failed", err);
      });
  },

  data() {
    return {
      CriarChamadoForm: false,
    };
  },
};
</script>
