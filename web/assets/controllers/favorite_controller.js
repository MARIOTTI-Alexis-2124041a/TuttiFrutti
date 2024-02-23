import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        // This function is called when the controller is connected to the DOM

    }

    // Define other event listener methods like click, submit, etc.
    addToFavorite() {
        console.log("call");
        console.log(this.element.dataset.id);
        console.log(this.element.id);
        let button = document.getElementById(this.element.dataset.id + "_button");
        let starIcon  = button.getElementsByTagName("i")[0]
        starIcon.classList.add("fa-solid");
        starIcon.classList.remove("fa-regular");

        button.setAttribute("data-action", "click->favorite#removeFromFavorite")


    }

    removeFromFavorite() {
        let button = document.getElementById(this.element.dataset.id + "_button");
        let starIcon  = button.getElementsByTagName("i")[0]
        starIcon.classList.add("fa-regular");
        starIcon.classList.remove("fa-solid");

        button.setAttribute("data-action", "click->favorite#addToFavorite")
    }
}
