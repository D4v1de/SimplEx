/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var SetContent = function(){
    
    var scelte = document.getElementById('scelte_random');
    var rand = document.getElementById('rand');
     var dom = document.getElementById('domande');
    if (rand.checked == 1){
        scelte.style.visibility= "visible";
        dom.style.visibility= "hidden";
    }
    else{
        scelte.style.visibility= "hidden";
        dom.style.visibility= "visible";
    }
}