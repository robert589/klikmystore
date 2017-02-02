import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';

export class CreateRoleForm extends Form{

    title : InputField;

    description : InputField;

    rules() {
        this.registerFields([this.title, this.description]);
        this.setRequiredField([this.title]);
    }

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.reload();
        }
    }
    
    decorate() {
        super.decorate();
        this.title = new InputField(document.getElementById(this.id + "-title"));
        this.description = new InputField(document.getElementById(this.id + "-desc"));
        
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
