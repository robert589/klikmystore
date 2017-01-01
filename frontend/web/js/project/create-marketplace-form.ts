import {Form} from '../common/form';
import {InputField} from './../common/input-field';

export class CreateMarketplaceForm extends Form{

    codeField  : InputField;

    nameField : InputField;
    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.reload();
        }.bind(this);
    }

    rules() {
        this.setRequiredField([this.codeField, this.nameField]);
        this.registerFields([this.codeField, this.nameField]);

    }
    
    decorate() {
        super.decorate();
        this.codeField = new InputField(document.getElementById(this.id + "-code-field"));
        this.nameField = new InputField(document.getElementById(this.id + "-name-field"));
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
