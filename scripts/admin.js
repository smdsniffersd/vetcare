function getInfo(elem) {

    const value = elem.value;

    fetch('/php_components/adminlogic.php', {
        method: 'POST',
        body: JSON.stringify({ value: value }),
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(responce =>{

        return responce.json();

    }).then(data => {
        if(data.success){
            console.log('Success', data);
        }else{
            console.log('Error', data.message);
        }
    }).catch(error => console.error('Fetch error', error));

}