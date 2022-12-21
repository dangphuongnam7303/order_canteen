// Menu tab
document.addEventListener('click', function (event) {
    const menu_dropdown = document.querySelector('#menu-drop');
    const sub_menu = document.querySelector('#sub-menu-drop');
    if (menu_dropdown.contains(event.target)) {
        sub_menu.classList.toggle('hidden')
    } else {
        if (!sub_menu.classList.contains('hidden')) {
            sub_menu.classList.add('hidden')
        }
    }
})









