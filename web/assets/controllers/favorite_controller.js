import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        // This function is called when the controller is connected to the DOM

    }

    // Define other event listener methods like click, submit, etc.
    addToFavorite() {
        let button = document.getElementById(this.element.dataset.id + "_button");
        let starIcon  = button.getElementsByTagName("i")[0]
        starIcon.classList.add("fa-solid");
        starIcon.classList.remove("fa-regular");

        button.setAttribute("data-action", "click->favorite#removeFromFavorite")

        const ajaxData = this.parseDom();

    // Fetch the controller action URL
        const url = this.element.dataset.addfavoriteroute;

        fetch(url, {
            method: 'POST', // Use POST for adding data
            headers: {
                'Content-Type': 'application/json', // Set content type for JSON data
            },
            body: JSON.stringify(ajaxData), // Send data as JSON
        })
            .then(response => {
                // Check for successful response
                if (!response.ok) {
                    console.error('Error:', response.status);
                    return; // Handle errors appropriately
                }

                // Process the JSON response
                return response.json();
            })
            .then(data => {
                console.log("success");
                console.log(data);
                // Update the DOM based on the response (e.g., using Turbo Streams)
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle errors gracefully
            });
    }

    removeFromFavorite() {
        let button = document.getElementById(this.element.dataset.id + "_button");
        let starIcon  = button.getElementsByTagName("i")[0]
        starIcon.classList.add("fa-regular");
        starIcon.classList.remove("fa-solid");

        button.setAttribute("data-action", "click->favorite#addToFavorite")

        const url = this.element.dataset.removefavoriteroute;
        const ajaxData = this.parseDom();

        fetch(url, {
            method: 'POST', // Use POST for adding data
            headers: {
                'Content-Type': 'application/json', // Set content type for JSON data
            },
            body: JSON.stringify(ajaxData), // Send data as JSON
        })
            .then(response => {
                // Check for successful response
                if (!response.ok) {
                    console.error('Error:', response.status);
                    return; // Handle errors appropriately
                }

                // Process the JSON response
                return response.json();
            })
            .then(data => {
                console.log("success");
                console.log(data);
                // Update the DOM based on the response (e.g., using Turbo Streams)
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle errors gracefully
            });
    }

    parseDom() {
        let article = document.getElementById(this.element.dataset.id);
        let imageUrl = article.getElementsByTagName("img")?.[0]?.src;
        let name = article.getElementsByTagName("h3")?.[0]?.innerText;
        let type = article.getElementsByTagName("h4")?.[0]?.innerText;
        let country = article.getElementsByClassName("country")?.[0]?.innerText;
        let year = article.getElementsByClassName("year")?.[0]?.innerText;
        let format = article.getElementsByClassName("format")?.[0]?.innerText;
        let genre = article.getElementsByClassName("genre")?.[0]?.innerText;
        let label = article.getElementsByClassName("label")?.[0]?.innerText;
        let url = article.getElementsByTagName("a")?.[0]?.href;
        let ressourceUrl = article.getElementsByClassName("card-img-top")?.[0].getAttribute("data-resource_url");

        return {
            imageUrl: imageUrl,
            name: name,
            type: type,
            country: country,
            year: year,
            format: format,
            genre: genre,
            label: label,
            url: url,
            ressourceUrl : ressourceUrl
        };

    }
}
