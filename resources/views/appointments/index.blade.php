<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Agendamento</title>
    
</head>

<body class="bg-blue-light font-inter">
    <main class="container mx-auto py-3.5 my-3.5">
        <header class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-700">Novo Agendamento</h1>
        </header>
        <section>
            <form id="appointment-form" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Título:</label>
                    <input type="text" id="title" name="title" required
                        class="border border-gray-300 p-2 w-full rounded">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descrição:</label>
                    <textarea id="description" name="description" class="border border-gray-300 p-2 w-full rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="start_time" class="block text-gray-700 font-bold mb-2">Início:</label>
                    <input type="datetime-local" id="start_time" name="start_time" required
                        class="border border-gray-300 p-2 w-full rounded">
                </div>
                <div class="mb-4">
                    <label for="end_time" class="block text-gray-700 font-bold mb-2">Fim:</label>
                    <input type="datetime-local" id="end_time" name="end_time" required
                        class="border border-gray-300 p-2 w-full rounded">
                </div>
                <div class="flex justify-between items-center">
                    <button type="submit"
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700">Salvar</button>
                    <a href="{{ route('appointments.pendents') }}"
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700">Meus Agendamentos</a>
                </div>
            </form>
        </section>
        <div id="success-message"
            class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center">
            Agendamento criado com sucesso!
        </div>
    </main>

    <script>
        document.getElementById('appointment-form').addEventListener('submit', async function(e) {
            e.preventDefault(); // Evita o recarregamento da página

            let formData = new FormData(this);

            try {
                const response = await axios.post('{{ route('appointments.store') }}', formData);
                console.log('Resposta:', response); // Log da resposta para depuração
                // Mostrar a mensagem de sucesso
                document.getElementById('success-message').classList.remove('hidden');

                // Limpar o formulário
                document.getElementById('appointment-form').reset();

                // Ocultar a mensagem de sucesso após alguns segundos
                setTimeout(() => {
                    document.getElementById('success-message').classList.add('hidden');
                }, 4000);
            } catch (error) {
                console.error('Erro ao criar agendamento:', error);
                if (error.response) {
                    console.error('Dados do erro:', error.response.data);
                    console.error('Status do erro:', error.response.status);
                    console.error('Cabeçalhos do erro:', error.response.headers);
                } else if (error.request) {
                    console.error('Nenhuma resposta recebida:', error.request);
                } else {
                    console.error('Erro ao configurar a solicitação:', error.message);
                }
            }
        });
    </script>
</body>

</html>
