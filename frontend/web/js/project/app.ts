import {Component} from '../common/component';
import {Modal} from './../common/modal';
import {Button} from './../common/button';
import {Login} from './login';

export class App extends Component{

    login : Login;
    
    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        if(this.root.getElementsByClassName('login').length !== 0) {
            this.login = new Login(document.getElementById("lgn"));
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
