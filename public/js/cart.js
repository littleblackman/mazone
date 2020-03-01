$('.addToCart').click(function(e) {

    e.preventDefault();

    let url = $(this).attr('data-url');
    
    $.ajax({
        url: url,
        dataType: "json",
        success: function(datas){
            let name = datas.nameFr;
            toastr.success('Merci !', 'Votre produit '+name+' a bien été ajouté au panier');
           
            let quantity = parseInt($('#cartNbItems').text());            
        
            if(isNaN(quantity)) {
                quantity = 0;
            } 

            quantity++;

            // show cart nb item
            $('#cartNbItems').text(quantity);
            $('#cartNbItems').show();
        }
    });

})


$('.removeFromCart').click(function(e) {

    e.preventDefault();

    let url = $(this).attr('data-url');
    
    $.ajax({
        url: url,
        dataType: "json",
        success: function(datas){
            toastr.warning('Merci !', 'Votre produit a bien été supprimé du panier');
            let quantity = parseInt($('#cartNbItems').text());            
            quantity--;
            // show cart nb item
            $('#cartNbItems').text(quantity);
            $('#cartNbItems').show();
        }
    });

})

$('.cart_quantity_up').click(function() {
    let productId = $(this).attr('data-productId');

    let quantity = $('#inputQuantityProduct-'+productId).val();

    quantity++;

    $('#inputQuantityProduct-'+productId).val(quantity);

    calculAllPrice(productId, quantity, '+');
})

$('.cart_quantity_down').click(function() {
    let productId = $(this).attr('data-productId');

    let quantity = $('#inputQuantityProduct-'+productId).val();

    quantity--;

    calculAllPrice(productId, quantity, '-');
    
    if(quantity == 0) {
       $('.productLine-'+productId).remove();
    } else {
        $('#inputQuantityProduct-'+productId).val(quantity);
    }


})

function calculAllPrice(productId, quantity, sign) {
    let unitPrice = parseFloat($('#showProductUnitPrice-'+productId).text());
    let totalProduct = unitPrice*quantity;
    $('#showProductTotalPrice-'+productId).text(totalProduct.toFixed(2));

    let totalPrice = parseFloat($("#totalPriceValue").text());

    if(sign == "+") {
        totalPrice = totalPrice + unitPrice;
    } else {
        totalPrice = totalPrice - unitPrice;
    }

    $('#totalPriceValue').text(totalPrice.toFixed(2));

    if(totalPrice <= 0) {
        window.location.reload();
    }

}