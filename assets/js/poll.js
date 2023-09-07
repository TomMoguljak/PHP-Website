document.getElementById("add").onclick = function () {

    let start = document.createElement("h4");
    start.innerHTML = "Date Start";

    let datestart = document.createElement("input");
    datestart.setAttribute("type", "datetime-local");
    datestart.setAttribute("name", "datestart[]");
    datestart.setAttribute("value", "");
    datestart.setAttribute("required", "");

    let end = document.createElement("h4");
    end.innerHTML = "Date End";

    let dateend = document.createElement("input");
    dateend.setAttribute("type", "datetime-local");
    dateend.setAttribute("name", "dateend[]");
    dateend.setAttribute("value", "");
    dateend.setAttribute("required", "");

    let remove = document.createElement("input");
    remove.setAttribute("class", "button");
    remove.setAttribute("type", "button");
    remove.setAttribute("value", "Remove Date");
    remove.setAttribute("onclick", "remove(event)");


    let div = document.createElement("div");
    div.appendChild(start);
    div.appendChild(datestart);
    div.appendChild(end);
    div.appendChild(dateend);
    div.appendChild(remove);

    document.getElementsByClassName("options")[0].appendChild(div);
};

function remove(event) {
    event.target.parentNode.remove();
}

let form = document.getElementsByTagName('form')[0];
form.addEventListener('submit', function (event) {


    let options = document.getElementsByClassName('options');

    for (option of options) {
        let dates = option.getElementsByTagName('input');
        if (dates[0].value >= dates[1].value) {
            event.preventDefault();
            alert("Date Start must be before Date End");
        }
    }
});
