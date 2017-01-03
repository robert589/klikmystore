import {Field} from '../common/field';
import {SearchField} from '../common/search-field';
import {InputField} from '../common/input-field';
import {Button} from '../common/button';
import {System} from '../common/system';
import {ProductOrderFieldItem} from './product-order-field-item';
export class ProductOrderField extends Field{

    public static get NEW_PRODUCT_ADDED() {
        return "POF_NEW_PRODUCT_ADDED";
    }

    productSearchField : SearchField;

    quantityField : InputField;

    addBtn : Button;

    values : ProductOrderFieldItem;

    listEl : HTMLElement;

    products : ProductOrderFieldItem[];

    newProductAdded : CustomEvent;
    constructor(root: HTMLElement) {
        super(root);
        this.products = [];
    } 
    
    decorate() {
        super.decorate();
        this.quantityField = new InputField(document.getElementById(this.id + "-quantity"));
        this.productSearchField = new SearchField(document.getElementById(this.id + "-product"));
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.addProduct.bind(this));    
        this.listEl = <HTMLElement> this.root.getElementsByClassName('po-field-list')[0]; 
    }
    
    addProduct(e) {
        e.preventDefault();
        let valid : boolean = this.validateAdd();
        if(valid) {
            let data : Object = {};
            data['quantity'] = this.quantityField.getValue();
            data['product_id'] = this.productSearchField.getValue();
            data = System.addCsrf(data);
            this.addBtn.disable(true);
            $.ajax({
                url : System.getBaseUrl() + "/order/add-product-to-order",
                data: data,
                context: this,
                method : 'post',
                dataType : 'json',
                success : function(data) {
                    if(parseInt(data.status) === 1) {
                        this.addNewProductToElement(data.views);
                    }
                    this.addBtn.disable(false);
                },
                error : function(data) {
                    this.addBtn.disable(false);
                }
            });
        }
    }

    addNewProductToElement(views : string) {
        this.listEl.innerHTML += views;
        let wrapper : HTMLElement = document.createElement('div');
        wrapper.innerHTML= views;
        let rawElements : NodeListOf<Element> = wrapper.getElementsByClassName('pof-item');
        let item : ProductOrderFieldItem =
                 new ProductOrderFieldItem(<HTMLElement>rawElements.item(0));
        this.products.push(item);
        this.dispatchProductAddedEvent();
    }

    dispatchProductAddedEvent() {
        this.root.dispatchEvent(this.newProductAdded);
    }

    bindEvent() {
        super.bindEvent();
        this.newProductAdded = new CustomEvent(ProductOrderField.NEW_PRODUCT_ADDED);
    }
    detach() {
        super.detach();
    }
    
    getValue() {
        return this.values;
    }

    validateAdd() : boolean{
        this.productSearchField.hideError();
        this.quantityField.hideError();
        let valid : boolean = true;
        valid = this.checkExistence(<string>this.productSearchField.getValue()) && valid;
        valid = this.checkRange() && valid  ;
        return valid;
    }

    checkRange() : boolean {
        if(parseInt(<string>this.quantityField.getValue()) > 0) {
            return true;
        }
        this.productSearchField.showError("Quantity should be larger than 0");  
        return false;
    }
    checkExistence(id : string) : boolean {
        for(let i = 0 ; i < this.products.length; i++) {
            if(this.products[i].getId() == id) {
                this.productSearchField.showError("Product has been added");
                return false;
                
            }
        }
        return true;
    }

    unbindEvent() {
        // no event to unbind
    }
}

interface ProductOrderFieldItemJson {
    id : string;
    quantity : number;
}