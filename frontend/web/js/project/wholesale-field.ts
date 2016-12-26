import {Field} from '../common/field';


export class WholesaleField extends Field{

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        
    }
    
    bindEvent() {
        super.bindEvent();
   }
    detach() {
        super.detach();
    }

    getValue() {
        return null;
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
