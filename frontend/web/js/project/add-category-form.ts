import {Form} from '../common/form';
import {InputField} from './../common/input-field';

export class AddCategoryForm extends Form{

    nameField : InputField;

    descField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.failCb = function(data) {
           
        }.bind(this);
        this.successCb = function(data) {
            window.location.reload();
        }.bind(this);
    }

    rules() {
        this.registerFields([this.nameField, this.descField]);
        this.setRequiredField([this.nameField]);
    }
    
    decorate() {
        super.decorate();
        this.nameField = new InputField(document.getElementById(this.id + "-name-field"));
        this.descField = new InputField(document.getElementById(this.id + "-description-field"));
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
