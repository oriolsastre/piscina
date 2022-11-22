function formulariControls(formulari, pHClor, Aigua){
    if(formulari){document.getElementById('formControl').style.display = '';}else{document.getElementById('formControl').style.display = 'none';}
    
    if(pHClor){
        document.getElementById('formpH').style.display = '';
        document.getElementById('formClor').style.display = '';
    }else{
        document.getElementById('formpH').style.display = 'none';
        document.getElementById('formClor').style.display = 'none';
    }
    

    if(Aigua){
        document.getElementById('formTemp').style.display = '';
        document.getElementById('formTrans').style.display = '';
        document.getElementById('formFons').style.display = '';
    }else{
        document.getElementById('formTemp').style.display = 'none';
        document.getElementById('formTrans').style.display = 'none';
        document.getElementById('formFons').style.display = 'none';
    }
}

function activarFila(id){
    var fila = document.getElementById(id);
    fila.style.display = (fila.style.display == 'none') ? '' : 'none';
}