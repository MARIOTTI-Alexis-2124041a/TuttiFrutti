import { Controller } from '@hotwired/stimulus';
import SlimSelect from 'slim-select'

export default class extends Controller {
    connect() {
        console.log("Hello, Stimulus!", this.element)
    }
}
