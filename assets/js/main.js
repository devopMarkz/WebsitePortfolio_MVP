document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.getElementById('portfolioGallery');

    // Buscar portfólios salvos
    fetch('backend/get_portfolios.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(portfolio => {
                const item = document.createElement('div');
                item.className = 'portfolio-item';
                item.innerHTML = `
                    <img src="assets/img/${portfolio.image}" alt="${portfolio.name}" width="100%">
                    <h3>${portfolio.name}</h3>
                    <p>${portfolio.description}</p>
                `;
                gallery.appendChild(item);
            });
        })
        .catch(err => console.error('Erro ao carregar portfólios:', err));
});