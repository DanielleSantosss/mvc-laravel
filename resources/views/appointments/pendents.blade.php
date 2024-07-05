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

<body class="bg-blue-light font-inter">
    <main class="container mx-auto py-3.5 my-3.5">
        <header class="my-5 text-center">
            <h1 class="text-4xl font-bold text-gray-700">Agendamentos Pendentes</h1>
        </header>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($appointments->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow-md text-center m-4">
                <p class="text-gray-700 text-xl">Não há agendamentos pendentes.</p>
            </div>
        @else
            <section class="flex justify-center mb-8 p-5 w-full">
                <div class="w-full">
                    <table class="min-w-full bg-white mx-auto w-full">
                        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-center">Título</th>
                                <th class="py-3 px-6 text-center">Descrição</th>
                                <th class="py-3 px-6 text-center">Início</th>
                                <th class="py-3 px-6 text-center">Fim</th>
                                <th class="py-3 px-6 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @foreach ($appointments as $appointment)
                                <tr class="border-b border-gray-200 hover:bg-gray-100" id="appointment-{{ $appointment->id }}">
                                    <td class="py-3 px-6 text-center">{{ $appointment->title }}</td>
                                    <td class="py-3 px-6 text-center">{{ $appointment->description }}</td>
                                    <td class="py-3 px-6 text-center">{{ $appointment->start_time }}</td>
                                    <td class="py-3 px-6 text-center">{{ $appointment->end_time }}</td>
                                    <td class="py-3 px-6 text-center flex justify-center space-x-2">
                                        <button onclick="deleteAppointment({{ $appointment->id }})" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700">Excluir</button>
                                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700">Atualizar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

        <div class="text-center mb-8">
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
                        document.getElementById(`appointment-${appointmentId}`).remove();
                        alert('Agendamento excluído com sucesso.');
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
