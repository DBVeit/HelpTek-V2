<template>
  <div class="ticket-form-container">
    <h1>Criar novo chamado</h1>
    <form id="ticket-form">
      <div class="form-group">
        <label for="subject">Assunto</label>
        <input type="text" id="subject" name="subject" required />
      </div>
      <div class="form-group">
        <label for="description">Descrição</label>
        <textarea
          id="description"
          name="description"
          rows="4"
          required
        ></textarea>
      </div>
      <div class="form-group">
        <label for="start-date">Data de Início</label>
        <input type="date" id="start-date" name="start-date" required />
      </div>
      <div class="form-group">
        <label for="priority">Prioridade</label>
        <select id="priority" name="priority">
          <option value="baixa">Baixa</option>
          <option value="media">Média</option>
          <option value="alta">Alta</option>
        </select>
      </div>
      <div class="form-group">
        <label for="attachment">Anexo</label>
        <input type="file" id="attachment" name="attachment" />
      </div>
      <button type="submit" class="submit-button">Criar chamado</button>
    </form>
  </div>
</template>
<script setup></script>
