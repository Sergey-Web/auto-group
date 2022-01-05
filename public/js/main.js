const element = document.getElementById('resetCounters');

element.addEventListener('click', async function () {
    let response = await fetch('/api/counter-reset', {
        method: 'GET'
    });

    let result = await response.json();

    if (result.result === 'ok') {
        location.reload();
    }
});
