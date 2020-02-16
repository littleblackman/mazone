$('.addToCart').click(function() {
    let url = $(this).attr('data-url');
    
    $.ajax({
        url: url,
        success: function(result){

//            let data = JSON.parse(result);
            console.log(result);
            toastr.success('hello', 'Panier');
        }
    });

})