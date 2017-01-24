import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class CategoryList extends Component{

    addCategory : Button;

    constructor(root: HTMLElement) {
        super(root);
    }

    redirectToAddCat() {
        window.location.href = System.getBaseUrl() + "/product/add-category";
    }
    
    decorate() {
        super.decorate();
        this.addCategory = new Button(document.getElementById(this.id + "-add"), 
                            this.redirectToAddCat.bind(this));
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
