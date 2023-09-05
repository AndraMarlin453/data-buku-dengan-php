$(document).ready(function(){
    $('#keyword').on('keyup', function(){
        $('#container').load('ajax/pencarian_buku.php?keyword=' + $('#keyword').val());
    })
})