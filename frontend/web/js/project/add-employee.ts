import {Component} from '../common/component';
import {AddEmployeeForm} from './add-employee-form';

export class AddEmployee extends Component{

    form : AddEmployeeForm;
    
    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AddEmployeeForm(document.getElementById(this.id + "-form"));    
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
