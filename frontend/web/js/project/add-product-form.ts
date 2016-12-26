import {Form} from '../common/form';
import {DynamicWholesaleField} from './dynamic-wholesale-field';

export class AddProductForm extends Form{

    wholeSaleField : DynamicWholesaleField;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.wholeSaleField = 
            new DynamicWholesaleField(document.getElementById(this.id + "-dynamic-wholesale"));
    }
    
    bindEvent() {
        super.bindEvent();
    }

    rules() {

    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
