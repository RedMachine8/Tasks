var messages__container = document.getElementById('messages');
var interval = null;
var sendForm = document.getElementById('chat-form');
var messageInput = document.getElementById('message-text');
var messageFIO = document.getElementById('message-name');

function send_request(act) {
    var var1 = null;
    var var2 = null;
    if(act == 'send') {
        var1 = messageInput.value;
        var2 =messageFIO.value;
    }

    $.post('chat.php',{
        act: act,
        var1: var1,
        var2: var2
    }).done(function (data) {
        messages__container.innerHTML = data;
        if(act == 'send') {
            messageInput.value = '';
        }
    });
}
function update() {
    send_request('load');
}

interval = setInterval(update,500);
sendForm.onsubmit = function () {
    send_request('send');
    return false;
};