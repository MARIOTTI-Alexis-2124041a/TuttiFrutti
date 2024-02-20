import axios from 'axios';

console.log('search.js loaded')
document.querySelectorAll('.card-result').forEach(card => {
    card.addEventListener('click', (cardClicked) => {
        const resourceUrl = card.dataset.resource_url;
        axios.post(`/details`, {resourceUrl: resourceUrl})
            .then(response => {
                console.log(response);
            })
    })
});