
import { Controller} from 'stimulus';
import { Slideover } from 'tailwindcss-stimulus-components';


export default class SlideoverController extends Controller {
    connect() {
        this.slideover = new Slideover(this.element);
    }

    toggle() {
        this.slideover.toggle();
    }
}

