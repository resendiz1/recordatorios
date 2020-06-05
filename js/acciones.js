
e = document.getElementById("titulo");
if(e==null){
console.log("hoy tampoco, gracias");
}
else{

document.getElementById("titulo").onkeyup=function(e){
    var a = document.getElementById("titulo").value;
    console.log(a);
    document.getElementById("titulop").innerHTML=a;

}
document.getElementById("descripcion").onkeyup=function(e){
var a = document.getElementById("descripcion").value;
    console.log(a);
document.getElementById("descripcionp").innerHTML=a;
}

document.getElementById("enlace").onkeyup=function(e){
    var a = document.getElementById("enlace").value;
    console.log(a);
    document.getElementById("enlacep").innerHTML=a;
}






}




a= document.getElementById("file");
if(a==null){
console.log("hoy  no gracias");
}
else{

document.getElementById("file").onchange=function(e){
    let reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload = function(){
        let preview = document.getElementById("preview"),
            image = document.createElement('img');
            image.src= reader.result;
            image.className="size card-img-top";
            preview.innerHTML="";
            preview.append(image);
            console.log(image.id);
    }
}
}

