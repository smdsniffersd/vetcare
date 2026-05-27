function getInfoDoc(elem) {

    const hiddenLi = document.getElementById('hiddenLi');
    hiddenLi.textContent = elem.dataset.table;
    console.log(hiddenLi.textContent);
    getInfo(hiddenLi);
}
