<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Agendamentos Pendentes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="bg-blue-light">
    <main class="container mx-auto p-4">
        <header class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-700">Agendamentos Pendentes</h1>
        </header>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <section class="flex justify-center mb-8">
            <div class="w-full max-w-4xl">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">Título</th>
                            <th class="py-3 px-6 text-left">Descrição</th>
                            <th class="py-3 px-6 text-left">Início</th>
                            <th class="py-3 px-6 text-left">Fim</th>
                            <th class="py-3 px-6 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @foreach ($appointments as $appointment)
                            <tr class="border-b border-gray-200 hover:bg-gray-100" id="appointment-{{ $appointment->id }}">
                                <td class="py-3 px-6 text-left">{{ $appointment->title }}</td>
                                <td class="py-3 px-6 text-left">{{ $appointment->description }}</td>
                                <td class="py-3 px-6 text-left">{{ $appointment->start_time }}</td>
                                <td class="py-3 px-6 text-left">{{ $appointment->end_time }}</td>
                                <td class="py-3 px-6 text-left">
                                    <button onclick="deleteAppointment({{ $appointment->id }})" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700">Excluir</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="text-center">
            <a href="{{ route('appointments.create') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700">Novo Agendamento</a>
        </div>
    </main>

    <script>
        async function deleteAppointment(appointmentId) {
            if (confirm('Tem certeza que deseja excluir este agendamento?')) {
                try {
                    const response = await axios.delete(`{{ url('/appointments') }}/${appointmentId}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });

                    if (response.status === 200) {
                        // Remover a linha da tabela correspondente ao agendamento excluído
                        document.getElementById(`appointment-${appointmentId}`).remove();
                    } else {
                        alert('Ocorreu um erro ao tentar excluir o agendamento.');
                    }
                } catch (error) {
                    console.error('Erro ao excluir agendamento:', error);
                    alert('Ocorreu um erro ao tentar excluir o agendamento.');
                }
            }
        }
    </script>
</body>

</html>
