$('.addToCart').click(function() {
    let productId = $(this).attr('data-productId');
    

    toastr.success('Hé, <b>ça marche ! '+productId+'</b>', 'Test');

})