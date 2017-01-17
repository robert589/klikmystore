import {Form} from '../common/form';
import {RedactorField} from './../common/redactor-field';
import {System} from './../common/system';

export class CreateNewsForm extends Form{

    redactor : RedactorField;

    rules() {
        this.registerFields([this.redactor]);
        this.setRequiredField([this.redactor]);
    }
    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/dashboard/index";
        }
    }
    
    decorate() {
        super.decorate();
        this.redactor = new RedactorField(document.getElementById(this.id + "-input"));
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
