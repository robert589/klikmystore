import {Field} from '../common/field';
import {SearchField} from '../common/search-field';
import {Button} from '../common/button';
import {System} from './../common/system';
import {ProductAdjustmentFieldItem,
        ProductAdjustmentFieldItemJson} from './product-adjustment-field-item';

export class ProductAdjustmentField extends Field{

    searchProduct : SearchField;

    addBtn : Button;

    list : HTMLElement;

    items : ProductAdjustmentFieldItem[];

    getValue() {
        let values : ProductAdjustmentFieldItemJson[] = [];
        for(let i = 0 ; i < this.items.length; i++) {
            if(this.items[i].getQuantity() !== 0) {
                values.push(this.items[i].getValue());
            }
        }
        if(!values || values.length === 0) {
            return null;
        }
        return values;
    }

    constructor(root: HTMLElement) {
        super(root);
        this.items = [];
    }

    validateAddClient() {
        let valid = true;
        this.searchProduct.hideError();
        
        if(System.isEmptyValue(this.searchProduct.getValue())) {
            valid = false;
        }

        for(let i = 0; i < this.items.length; i++) {
            if(<string>this.searchProduct.getValue() === this.items[i].getId()) {
                valid = false;
                this.searchProduct.showError("Product has ben added");
            }
        }
        return valid;
    }
    addNew() {
        if(!this.validateAddClient()) {
            return false;
        }
        this.addBtn.disable(true);
        let data = {};
        data['product_id'] = this.searchProduct.getValue();
        data  = System.addCsrf(data);
        $.ajax({
            url : System.getBaseUrl() + "/inventory/get-adjustment-item",
            method : "post",
            data : data,
            context: this,
            dataType: "json",
            success: function(data) {
                this.addBtn.disable(false);
                if(data.status) {
                    this.addToList(data.views);
                }
            },
            error : function(data) {
                this.addBtn.disable(false);
            }
        })
    }

    addToList(views : string) {
        this.getListElement().innerHTML += views;
        let wrapper : HTMLElement = document.createElement('div');
        wrapper.innerHTML= views;
        let rawElements : NodeListOf<Element> = wrapper.getElementsByClassName('paf-item');
        let item : ProductAdjustmentFieldItem =
                 new ProductAdjustmentFieldItem(<HTMLElement>rawElements.item(0));
        this.items.push(item);
    }
    
    decorate() {
        super.decorate();
        this.searchProduct = new SearchField(document.getElementById(this.id + "-product"));
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.addNew.bind(this));
    }

    getListElement() : HTMLElement {
        return <HTMLElement> this.root.getElementsByClassName('pa-field-list')[0];
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
