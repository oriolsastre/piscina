var accioActivada = {pHmes: 0, pHmenys: 0, clor: 0, antialga: 0, fluoculant: 0, aspirar: 0, alcali: 0, aglutinant: 0};
const accioFunc = (id) => {
    document.getElementById('formAccio').style.display = '';
    if(accioActivada[id]==0){
        document.getElementById(`${id}Form`).style.display = '';
        document.getElementById(`${id}Valor`).value='1';
        document.getElementById(id).style.opacity='0.5';
        accioActivada[id]=1;
        if(accioActivada['pHmes']+accioActivada['pHmenys']==2){
            document.getElementById('avisPh').style.display = '';
            document.getElementById('enviarForm').style.display = 'none';
        }
    }else{
        document.getElementById(id+'Form').style.display = 'none';
        document.getElementById(id+'Valor').value='0';
        document.getElementById(id).style.opacity='1';
        accioActivada[id]=0;
        if(accioActivada['pHmes']+accioActivada['pHmenys']<2){
            document.getElementById('avisPh').style.display = 'none';
            document.getElementById('enviarForm').style.display = '';
        }
    }
}