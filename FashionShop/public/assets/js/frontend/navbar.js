document.getElementById("btn1").onclick = function() {
    document.getElementById("header").style.display = 'none';
    document.getElementById("search").style.display = 'block';
};

document.getElementById("btn2").onclick = function() {
    document.getElementById("search").style.display = 'none';
    document.getElementById("header").style.display = 'block';
};
