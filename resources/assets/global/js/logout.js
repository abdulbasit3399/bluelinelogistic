
const formLogout = $('#formLogout')

formLogout.on('click', 'a', function(e) {
    e.preventDefault();
    $(this).next('button').click()
})
