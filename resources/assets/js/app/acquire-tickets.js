$(function(){
	$('#acquire-tickets-form input[name="products[0][quantity]"]').on('change keyup click',function(){
		var form = $('#acquire-tickets-form');
		var price = $('input[name=product_price]',form).val();
		var quantity = $(this).val();

		var amount = price * quantity;

		$('.amount',form).text(amount);
	});
});