import {Component} from '../common/component';
import {Modal} from './../common/modal';
import {Button} from './../common/button';
import {Login} from './login';
import {AddProduct} from './add-product';
import {AddCategory} from './add-category';
import {OrderCreateMarketplace} from './order-create-marketplace';
import {OrderCreateCourier} from './order-create-courier';
import {CreateOrder} from './create-order';
import {OrderList} from './order-list';
import {CreateNews} from './create-news';
import {Restock} from './restock';
import {CreateSupplier} from './create-supplier';
import {ListSupplier} from './list-supplier';
import {Retur} from './retur';
import {AdjustmentStock} from './adjustment-stock';

export class App extends Component{

    login : Login;
    
    addProduct : AddProduct;

    addCategory : AddCategory;

    orderCreateMarketplace : OrderCreateMarketplace;

    orderCreateCourier : OrderCreateCourier;

    createOrder : CreateOrder;

    orderList : OrderList;

    createNews : CreateNews;

    restock : Restock;

    createSupplier : CreateSupplier;

    listSupplier : ListSupplier;

    retur : Retur;

    adjustmentStock : AdjustmentStock;

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
        else if(this.root.getElementsByClassName('order-list').length !== 0) {
            this.orderList = new OrderList(document.getElementById("ol"));
        }
        else if(this.root.getElementsByClassName('create-news').length !== 0) {
            this.createNews = new CreateNews(document.getElementById("nc"));
        }
        else if(this.root.getElementsByClassName('restock').length !== 0) {
            this.restock = new Restock(document.getElementById("ir"));
        }
        else if(this.root.getElementsByClassName('create-supplier').length !== 0) {
            this.createSupplier = new CreateSupplier(document.getElementById("sc"));
        }
        else if(this.root.getElementsByClassName('list-supplier').length !== 0) {
            this.listSupplier = new ListSupplier(document.getElementById("sl"));
        }
        else if(this.root.getElementsByClassName('retur').length !== 0) {
            this.retur = new Retur(document.getElementById("ire"));
        }
        else if(this.root.getElementsByClassName('adj-stock').length !== 0) {
            this.adjustmentStock = new AdjustmentStock(document.getElementById("ias"));
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
