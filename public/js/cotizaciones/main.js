import {F} from '../global_functions.js';
import {Fichas} from './Fichas.js';
window.addEventListener('load',function(){

	F.onClick('.crear-ficha',Fichas.setAddButtons);
});