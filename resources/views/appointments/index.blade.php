<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendamento</title>
</head>
<body>
    <h1>Novo Agendamento</h1>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="description">Descrição:</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <label for="start_time">Início:</label>
        <input type="datetime-local" id="start_time" name="start_time" required>
        <br>
        <label for="end_time">Fim:</label>
        <input type="datetime-local" id="end_time" name="end_time" required>
        <br>
        <button type="submit">Salvar</button>
        <a href="{{ route('appointments.pendents') }}">
            <button type="button">Meus Agendamentos</button>
        </a>
    </form>
</body>
</html>
