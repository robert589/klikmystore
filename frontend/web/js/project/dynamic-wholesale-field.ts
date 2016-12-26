import {DynamicField} from '../common/dynamic-field';
import {WholesaleField} from './wholesale-field';

export class DynamicWholesaleField extends DynamicField{

    constructor(root: HTMLElement) {
        super(root);
        this.fields = [];
        this.fields.push(new WholesaleField(
                        <HTMLElement> this.baseElement.querySelector("*")));
        this.fields[0].setIndex(0);
    }
    
    decorate() {
        super.decorate();
        
    }
    
    /**
     * Don't forget to set index
     */
    addField() {
        let raw : HTMLElement = this.addElement();
        let field : WholesaleField = new WholesaleField(raw);
        field.setIndex(this.findMaxIndexInFields() + 1);
        this.fields.push(field);
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
