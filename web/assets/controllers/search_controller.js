import {Controller} from "@hotwired/stimulus";

export default class extends Controller {
    next() {
        const resourceUrl = this.element.dataset.resource_url;
        const jsonData = JSON.stringify({resourceUrl: resourceUrl});
        fetch('/details', {
            method: 'POST', headers: {
                'Content-Type': 'application/json'
            }, body: jsonData
        })
            .then(response => {
                response.json().then(data => {
                    let type = '';
                    if (resourceUrl.search('discogs.com/artists') !== -1 ) {
                        type = 'artist';
                    } else if (resourceUrl.search('discogs.com/releases') !== -1 || resourceUrl.search('discogs.com/masters')) {
                        type = 'release'
                    }
                    const modal = this.createModal(data, type);
                    document.body.append(modal);
                    const bootstrapModal = new bootstrap.Modal(modal);
                    bootstrapModal.show();
                });
            });
    }

    createModal(result, type) {
        const modal = document.createElement('div');
        modal.setAttribute('id', 'detailsModal');
        modal.setAttribute('class', 'modal fade');
        modal.setAttribute('tabindex', '-1');
        modal.setAttribute('aria-labelledby', 'detailsModalLabel');
        modal.setAttribute('aria-hidden', 'true');

        let images = [];
        result.images.forEach(image => {
            images.push(`
                <div class="carousel-item">
                    <img src="${image?.resource_url}" class="d-block w-100" alt="image of the song or artist">
                </div>
                `)
        })

        images[0] = images[0]?.replace('carousel-item', 'carousel-item active');

        const baseStartModalHTML = `
        <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <header class="modal-header position-relative">
                        <div id="modalCarousel" class="carousel slide w-100">
                            <div class="carousel-inner">` + images.join('') + `</div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#modalCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#modalCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </header>
                    <main class="modal-body d-flex">`;

        const baseEndModalHTML = `</main></div></div>`;
        let contentModalHTML = ``;


        if (type === 'artist') {
            contentModalHTML = `
                        <section class="d-flex flex-column w-100">
                            <h1 class="modal-title">${result.name}</h1>
                            <p class="text ms-1">
                                ${result.profile?.replace(/\r\n|\r|\n/g, '<br>')}
                            </p>
                            <h2>Sorties</h2>
                            <div class="d-flex flex-column">` + result.releases.map(release => `<span><i class="fas fa-compact-disc me-2"></i>${release.title} - ${release.year ?? ''}</span>`).join('') + `</div>
                        </section>
                        <aside class="d-flex flex-column">
                            <h2>Détails</h2>`
                            + (result.realname ? `<h3>Vrai nom</h3>
                            <span>${result.realname}</span>` : ``) + `
                            <h3>Liens</h3>`
                            + result.urls?.map(url => `<a href="${url}" target="_blank" class="link">${url}</a>`).join('') +
                            `
                        </aside>
            `;
        } else if (type === 'release') {
            contentModalHTML = `
            <section class="d-flex flex-column w-100">
                <h1 class="modal-title">${result.title} - ${result.artists.map(artist => artist.name).join(' & ')}</h1>
                <div class="d-flex flex-column">` + result.tracklist.map(track => `<span><i class="fas fa-music me-2"></i>${track.title} - <i></i>${track.duration}</span>`).join('') + `</div>
            </section>
            <aside class="d-flex flex-column">
                <h2>Détails</h2>
                <h3>Sortie</h3>
                <p>${result?.released_formatted ?? result?.year}</p>
                <h3>Genres</h3>
                <p>${result.genres.join(', ')}</p>
                <h3>Styles</h3>
                <p>${result.styles.join(', ')}</p>
            </aside>
            `
        }

        modal.innerHTML = baseStartModalHTML + contentModalHTML + baseEndModalHTML;

        return modal;
    }
}