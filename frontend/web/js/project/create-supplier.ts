import {Component} from '../common/component';
import {CreateSupplierForm} from './create-supplier-form';


export class CreateSupplier extends Component{

    form : CreateSupplierForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateSupplierForm(document.getElementById(this.id + "-form"));    
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
