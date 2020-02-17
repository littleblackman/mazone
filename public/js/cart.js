$('.addToCart').click(function() {
    let url = $(this).attr('data-url');
    
    $.ajax({
        url: url,
        dataType: "json",
        success: function(datas){
            toastr.success('hello', 'Panier');
            console.log(datas);
            let quantity = 0;
            for(let i = 0; i < datas.length; i++) {
                quantity += datas[i].quantity;
            }

            // show cart nb item
            $('.cartNbItems').text(quantity);
        }
    });

})