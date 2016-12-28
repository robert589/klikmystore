import {Component} from '../common/component';
import {AddCategoryForm} from './add-category-form';

export class AddCategory extends Component{

    addCategoryForm : AddCategoryForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addCategoryForm = new AddCategoryForm(document.getElementById(this.id + "form"));    
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
