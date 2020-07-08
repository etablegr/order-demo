
$( document ).ready(function(){
    var exampleSocket = new WebSocket("wss://535j71sx0h.execute-api.eu-central-1.amazonaws.com/Test", "protocolOne");

    exampleSocket.onmessage = function (event) {
        console.log(event.data);
        var data = event.data;
        var element = document.createElement('li')
        $(element).text(event.data);
        $('#orders').append(element);
    }
});

