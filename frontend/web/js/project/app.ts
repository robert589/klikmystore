import {Component} from '../common/component';
import {Modal} from './../common/modal';
import {Button} from './../common/button';
import {Login} from './login';
import {AddProduct} from './add-product';
import {AddCategory} from './add-category';
import {OrderCreateMarketplace} from './order-create-marketplace';
import {OrderCreateCourier} from './order-create-courier';
import {CreateOrder} from './create-order';

export class App extends Component{

    login : Login;
    
    addProduct : AddProduct;

    addCategory : AddCategory;

    orderCreateMarketplace : OrderCreateMarketplace;

    orderCreateCourier : OrderCreateCourier;

    createOrder : CreateOrder;
    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        if(this.root.getElementsByClassName('login').length !== 0) {
            this.login = new Login(document.getElementById("lgn"));
        } 
        else if(this.root.getElementsByClassName('add-product').length !== 0) {
            this.addProduct = new AddProduct(document.getElementById('ap'));
        }
        else if(this.root.getElementsByClassName('add-category').length !== 0) {
            this.addCategory = new AddCategory(document.getElementById('pac'));
        }
        else if(this.root.getElementsByClassName('order-cm').length !== 0) {
            this.orderCreateMarketplace = new OrderCreateMarketplace(document.getElementById("ocm"));
        }
        else if(this.root.getElementsByClassName('order-cc').length !== 0) {
            this.orderCreateCourier = new OrderCreateCourier(document.getElementById("occ"));
        }
        else if(this.root.getElementsByClassName('create-order').length !== 0) {
            this.createOrder = new CreateOrder(document.getElementById("oc"));
        }
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
