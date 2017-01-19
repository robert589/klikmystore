import {Component} from '../common/component';
import {ReturForm} from './retur-form';

export class Retur extends Component{

    form : ReturForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new ReturForm(document.getElementById(this.id + "-form"));    
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
