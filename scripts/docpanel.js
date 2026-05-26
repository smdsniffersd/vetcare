function getInfoDoc(elem) {

    const hiddenLi = document.getElementById('hiddenLi');
    hiddenLi.textContent = elem.dataset.table;
    getInfo(hiddenLi);
}
