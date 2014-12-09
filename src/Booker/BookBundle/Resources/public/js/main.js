$(document).ready(function() {     
    $('#container').width($('#booking_table').width());
});

$(function(){
    $.datepicker.setDefaults(
        $.extend($.datepicker.regional["ru"])
    );
  
    $('#datepicker').datepicker( {
        onSelect: function(date) {
            selectBooking(date, true);
        },
        dateFormat: "yy-mm-dd",
        firstDay: 1
    });
    $('#datepicker').datepicker('setDate', new Date);
});

$(function(){
    $.noty.defaults = {
        layout: 'center',
        theme: 'relax',//defaultTheme', // or 'relax'
        type: 'warning',
        text: '', // can be html or string
        dismissQueue: true, // If you want to use queue feature set this true
        template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
        animation: {
            open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
            close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
            easing: 'swing',
            speed: 500 // opening & closing animation speed
        },
        timeout: false, // delay for closing event. Set false for sticky notifications
        force: false, // adds notification to the beginning of queue when set to true
        modal: true,
        maxVisible: 1, // you can set max visible notification for dismissQueue true option,
        killer: true, // for close all notifications before show
        closeWith: ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications
        callback: {
            onShow: function() {},
            afterShow: function() {},
            onClose: function() {},
            afterClose: function() {},
            onCloseClick: function() {},
        },
        buttons: [
            {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
                    $noty.close();
                }
            }
        ] // an array of buttons
    };
});

function deleteBookingConfirm(id, room_id, user_id, time_start, el)
{
    noty({text: 'realy delete this booking?',
        type: 'confirm',
        buttons: [
            {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
                    $noty.close();
                    deleteBooking(id, room_id, user_id, time_start, el, true);
                }
            },
            {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
                    $noty.close();
                }
            }
        ]
    });
}

function selectBooking(date, check_resend)
{
    if (!Date.parse(date))
    {
        noty({text: "incorrect date format"});
        return;
    }
    //prevent to resend last request by the same date
    if ( check_resend &&  (((typeof last_date !== 'undefined') && (last_date == date)) 
        || ((typeof last_date == 'undefined') && (new Date().toDateString() == new Date(date).toDateString())) ) )
    {
        last_date = date;
        return;
    }
    last_date = date;
    
    $.post("/booker/web/app_dev.php/select",               
        {date: date}, 
        function(response){
                if(response.success){
                    renderBookingTable(response.booking, response.rooms, response.current_user_id, response.constants);
                }
        }, "json"); 
}

function deleteBooking(id, room_id, user_id, time_start, el, confirm){
    if (!confirm) {
        deleteBookingConfirm(id, room_id, user_id, time_start, el)
        return;
    }
    
    $.post("/booker/web/app_dev.php/delete",               
        {id: id}, 
        function(response){
            if(response.success){
                $(el.parentNode).addClass('empty_row');
                $(el.parentNode).click(function(){addBooking(room_id,user_id,time_start,false)});
                $(el.parentNode).html('');
            }
            if(response.error) {
                noty({text: response.error});
            }
        }, "json"); 
}

function renderBookingTable(booking, rooms, current_user_id, constants)
{
    var time_min = parseInt(constants.time_min);
    var time_max = parseInt(constants.time_max);
    var time_period = parseInt(constants.time_period);
    var period_count = (time_max - time_min + 1)/time_period;
    var table = '';
    if (!current_user_id)
        current_user_id = null;

    for (key in rooms)
    {
        table += '<tr><td class="left_column">Room '+rooms[key].name+'</td>';
            
        for (var period_number=1; period_number<=period_count; period_number++)
        {
            var time_start =  time_min + period_number*time_period - time_period;
            
            if ( (typeof booking[rooms[key].id] != "undefined") 
                && (typeof booking[rooms[key].id][time_start] != "undefined") )
            {
                var booking_user_id = booking[rooms[key].id][time_start]['user_id'];
                var booking_user_name = booking[rooms[key].id][time_start]['user_name'];

                table += '<td id="booking_row_'+rooms[key].id+'_'+time_start+'">';
                if (current_user_id && booking_user_id == current_user_id)
                {
                    table += '<a href="#" onclick="deleteBooking('+booking[rooms[key].id][time_start]['id']+','+
                        rooms[key].id+','+ booking[rooms[key].id][time_start]['user_id'] + ','+ time_start+', this, false)" ';
                    table += 'title="delete booking" class="by_current_user">'+booking_user_name+'</a>';
                }
                else
                {
                    table += '<span class="by_another_user">'+booking_user_name+'</span>';
                }
                table += '</td>';
            }
            else
            {
                table += '<td class="empty_row" onclick="addBooking('+rooms[key].id+','+current_user_id+','+time_start+', false)">&nbsp;</td>';
            }
        }
        table += '</tr> ';
    }

    $('#booking_table tfoot').html(table);
}

function addBookingValidate(date, time_start, user_id)
{
    if (!Date.parse(date)) {
        noty({text: "incorrect date format"});
        return false;
    }
    if (!user_id) {
        noty({text: 'you need to be loged in.'});
        return false;
    }
    
    //prevent booking to past peiod
    var current_date= new Date(); 
    var current_timestamp = current_date.valueOf() - current_date.getTimezoneOffset()*60*1000;
    var booking_timestamp = Date.parse(date) + (time_start+1)*60*60*1000;
    if (current_timestamp > booking_timestamp) {
        noty({text: "You cann't booking to past period."});
        return false;
    }
    return true;
}

function addBooking(room_id, user_id, time_start, confirm)
{
    var date = $('#datepicker').val();
    
    if (!addBookingValidate(date, time_start, user_id))
        return;
    if (!confirm) {
        addBookingConfirm(room_id, user_id, time_start)
        return;
    }
    
    $.post("/booker/web/app_dev.php/add",               
    {date: date, time_start: time_start, room_id: room_id, user_id: user_id}, 
    function(response){
        if(response.success){
            selectBooking(date, false);
        }
        if(response.error) {
            noty({text: response.error});
        }
    }, "json"); 
}

function addBookingConfirm(room_id, user_id, time_start)
{
    noty({text: 'Do you really want to book room?',
        type: 'confirm',
        buttons: [
            {addClass: 'btn btn-primary', text: 'Ok', onClick: function($noty) {
                    $noty.close();
                    addBooking(room_id, user_id, time_start, true);
                }
            },
            {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
                    $noty.close();
                }
            }
        ]
    });
}