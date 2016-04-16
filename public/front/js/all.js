function _mascara(formato, evento, obj) {
    campo = eval(obj);
    
    if (formato == 'email') permitido = 'abcdefghijklmnopqrstuvwyxz1234567890_.@-';
    else if (formato == 'telefone') permitido = '1234567890';
    else if ( formato == 'data') permitido = '1234567890';
    else return false;

    key = window.event ? evento.keyCode : evento.which;
    ok = 0;
    for (i = 0; i < permitido.length; i++) {
        if (key == permitido.charCodeAt(i)) {
            ok = 1;
            break;
        }
    }
    if ((key == 8) || (key == 0))
        return true; // backspace and delete key
    if (ok == 0) {
        if (navigator.appVersion.indexOf("MSIE") != -1)
            evento.returnValue = false;
        else
            evento.preventDefault( );
    }
    if ((formato == 'telefone') && (ok == 1)) {
        if ((obj.value.length == 0) && (key != permitido.charCodeAt(10)))
            obj.value = '(' + obj.value;
        if ((obj.value.length == 3) && (key != permitido.charCodeAt(11)))
            obj.value = obj.value + ')';
        var regex_anatel = /^.([0-9]{2}).9/;
        if ((obj.value.length == 8) && (key != permitido.charCodeAt(11)) && (!regex_anatel.test(obj.value)))
        {
            obj.value = obj.value + '-';
            obj.maxLength = 13;
        } else if ((obj.value.length == 9) && (key != permitido.charCodeAt(11)) && (regex_anatel.test(obj.value)))
        {
            obj.value = obj.value + '-';
            obj.maxLength = 14;
        }
    }
    if ( ( formato == 'data') && ( ok == 1)){
            obj.maxLength=10;
            if ( obj.value.length == 2 || obj.value.length == 5){
                    obj.value = obj.value + "/";
            }
    }
}

function dateDiferencaEmDias(a, b) {
   var utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
   var utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

   return Math.floor((utc2 - utc1) / ( 1000 * 60 * 60 * 24) );
}
