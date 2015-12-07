/**
 * Created by NetBeans.
 * User: Fabio
 * Date: 03/12/15
 */
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var Creazione = function(){
    
    var rand = document.getElementById('rand');
    var array= Array();
    if (rand.checked == 1){
        //CREAZIONE RANDOM
        var numAperte = document.getElementById('numAperte').value;
        var numMultiple = document.getElementById('numMultiple').value;
        
    }
    else{
        //PRELEVA DOMANDE DAL BOX TEST
        var lista = document.getElementById('lista');
        array=lista.getElementByTagName('li');
        for(i=0; i < array.length; i++){
            x = array[i].getAttribute('id');
            alert(x);
        }
 }    
}

