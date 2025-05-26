<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookAI - Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<header class="flex justify-between items-center p-6 bg-white shadow">
    <h1 class="text-xl font-bold text-gray-800">BookAI</h1>
    <div>

        <a href="{{ route('loginnn') }}" class="mr-4 text-blue-600 hover:underline">Login</a>
        <a href="{{ route('registerrr') }}" class="text-blue-600 hover:underline">Registrati</a>
    </div>
</header>
<main class="text-center py-20 px-4">
    <h2 class="text-4xl font-bold text-gray-800">Crea il tuo libro AI in pochi minuti</h2>
    <p class="mt-4 text-lg text-gray-600">Scegli un pacchetto per iniziare subito</p>
	<a href="{{ route('sell') }}" class="mt-8 inline-block px-8 py-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">Scopri i pacchetti</a>
    
</main>
<footer class="text-center py-4 text-gray-500 text-sm">
    &copy; 2025 Dolmen Technologies. Tutti i diritti riservati.
</footer>
</body>
</html>