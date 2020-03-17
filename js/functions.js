//Search bar
function myFunction() {
    var input, filter, tr, td, a, i;
    input = document.getElementById("mySearch");
    filter = input.value.toUpperCase();
    tr = document.getElementById("myMenu");
    td = tr.getElementsByTagName("td");
    for (i = 0; i < td.length; i++) {
        a = td[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            td[i].style.display = "";
        } else {
            td[i].style.display = "none";
        }
    }
}

