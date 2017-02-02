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
import {RestockList} from './restock-list';
import {MarketplaceList} from './marketplace-list';
import {AdjustmentList} from './adjustment-list';
import {CourierList} from './courier-list';
import {CategoryList} from './category-list';
import {ProductList} from './product-list';
import {EmployeeList} from './employee-list';
import {ListReseller} from './list-reseller';
import {AddEmployee} from './add-employee';
import {AddReseller} from './add-reseller';
import {AcIndex} from './ac-index';
import {AcRole} from './ac-role';

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

    restockList : RestockList;

    adjustmentList : AdjustmentList;

    marketplaceList : MarketplaceList;

    courierList : CourierList;

    categoryList : CategoryList;

    productList : ProductList;

    employeeList : EmployeeList;

    addEmployee : AddEmployee;

    addReseller : AddReseller;

    listReseller : ListReseller;

    acIndex : AcIndex;

    acRole : AcRole;

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
        else if(this.root.getElementsByClassName('restock-list').length !== 0) {
            this.restockList = new RestockList(document.getElementById("irl"));
        }
        else if(this.root.getElementsByClassName('adj-list').length !== 0) {
            this.adjustmentList = new AdjustmentList(document.getElementById("ial"));
        }
        else if(this.root.getElementsByClassName('mp-list').length !== 0) {
            this.marketplaceList = new MarketplaceList(document.getElementById("oml"));
        }
        else if(this.root.getElementsByClassName('courier-list').length !== 0) {
            this.courierList = new CourierList(document.getElementById("ocl"));
        }
        else if(this.root.getElementsByClassName('cat-list').length !== 0) {
            this.categoryList = new CategoryList(document.getElementById("pcl"));
        }
        else if(this.root.getElementsByClassName('product-list').length !== 0) {
            this.productList = new ProductList(document.getElementById("pl"));
        }
        else if(this.root.getElementsByClassName('add-emp').length !== 0) {
            this.addEmployee = new AddEmployee(document.getElementById("eae"));
        }
        else if(this.root.getElementsByClassName('add-res').length !== 0) {
            this.addReseller = new AddReseller(document.getElementById("rar"));
        }
        else if(this.root.getElementsByClassName('emp-list').length !== 0) {
            this.employeeList = new EmployeeList(document.getElementById("ele"));
        }
        else if(this.root.getElementsByClassName('res-list').length !== 0) {
            this.listReseller = new ListReseller(document.getElementById("rlr"));
        }
        else if(this.root.getElementsByClassName('ac-index').length !== 0) {
            this.acIndex = new AcIndex(document.getElementById("aci"));
        }
        else if(this.root.getElementsByClassName('ac-role').length !== 0) {
            this.acRole = new AcRole(document.getElementById("acr"));
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
