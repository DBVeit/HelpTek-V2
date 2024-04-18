<template>
  <div class="ticket-form-container">
    <h1>Meus chamados</h1>
    <div>
      <table cellpadding="5" class="chamados-list-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Prioridade</th>
            <th>Data de criação</th>
            <th>Status</th>
            <th>Atualizado em</th>
            <th>Concluído em</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="chamados in Chamados" :key="chamados.id_chamado">
            <td>{{ chamados.id_chamado }}</td>
            <td>{{ chamados.titulo_chamado }}</td>
            <td>{{ chamados.prioridade_chamado }}</td>
            <td>{{ chamados.data_criacao_fm }}</td>
            <td>{{ chamados.status }}</td>
            <td>{{ chamados.data_atualizacao }}</td>
            <td>{{ chamados.data_conclusao }}</td>
            <td>
              <button class="bt-chamado">Visualizar/Editar</button>
            </td>
            <td><button class="bt-chamado">Cancelar</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "MeusChamados",
  data() {
    return {
      ChamadoData: {
        id_chamado: "",
        titulo_chamado: "",
        prioridade_chamado: "",
        data_criacao: "",
        status: "",
        data_atualizacao: "",
        data_conclusao: "",
      },
      Chamados: [],
    };
  },
  created() {
    import("../assets/css/component/MeusChamados.css");
    this.onListarChamados();
  },
  methods: {
    onListarChamados() {
      axios
        .get(
          "http://localhost/projeto/helptek/php/api/functions/selectChamados.php?action=selectChamados"
        )
        .then((res) => {
          console.log("Server response:", res.data);
          this.Chamados = res.data.chamados;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
