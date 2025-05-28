<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scegli un Pacchetto - BookAI</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
  <header class="flex justify-between items-center p-6 bg-white shadow">
    <h1 class="text-xl font-bold text-gray-800">BookAI</h1>
    <a href="/" class="text-blue-600 hover:underline">Torna alla Home</a>
  </header>

  <main class="max-w-5xl mx-auto py-16 px-4">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Scegli il tuo pacchetto</h2>
    <div id="package-container" class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Pacchetti -->
      <div class="package bg-white shadow-md rounded-lg p-6 text-center cursor-pointer transition border-2 border-transparent">
        <h3 class="text-xl font-semibold mb-4">Pacchetto Base</h3>
        <p class="text-gray-600 mb-4">1 libro, copertina semplice</p>
        <p class="text-2xl font-bold mb-4">€9,99</p>
        <!-- <span class="inline-block px-6 py-2 bg-blue-600 text-white rounded">Crea</span> -->
        <button disabled class="create-btn inline-block px-6 py-2 bg-blue-600 text-white rounded opacity-50 cursor-not-allowed">
  Crea
</button>
      </div>
      <div class="package bg-white shadow-md rounded-lg p-6 text-center cursor-pointer transition border-2 border-transparent">
        <h3 class="text-xl font-semibold mb-4">Pacchetto Plus</h3>
        <p class="text-gray-600 mb-4">3 libri, copertine HD</p>
        <p class="text-2xl font-bold mb-4">€24,99</p>
        <!-- <span class="inline-block px-6 py-2 bg-blue-600 text-white rounded">Crea</span> -->
        <button disabled class="create-btn inline-block px-6 py-2 bg-blue-600 text-white rounded opacity-50 cursor-not-allowed">
  Crea
</button>
      </div>
      <div class="package bg-white shadow-md rounded-lg p-6 text-center cursor-pointer transition border-2 border-transparent">
        <h3 class="text-xl font-semibold mb-4">Pacchetto Premium</h3>
        <p class="text-gray-600 mb-4">10 libri, AI avanzata + copertine HD</p>
        <p class="text-2xl font-bold mb-4">€59,99</p>
        <!-- <span class="inline-block px-6 py-2 bg-blue-600 text-white rounded">Crea</span> -->
        <button disabled class="create-btn inline-block px-6 py-2 bg-blue-600 text-white rounded opacity-50 cursor-not-allowed">
  Crea
</button>
      </div>
    </div>
  </main>

  <footer class="text-center py-6 text-gray-500 text-sm">
    &copy; 2025 Vibe srl. Tutti i diritti riservati.
  </footer>

  <!-- <script>
    const packages = document.querySelectorAll('.package');

    packages.forEach((pkg, idx) => {
      pkg.addEventListener('click', () => {
        packages.forEach(p => p.classList.remove('border-blue-600', 'ring', 'ring-blue-300'));
        pkg.classList.add('border-blue-600', 'ring', 'ring-blue-300');
        console.log("Pacchetto selezionato:", idx); // Qui potresti salvare la selezione in un form o localStorage
      });
    });
  </script> -->

  <script>
   const packages = document.querySelectorAll('.package');

packages.forEach(pkg => {
  const createBtn = pkg.querySelector('button.create-btn');

  // All'inizio tutti i bottoni disabilitati
  createBtn.disabled = true;
  createBtn.classList.add('opacity-50', 'cursor-not-allowed');

  // Clic sul pacchetto
  pkg.addEventListener('click', () => {
    // Rimuove selezione da tutti
    packages.forEach(p => {
      p.classList.remove('border-blue-600', 'ring', 'ring-blue-300');
      const btn = p.querySelector('button.create-btn');
      btn.disabled = true;
      btn.classList.add('opacity-50', 'cursor-not-allowed');
    });

    // Aggiunge selezione a questo
    pkg.classList.add('border-blue-600', 'ring', 'ring-blue-300');

    // Abilita il pulsante "Crea" di questo pacchetto
    createBtn.disabled = false;
    createBtn.classList.remove('opacity-50', 'cursor-not-allowed');
  });

  // Click sul pulsante crea
  createBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // Previene il click sul pacchetto
    if (!createBtn.disabled) {
      // Estrae il nome pacchetto e reindirizza
      const packageName = pkg.querySelector('h3').textContent.trim().toLowerCase().replace('pacchetto ', '');
      // window.location.href = `/crea-libro.html?pack=${packageName}`;
      window.location.href = `/crea-libro?pack=${packageName}`;

    }
  });
});

</script>

</body>
</html>
