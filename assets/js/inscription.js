document.getElementById('confirm').addEventListener('click', function () {
    if (this.checked) {
        document.getElementById('submit').disabled = false;
    } else {
        document.getElementById('submit').disabled = true;
    }
}
);