<template>
  <div class="ticket-form-container">
    <h1>Meus chamados</h1>
    <div class="filter">
      Filtros:
      <select>
        <option selected disabled>Selecionar...</option>
        <option>Em aberto</option>
        <option>Em atendimento</option>
        <option>Concluídos</option>
      </select>
      <a href="">Limpar filtros</a>
    </div>
    <div>
      <table cellpadding="5" class="chamados-list-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Prioridade</th>
            <th>Data de criação</th>
            <th>Status</th>
            <!--<th>Minutos de espera</th>-->
            <th>Atualizado em</th>
            <th>Concluído em</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="chamados in Chamados" :key="chamados.id_chamado">
            <td>{{ chamados.id_chamado }}</td>
            <td class="title">{{ chamados.titulo_chamado }}</td>
            <td>{{ chamados.prioridade_chamado }}</td>
            <td>{{ chamados.data_criacao_fm }}</td>
            <td>{{ chamados.status }}</td>
            <!--<td>{{ chamados.minutos_espera }}</td>-->
            <td>{{ chamados.data_atualizacao }}</td>
            <td>{{ chamados.data_conclusao }}</td>
            <td>
              <button
                class="bt-chamado"
                data-bs-toggle="modal"
                data-bs-target="#myModal"
                @click="verChamado(chamados)"
              >
                Ver
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="width: 70%">
            <h4 class="modal-title">Dados do chamado</h4>
            <button
              type="button"
              class="btn-close"
              style="padding: 5px"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <form method="" @submit.prevent="">
              <div class="form-group-modal">
                <label>Título</label>
                <input
                  type="text"
                  id="subject"
                  v-model="ChamadoData.titulo_chamado"
                  disabled
                />
              </div>
              <div class="form-group-modal">
                <label>Descrição</label>
                <textarea
                  id="description"
                  rows="4"
                  v-model="ChamadoData.descricao_chamado"
                  disabled
                ></textarea>
              </div>
              <div class="form-group-modal">
                <label>Prioridade</label>
                <select v-model="ChamadoData.gravidade" disabled></select>
                <select v-model="ChamadoData.urgencia" disabled></select>
                <select v-model="ChamadoData.tendencia" disabled></select>
              </div>
              <br />
              <button type="submit" class="submit-button-modal">Editar</button>
              <button type="submit" class="submit-button-modal">
                Cancelar Chamado
              </button>
            </form>
          </div>
        </div>
      </div>
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
        descricao_chamado: "",
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
      const id_user = sessionStorage.getItem("id_user");
      axios
        .get(
          `http://localhost/projeto/helptek/php/api/functions/selectChamados.php?action=selectChamados&id_user=${id_user}`
        )
        .then((res) => {
          console.log("Server response:", res.data);
          this.Chamados = res.data.chamados;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    verChamado(id_chamado) {
      this.ChamadoData = id_chamado;
    },
  },
};
</script>
