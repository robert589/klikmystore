import {Form} from '../common/form';
import {System} from '../common/system';
import {OrderReturField} from './order-retur-field';
import {SearchField} from './../common/search-field';

export class ReturForm extends Form{

    orderId : SearchField;

    area : HTMLElement;

    orderReturField : OrderReturField;

    constructor(root: HTMLElement) {
        super(root);
    }

    rules() {
        this.setRequiredField([this.orderId]);
        this.registerFields([this.orderId]);
    }
    
    decorate() {
        super.decorate();
        this.orderId = new SearchField(document.getElementById(this.id + "-order"));  
        this.area = <HTMLElement> this.root.getElementsByClassName('retur-form-area')[0];  
    }
    
    bindEvent() {
        super.bindEvent();
        this.orderId.attachEvent(SearchField.GET_VALUE_EVENT, 
                this.retrieveOrderReturField.bind(this) );
    }

    retrieveOrderReturField() {
        let data = {};
        data['order_id'] = this.orderId.getValue();
        data = System.addCsrf(data);

        $.ajax({
            url : System.getBaseUrl() + "/inventory/get-order-retur-field",
            method : "post",
            dataType : "json",
            data: data,
            context: this,
            success: function(data) {
                if(parseInt(data.status) !== 1) {
                    return false;
                }
                this.updateArea(data.views);
            },
            error: function(data) {

            }    
        })
    }

    updateArea(views : string) {
        this.area.innerHTML = views;
        let wrapper : HTMLElement = document.createElement('div');
        wrapper.innerHTML= views;
        let rawElements : NodeListOf<Element> = wrapper.getElementsByClassName('or-field');
        this.orderReturField = 
                 new OrderReturField(<HTMLElement>rawElements.item(0));
        this.setRequiredField([this.orderReturField]);
        this.registerFields([this.orderReturField]);
    }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
