$(function(){var list=$(".invitee-list");var prototype=list.data('prototype');$("#add-invitee-trigger").click(function(e){var count=list.children(".input-field").length+1;var html=prototype.replace(/__name__/g,count);list.append(html);});$(document).on('click','.invitee-row-remove-trigger',function(){var row=$(this).closest(".form-row");row.hide('slow',function(){$(this).remove();})});$("form").validate();jQuery(".number-input").rules("add",{"number":true});jQuery(".zipcode-input").rules("add",{"zipcodeUS":true,"messages":{"zipcodeUS":"Please enter a valid US zip code",}});});$(document).ready(function(){$(document).on("click",".remove_field",function(e){e.preventDefault();if(!confirm('Are you sure you want to remove this friend?')){return false;}
$(this).parent('div').fadeOut('slow',function(){$(this).remove();});});$("#first_name").keypress(function(e){var code=e.keyCode||e.which;if((code<65||code>90)&&(code<97||code>122))
{$('#namespan').html("Only alphabates are allowed");return false;}
else{$('#namespan').html("");return true;}});$("#last_name").keypress(function(e){var code=e.keyCode||e.which;if((code<65||code>90)&&(code<97||code>122))
{$('#lastspan').html("Only alphabates are allowed");return false;}
else{$('#lastspan').html("");return true;}});$("#email").keyup(function(){var mailformat=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;var email=$('#email').val();if(email.match(mailformat))
{$('#email_span').html('');return false;}
else{$('#email_span').html('Invalid email');return true;}});$("#zip_code").keyup(function(){var zip_code=$('#zip_code').val();if(isNaN(zip_code))
{$('#zip_span').html('Only Number');return false;}
else{$('#zip_span').html('');return true;}});$("#no_of_guest").keyup(function(){var no_of_guest=$('#no_of_guest').val();if(isNaN(no_of_guest))
{$('#guest_span').html('Only Number');return false;}
else{$('#guest_span').html('');return true;}});$(".form-focus-trigger").click(function(e){e.preventDefault();window.scrollTo(0,document.getElementsByClassName("landing")[0].offsetTop);if("#registration_primaryGuest_firstName"){$("#registration_primaryGuest_firstName").focus();}})})