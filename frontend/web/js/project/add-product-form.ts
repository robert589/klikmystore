import {Form} from '../common/form';
import {DynamicWholesaleField} from './dynamic-wholesale-field';
import {InputField} from './../common/input-field';

export class AddProductForm extends Form{
    
    imageField : InputField;
    
    wholeSaleField : DynamicWholesaleField;

    nameField : InputField;

    skuField : InputField;

    weightField : InputField;

    linkField : InputField;

    
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
