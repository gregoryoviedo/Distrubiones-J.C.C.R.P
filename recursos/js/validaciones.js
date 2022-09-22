/*
    Codigo ASCII

    A - Z = 65 - 90
    a - z = 97 - 122

    ñ = 241
    Ñ = 209

    espacio = 32
    backspace = 08
    suprimir = 127

    0 - 9 = 48 - 57
*/


// Solo escribir letras
function letras(evt){

    var key = evt.keyCode || evt.which;

    if( (key>=65&&key<=90) || (key>=97&&key<=122) || (key==241) || (key==209) || (key==32) ){
        return true;
    }else{
        return false;
    }

}

// Solo escribir numeros
function numeros(evt){

    var key = evt.keyCode || evt.which;

    if( (key>=48&&key<=57)){
        return true;
    }else{
        return false;
    }

}


// Solo escribir numeros con decimales
function decimales(evt){

    var key = evt.keyCode || evt.which;

    if( (key>=48&&key<=57)||key==46){
        return true;
    }else{
        return false;
    }

}