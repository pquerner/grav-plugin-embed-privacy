document.addEventListener('DOMContentLoaded', function () {
    var overlays = document.querySelectorAll('.embed-overlay');

    for (var i = 0; i < overlays.length; i++) {
        overlays[i].addEventListener('click', function (event) {
            var current_target = event.currentTarget;
            var embed_content = current_target.nextElementSibling;
            current_target.style.display = 'none';
            embed_content.innerHTML = embed_content.innerHTML.replace('<!--noptimize-->', '').replace('<!--/noptimize-->', '');
            embed_content.innerHTML = embed_content.innerHTML.replace(/<!--/, '').replace(/-->/, '');
        })
    }
});
