

jQuery(document).ready(function($){
	$('[data-toggle="tooltip"]').tooltip();if($(".blog").length){
		$(window).scroll(function(){
			($(window).scrollTop()>300)?$('#arriba').removeClass('hidden'):
			$('#arriba').addClass('hidden');
		});
	
		$('#arriba').click(function(){
			$("html, body").animate({scrollTop:0},"slow");
		});
	}

	$('#contact-open').click(function(){
		if($(".widget.widget_text").length)
			$(".widget.widget_text").toggleClass('hidden');
	});

	$(".servicio").click(function(){
		$(this).find('span').toggleClass('inactivo');
		$(this).toggleClass('activo');
		var price=parseInt($("#uym-price").text());
		if($(this).hasClass('activo'))
			$("#uym-price").text(price+parseInt($(this).children().attr('data-price')));
		else
			$("#uym-price").text(price-parseInt($(this).children().attr('data-price')));
	});

	$("#btn-modal").click(function(){
		$("#summary-list").empty();$("#servs-list").val("");
		$("#servs-total").text($("#uym-price").text()+"€");$(".servicio").each(function(){
			var txta=$("#servs-list").val();if(!$(this).children().hasClass('inactivo')){
				$("#summary-list").append("<li>"+$(this).text()+"</li>");$("#servs-list").val(txta+"• "+$(this).text()+"\n");
			}});
		if($("#summary-list").children().length==0){
			$("#summary-list").append("<li>Sin opciones seleccionadas</li>");
			$("#servs-list").val("• Sin opciones seleccionadas\n");
		}

		$("#servs-list").val($("#servs-list").val()+"\nTOTAL ESTIMADO: "+$("#uym-price").text()+"€\n");
	});

	$("#btn-reset").click(function(){
		$(".servicio").each(function(){
			$(this).children().addClass('inactivo');
			$(this).removeClass('activo');
	})
		$("#uym-price").text("0");
	});

	if($(".widget.widget_text").length){
		$('.widget.widget_text').affix({offset:{top:$('.widget.widget_text').offset().top,}});
	}
	$(".widget.widget_text").on('affixed.bs.affix',function(){
		$(".affix").css('top','50px');
	});

});
