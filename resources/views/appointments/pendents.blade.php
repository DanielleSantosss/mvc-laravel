<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos Pendentes</title>
</head>
<body>
    <h1>Agendamentos Pendentes</h1>

    @if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('appointments.create') }}">Novo Agendamento</a>
    <table border="1">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->title }}</td>
                    <td>{{ $appointment->description }}</td>
                    <td>{{ $appointment->start_time }}</td>
                    <td>{{ $appointment->end_time }}</td>
                    <td>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
