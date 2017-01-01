import {Component} from '../common/component';
import {CreateMarketplaceForm} from './create-marketplace-form';

export class OrderCreateMarketplace extends Component{

    form : CreateMarketplaceForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateMarketplaceForm(document.getElementById(this.id + "form"));    
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
