import {Component} from '../common/component';
import {AddResellerForm} from './add-reseller-form';

export class AddReseller extends Component{

    form : AddResellerForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddResellerForm(document.getElementById(this.id + "-form"));    
    }
    
    bindEvent() {
        super.bindEvent();
   }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
