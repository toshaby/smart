document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#widgetform').addEventListener('submit', async function (target) {

        target.preventDefault();

        let formdata = new FormData(this);
        let response = await fetch(this.action, {
            method: "POST",
            body: formdata,
            headers: { 'Accept': 'application/json' }
        });

        let result = await response.json();

        for (let elem of document.querySelectorAll(".message")) elem.innerHTML = '&nbsp;';

        let undefinedErrors = [];

        if (result.success) {
            document.querySelector('.message.ok').innerHTML = result.message;
            document.querySelector('.message.ok').classList.remove('error');
        } else if (result.errors) {
            for (let error in result.errors) {
                let elem = document.querySelector('*[name="' + error.replace(/\.[0-9]+$/, '[]') + '"]');
                if(elem) {
                    elem.closest('.form_field').querySelector('.message').innerHTML = result.errors[error].join('<br>');
                } else {
                    undefinedErrors = undefinedErrors.concat(result.errors[error]);
                }
            }
        } else if (result.message) {
            undefinedErrors.push(result.message);
        }

        if(undefinedErrors.length) {
            document.querySelector('.message.ok').innerHTML = undefinedErrors.join('<br>');
            document.querySelector('.message.ok').classList.add('error');
        }
        
    })
});
