var NEXT_PAGE='';function followLink()
{document.location.href=NEXT_PAGE;}
function stSelectCountry(sender)
{var fullnamelocal=$(sender).attr('data-country-name-local').toUpperCase();var abb=$(sender).attr('data-country-code').toUpperCase();var id=$(sender).attr('data-country-id').toUpperCase();var picker=$(sender).closest('.st-country-pick-list');var act=$(picker).attr('data-action');var elname=$(picker).attr('data-element');var elcontent=$(picker).attr('data-element-content');var newval='';if(elcontent=='code')
newval=abb;else
newval=id;if(act=='link')
{var url=$(picker).attr('data-url');var overrideurl=$(sender).attr('data-override-url');if(overrideurl)
url=overrideurl;url+='?'+elname+'='+encodeURI(newval);NEXT_PAGE=url;if(document.body.clientWidth>767)
{followLink();}
else
{$(sender).addClass('clicked');setTimeout(followLink,3000);}
return false;}
if(act=='form')
{var f=document.forms[$(picker).attr('data-form')];var el=f.elements[elname];el.value=newval;var display=$(picker).find('.st-selected-country');var old=$(display).attr('data-current');var lnk=$(display).find('.dropdown-toggle');$(display).attr('data-current',abb);$(lnk).removeClass('st-country-'+old);$(lnk).addClass('st-country-'+abb);$(lnk).find('.st-selected-country-name').html(fullnamelocal);$(lnk).click();formvalidator.formUpdated(f,el);}
$(picker).find('.dropdown').removeClass('open');return true;}
$(document).ready(function(){$('.st-country-pick-list .dropdown-menu INPUT').click(function(evt){evt.stopPropagation();});$('.st-country-option').click(function(evt){stSelectCountry(this);evt.stopPropagation();return false;});$('.st-country-filter').keyup(function(evt){var lookup=$(this).val();lookup=lookup.toUpperCase();var numfound=0;var singleel=null;var picker=$(this).closest('.st-country-pick-list');$(picker).find('.st-country-option').each(function(){var fullname=$(this).attr('data-country-name').toUpperCase();var fullnamelocal=$(this).attr('data-country-name-local').toUpperCase();var abb=$(this).attr('data-country-code').toUpperCase();if((fullname.indexOf(lookup)==0)||(fullnamelocal.indexOf(lookup)==0)||((lookup.length==2)&&(lookup==abb)))
{$(this).show();numfound++;singleel=$(this);}
else
$(this).hide();});if(numfound==1)
{$(this).val('');stSelectCountry(singleel);$(picker).find('.st-country-option').each(function(){$(this).show();});}});});