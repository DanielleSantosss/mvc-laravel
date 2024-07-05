<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Edição de Agendamento</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="bg-blue-light font-inter">
    <main class="container mx-auto py-3.5 my-3.5">
        <header class="my-5 text-center">
            <h1 class="text-4xl font-bold text-gray-700">Edição de Agendamento</h1>
        </header>
        <section>
            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md m-7">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Título:</label>
                    <input type="text" name="title" id="title" placeholder="Título" class="border border-gray-300 p-2 w-full rounded" value="{{ $appointment->title }}">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descrição:</label>
                    <textarea name="description" id="description" placeholder="Descrição" class="border border-gray-300 p-2 w-full rounded">{{ $appointment->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="start_time" class="block text-gray-700 font-bold mb-2">Início do agendamento:</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="border border-gray-300 p-2 w-full rounded" value="{{ $appointment->start_time }}">
                </div>

                <div class="mb-4">
                    <label for="end_time" class="block text-gray-700 font-bold mb-2">Fim do agendamento:</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="border border-gray-300 p-2 w-full rounded" value="{{ $appointment->end_time }}">
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700">Salvar Alterações</button>
                    <a href="{{ route('appointments.pendents') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700">Meus Agendamentos</a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
