import {Component} from '../common/component';
import {InputField} from '../common/input-field';

export class ProductAdjustmentFieldItem extends Component{

    idElement : HTMLElement;

    adjustField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        
    }
    
    decorate() {
        super.decorate();
        this.idElement = <HTMLElement> document.getElementById(this.id + "-id");  
        this.adjustField = new InputField(document.getElementById(this.id + "-adjust"));  
    }

    getId() {
        return this.idElement.innerHTML;
    }

    getValue()  : ProductAdjustmentFieldItemJson{
        return {
            id: this.getId(),
            adjust: parseInt(<string>this.adjustField.getValue())
        }
    }

    getQuantity() : number {
        return parseInt(<string> this.adjustField.getValue());
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
    adjust : number
}