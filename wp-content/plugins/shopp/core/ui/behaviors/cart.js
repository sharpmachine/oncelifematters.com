/*
 * cart.js - Shopp cart behaviors
 * Copyright ?? 2008-2010 by Ingenesis Limited
 * Licensed under the GPLv3 {@see license.txt}
 */
function addtocart(c){var d=jqnc(),a=d(c).find("select.options"),b=true;if(a){a.each(function(e,f){if(d(f).val()==""){return(b=false)}});if(!b){if(!sjss.opreq){sjss.opreq="You must select the options for this item before you can add it to your shopping cart."}alert(sjss.opreq);return false}}if(d(c).find("input.addtocart").hasClass("ajax-html")){ShoppCartAjaxRequest(c.action,d(c).serialize(),"html")}else{if(d(c).find("input.addtocart").hasClass("ajax")){ShoppCartAjaxRequest(c.action,d(c).serialize())}else{c.submit()}}return false}function ShoppCartAjaxRequest(b,e,a){if(!a){a="json"}var d=jqnc(),c=((a=="json")?"json":"string");d.ajax({type:"POST",url:b,data:e+"&response="+a,timeout:10000,dataType:c,success:function(f){ShoppCartAjaxHandler(f,a)},error:function(){}})}function ShoppCartAjaxHandler(i,c){var f=jqnc(),l="",b=false,g=false,h=f(".widget_shoppcartwidget div.widget-all"),a=f("#shopp-cart-ajax"),k=h.length>0?h:a,e=k.find("ul"),d=k.find("p.status"),j=k.find("div.added").empty().hide(),m=f('<div class="added"></div>');if(c=="html"){return k.html(i)}if(i.Item){b=i.Item}if(i.Totals){g=i.Totals}if(j.length==1){m=j}else{m.prependTo(k).hide()}if(b.option&&b.option.label&&b.option.label!=""){l=" ("+b.option.label+")"}if(b.image){f('<p><img src="'+i.imguri+i.Item.image.id+'" alt="" width="96"  height="96" /></p>').appendTo(m)}f("<p />").html("<strong>"+b.name+"</strong>"+l).appendTo(m);f("<p />").html(asMoney(new Number(b.unitprice))).appendTo(m);d.html('<a href="'+i.url+'"><span id="shopp-sidecart-items">'+g.quantity+'</span> <strong>Items</strong> &mdash; <strong>Total</strong> <span id="shopp-sidecart-total">'+asMoney(new Number(g.total))+"</span></a>");if(e.size()!=1){e=f("<ul />").appendTo(k)}e.html('<li><a href="'+i.url+'">'+i.label+'</a></li><li><a href="'+i.checkouturl+'">'+i.checkoutLabel+"</a></li>");m.slideDown()}jQuery(document).ready(function(){var a=jqnc();a("#cart #shipping-country").change(function(){this.form.submit()});a("input[type=image]").click(function(){a(this.form).submit()});a("input.addtocart").each(function(){var b=a(this),c=b.parents("form.product");if(!c){return false}c.bind("submit.addtocart",function(d){d.preventDefault();if(c.hasClass("validate")&&!validate(this)){return false}addtocart(this)});if(b.attr("type")=="button"){b.click(function(){c.submit()})}})});