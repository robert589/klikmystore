import {Field} from './field';

export class DropdownField extends Field {

    upIcon : HTMLElement;

    downIcon : HTMLElement;

    dropdown : HTMLElement;

    textElement : HTMLElement;

    inputArea : HTMLElement;

    public decorate() {
        super.decorate();
        this.upIcon = <HTMLElement> this.root.getElementsByClassName('dropdown-field-down')[0];
        this.downIcon = <HTMLElement> this.root.getElementsByClassName('dropdown-field-up')[0];
        this.dropdown = <HTMLElement> this.root.getElementsByClassName('dropdown-field-dropdown')[0];
    }

    public bindEvent() {
        super.bindEvent();
        this.inputArea.addEventListener('click', this.toggleDropdown.bind(this));
    }

    public toggleDropdown() {
        if(this.dropdown.classList.contains('app-hide')) {
            this.dropdown.classList.remove('app-hide');
        } else {
            this.dropdown.classList.add('app-hide');
        }
    }

    public hideDropdown() {
        this.dropdown.classList.add('app-hide');
        
    }

    public showDropdown() {
        this.dropdown.classList.remove('app-hide');
    }
    public getValue() {
        return null;
    }


}