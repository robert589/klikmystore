import {Field} from '../common/field';
import {InputField} from './../common/input-field';

export class OrderReturField extends Field{
    
    idFields : InputField[];

    effectFields : InputField[];

    returFields : InputField[];

    remarkFields : InputField[];

    total : number;

    quantityFields : InputField[];

    constructor(root: HTMLElement) {
        super(root);
    }
    
    validate( ) {
        let valid :boolean = true;
        for(let i = 0; i < this.total; i++) {
            this.returFields[i].hideError();
            this.effectFields[i].hideError();
            if(this.returFields[i].getValue() > 0) {
                if(parseInt(<string>this.quantityFields[i].getValue()) < 
                parseInt(<string>this.returFields[i].getValue())) {
                    this.returFields[i].showError("Jumlah barang rusak tidak dapat lebih besar dari inventory");
                    valid = valid && false;
                } 

                if(parseInt(<string>this.returFields[i].getValue()) <
                        parseInt( <string> this.effectFields[i].getValue())) {
                    this.effectFields[i].showError(
                        "Jumlah barang yang effect tidak dapat lebih besar dari retur");
                    valid = valid && false;
                }
            }
        }

        return valid;
    }
    getValue() {
        if(!this.validate()) {
            return null;
        }
        let values : OrderReturFieldItem[] = [];
        for(let i = 0; i < this.total; i++ ) {
            if(this.returFields[i].getValue() > 0) {
                let value : OrderReturFieldItem = {
                    id : <number> this.idFields[i].getValue(),
                    retur : <number>this.returFields[i].getValue(),
                    remark : <string>this.remarkFields[i].getValue(),
                    effect : <number>this.effectFields[i].getValue()

                };
                values.push(value)
            }
        }
        return values;
    }

    decorate() {
        super.decorate(); 
        this.total = parseInt(this.root.getAttribute('data-total'));
        this.effectFields  = [];
        this.remarkFields = [];
        this.idFields = [];
        this.quantityFields = [];
        this.returFields = [];
        for(let i = 0;  i  < this.total; i++) {
            this.effectFields.push(
                new InputField(document.getElementById(this.id + "-effect-" + i)));

            this.remarkFields.push(
                new InputField(document.getElementById(this.id + "-remark-" + i)));


            this.quantityFields.push(
                new InputField(document.getElementById(this.id + "-quantity-" + i)));

            this.returFields.push(
                new InputField(document.getElementById(this.id + "-retur-" + i)));

            this.idFields.push(
                new InputField(document.getElementById(this.id + "-id-" + i)));
                
        }
    }
    
    bindEvent() {
        super.bindEvent();
        for(let i = 0; i < this.returFields.length; i++) {
            this.returFields[i].attachEvent('input',
                 this.checkReturValue.bind(this,[i]));
        }
    }

    checkReturValue(i) {
        if(this.returFields[i].getValue() > 0) {
            this.enableRemarkEffectField(i);
        } else {
            this.disableRemarkEffectField(i);
        }
    }

    enableRemarkEffectField(i) {
        this.remarkFields[i].enable();
        this.effectFields[i].enable();
        this.effectFields[i].setMax(<number>(this.returFields[i].getValue()));
        this.remarkFields[i].setValue(null);
        this.effectFields[i].setValue(0 + "");    
    }

    disableRemarkEffectField(i) {
        this.remarkFields[i].disable();
        this.effectFields[i].disable();
        this.remarkFields[i].setValue(null);
        this.effectFields[i].setValue(0 + "");
    }   

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}

interface OrderReturFieldItem {
    id : number;
    retur : number;
    effect : number;
    remark: string;
}