var description = document.getElementById('description');
var comment = document.getElementById('comment');
var btn = document.getElementById('btn');
var trai = document.getElementById('trai');
var phai = document.getElementById('phai');


function leftClick() {
    btn.style.left = '430px';
    description.style.display = "block";
    comment.style.display = "none";
    btn.style.width = "115px";
    trai.style.color = "white";
    phai.style.color = "red";
}

function rightClick() {
    btn.style.left = '561px';
    comment.style.display = "block";
    description.style.display = "none";
    btn.style.width = "175px";
    phai.style.color = "white";
    trai.style.color = "red";

}