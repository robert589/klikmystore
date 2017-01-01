import {Component} from '../common/component';
import {CreateCourierForm} from './create-courier-form';

export class OrderCreateCourier extends Component{

    form : CreateCourierForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateCourierForm(document.getElementById(this.id + "form"));    
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
