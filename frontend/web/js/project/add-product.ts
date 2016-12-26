import {Component} from '../common/component';
import {AddProductForm} from './add-product-form';


export class AddProduct extends Component{

    form : AddProductForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddProductForm(document.getElementById(this.id + "form"));
        
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
