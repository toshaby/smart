document.addEventListener('DOMContentLoaded', function () {
    let change = document.querySelector('select#statusselect');
    if (change) {
        change.addEventListener('change', async function () {
            let formdata = new FormData();
            formdata.append('status', this.value);
            formdata.append('_token', this.dataset.csrf);

            let response = await fetch(this.dataset.url, {
            method: "PUT",
            body: formdata,
            headers: { 'Accept': 'application/json' }
        });

        let result = await response.json();
        
        if (result.success) location.reload();

        if(result.message) alert(result.message);

        })
    }
});
