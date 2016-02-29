$(document).ready(function(){
    $('#searchUser').keyup(function(e){
        var data = $(this).val();
        e.preventDefault();
        $.ajax({
            method:'POST',
            url: url,
            data:{keyword: data}
        }).success(function(results){
            $('#autocomplete-container').css('display','block');
            if(results === null)
            {
                $('#autocomplete-container').html(error);
            }
            else
            {
                $('#autocomplete-container').html(results);
            }
        });
    });
    $("#autocomplete-container").on('click','.valueUser',function(){

        window.location.href = window.location.origin+'/profile/show/'+$(this).data('id');
    });
    $('body').click(function(){
        $('#autocomplete-container').css('display','none');
    });

});