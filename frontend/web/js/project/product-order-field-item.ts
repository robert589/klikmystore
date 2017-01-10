import {Component} from '../common/component';
import {String} from './../common/string';
import {Button} from './../common/button';
import {InputField} from './../common/input-field';
import {System} from './../common/system';

export class ProductOrderFieldItem extends Component{

    idElement : HTMLElement;

    nameElement : HTMLElement;

    quantityViewElement : HTMLElement;

    quantityEditElement : HTMLElement;

    qtyValueElement : HTMLElement;

    editQtyBtn : Button;

    newQtyField : InputField;

    
    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.idElement = <HTMLElement> this.root.getElementsByClassName('pof-item-id')[0];
        this.nameElement = <HTMLElement> this.root.getElementsByClassName('pof-item-name')[0];
        this.quantityViewElement = <HTMLElement>
                            document.getElementById(this.id + '-qty-view');
        this.quantityEditElement = <HTMLElement> 
                            document.getElementById(this.id + "-qty-edit");
        this.qtyValueElement = <HTMLElement> document.getElementById(this.id + "-qty-value");
        this.editQtyBtn = new Button(document.getElementById(this.id +"-editqty-btn"),
                                    this.switchToEditQty.bind(this));
        this.newQtyField = new InputField(document.getElementById(this.id + "-new-qty"));
    }
    
    switchToEditQty(e) {
        e.preventDefault();
        this.quantityEditElement.classList.remove('app-hide');
        this.quantityViewElement.classList.add('app-hide');
        
    }

    bindEvent() {
        super.bindEvent();
        this.newQtyField.attachEvent("keypress", function(e) {
            if(e.keyCode === 13) {
                e.preventDefault();
                this.submitNewQty();
            }
        }.bind(this));
    }

    submitNewQty() {
        let data : Object = {};
        data['product_id'] = this.getProductId();
        data['quantity'] = this.getQuantity();
        data = System.addCsrf(data);
        this.newQtyField.disable();
        $.ajax({
            url : System.getBaseUrl() + "/order/check-quantity",
            method : "post",
            data: data,
            dataType: "json",
            context: this,
            success: function(data) {
                if(data.status == 1) {
                    this.updateNewQuantity();
                } else {
                    this.newQtyField.showError("Stock is not enough");
                }
                this.newQtyField.enable();
            },
            error: function(data) {
                this.newQtyField.enable();
            }
        })
    }

    updateNewQuantity() {
        this.quantityEditElement.classList.add('app-hide');
        this.setQuantity(<number> this.newQtyField.getValue());
        this.quantityViewElement.classList.remove('app-hide');
    }

    detach() {
        super.detach();
    }
    
    getId() {
        return  String.trim(this.idElement.innerHTML);
    }

    unbindEvent() {
        // no event to unbind
    }

    getProductId() {
        return String.trim(this.idElement.innerHTML);
    }

    getQuantity() : number{
        return parseInt(String.trim(this.qtyValueElement.innerHTML));
    }

    getWeight() : number {
        return parseInt(this.root.getAttribute('data-weight'));
        
    }
    setQuantity(value : number) {
        this.qtyValueElement.innerHTML =  "" + value; 
    }

    getPrice() : number {
        return parseInt(this.root.getAttribute('data-price'));
    }

    getValue() : ProductOrderFieldItemJson {
        return {
            id: this.getId(),
            quantity : this.getQuantity()
        }
    }
}

export interface ProductOrderFieldItemJson {
    id : string;
    quantity : number;
}
