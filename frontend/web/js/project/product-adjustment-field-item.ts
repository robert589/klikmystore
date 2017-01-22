import {Component} from '../common/component';
import {InputField} from '../common/input-field';

export class ProductAdjustmentFieldItem extends Component{

    idElement : HTMLElement;

    quantityField : InputField;
    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.idElement = <HTMLElement> document.getElementById(this.id + "-id");  
        this.quantityField = new InputField(document.getElementById(this.id + "-quantity"));  
    }

    getId() {
        return this.idElement.innerHTML;
    }

    getValue()  : ProductAdjustmentFieldItemJson{
        return {
            id: this.getId(),
            quantity: parseInt(<string>this.quantityField.getValue());
        }
    }

    getQuantity() : number {
        return parseInt(<string> this.quantityField.getValue());
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

export interface ProductAdjustmentFieldItemJson {
    id: string,
    quantity : number
}