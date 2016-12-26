import {Component} from '../common/component';
import {Modal} from './../common/modal';
import {Button} from './../common/button';
import {Login} from './login';
import {AddProduct} from './add-product';

export class App extends Component{

    login : Login;
    
    addProduct : AddProduct;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        if(this.root.getElementsByClassName('login').length !== 0) {
            this.login = new Login(document.getElementById("lgn"));
        } else if(this.root.getElementsByClassName('add-product').length !== 0) {
            this.addProduct = new AddProduct(document.getElementById('ap'));
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
