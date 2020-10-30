document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.al-team-grid .rtin-title a');
    Array.prototype.forEach.call(links, function (el, i) {
        el.addEventListener('click', function (ev) {
            console.log('click');
            ev.preventDefault();
        });
    });
});