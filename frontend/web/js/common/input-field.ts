import {Field} from './Field';
import {System} from './../common/system';

export class InputField extends Field {

    public static get VALUE_CHANGED() {return "INPUT_FIELD_VALUE_CHANGED"};

    protected inputElement : HTMLInputElement;

    private dateFormat : string  = 'dd-mm-yy';

    private valueChangeEvent : CustomEvent;
    
    private type : string;
    constructor(root : HTMLElement) {
        super(root);
        this.type = this.inputElement.getAttribute("type");
            
    }

    decorate() {
        super.decorate();
        this.inputElement = <HTMLInputElement> 
                        this.root.getElementsByClassName('input-field-input')[0];
        if(!System.isEmptyValue(this.root.getAttribute('data-datepicker'))) {
            $("#" + this.id).find(".input-field-input")
                            .datepicker({dateFormat: "dd/mm/yy",
                                        onSelect: function(date) {
                                            this.triggerValueChangedEvent();
                                        }.bind(this)
                                    });
        } else if(!System.isEmptyValue(this.root.getAttribute('data-timepicker'))) {
            $("#" + this.id).find(".input-field-input")
                            .timepicker({
                                change: function(time) {
                                    this.triggerValueChangedEvent();
                                }.bind(this)
                            });
        }
    }

    bindEvent() {
        this.valueChangeEvent = new CustomEvent(InputField.VALUE_CHANGED);
    }

    triggerValueChangedEvent() {
        this.root.dispatchEvent(this.valueChangeEvent);
    }

    detach() {
        this.inputElement = null;
    }

    unbindEvent() {
        
    }

    getValue() : Object {
        if(this.type === "file" ) {
            return this.inputElement.files[0];
        }
        return this.inputElement.value;
    }

    setValue(val : string) {
        this.inputElement.value = val;
    }

    getDateFormat() {
        return this.dateFormat;
    }

    disable() {
        this.inputElement.setAttribute('disabled', "true");
    }
    enable() {
        this.inputElement.removeAttribute('disabled');
    }
}