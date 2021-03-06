jQuery(document).ready(function($) {
var event_id;
fetch_approve_guest();
$("#submit_request").on("click",function(){
    var requestForm=$('#guest_request_form');                      
    if(!requestForm[0].checkValidity()){
        requestForm[0].reportValidity();
        return; 
    }else{  
        ajax_guest_request_form();
        $('#guest_request_form').trigger('reset');
        $('#request_modal').modal('toggle');
    }
});



$(".button-request").on("click",function(){
    event_id=$(this).data('id');
});

$(document).on("click",'.accept',function(){    
    var guest_id=$(this).attr('id');
    var event_id=$(this).attr('value');
    update(guest_id,event_id);
});
 

$(document).on("click",'.send',function(){    
    var guest_id=$(this).attr('id');
    var event_id=$(this).attr('value');
   send(guest_id,event_id); 
});


function send(guest_id,event_id){
    var guest_id= guest_id;
    var event_id= event_id;
    
    var send_id ="action=send_message&guest_id="+guest_id+"&event_id="+event_id;
    
 $('#progress').show();

    $.ajax({
        type:'POST',
        url:PARAMS.ajaxurl,
        data:send_id,
        success:function(result){
$('#progress').hide();        
        alert('email has been send!')
        }
    });
}



function update(guest_id,event_id){
    var guest_id= guest_id;
    var event_id= event_id;
    var retrive_guest ="action=update_guest&guest_id="+guest_id+"&event_id="+event_id;

    $.ajax({
        type:'POST',
        url:PARAMS.ajaxurl,
        data:retrive_guest,
        success:function(result){
            fetch_guest(event_id);
            fetch_approve_guest();       
        }
    });
}

function ajax_guest_request_form(){
    var guest_request_form ="action=add_guest_request&event_id="+event_id+"&"+$('#guest_request_form').serialize();
    $.ajax({
        type: 'POST',
        url:PARAMS.ajaxurl,
        data:guest_request_form,
        success:function(e){
            alert("Request has been sent");
        }
    });
}

$("#select-event").on("click",function(){
    var e = document.getElementById("select-event");
    var strUser = e.options[e.selectedIndex].value;
    fetch_guest(strUser);
});

function fetch_guest(id){
    var event_id= id;
    var fetch_request ="action=show_requested_guest&event_id="+event_id;
    $.ajax({
        type:'POST',
        url:PARAMS.ajaxurl,
        data:fetch_request,
        success:function(result){
            $("#request_guest").html(result);        
        }
    });
}


$("#select-event-guest").on("click",function(){
    var e = document.getElementById("select-event-guest");
    var User = e.options[e.selectedIndex].value;
      console.log(event_id);
    fetch_guest_list(User);
});



function fetch_guest_list(id){
    var event_id= id;
    var fetch_request ="action=show_guest_list&event_id="+event_id;
    $.ajax({
        type:'POST',
        url:PARAMS.ajaxurl,
        data:fetch_request,
        success:function(result){
            $("#guest_list").html(result);        
        }
    });
}


function fetch_approve_guest(){
    var fetch_approve ="action=show_approved_guest";
    $.ajax({
        type:'POST',
        url:PARAMS.ajaxurl,
        data:fetch_approve,
        success:function(result){
            $("#approve_guest").html(result);
        }
    });
}
});
