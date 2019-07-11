<?php
if ( array_key_exists( 'username', $_POST ) ) {
  $_SESSION['user'] = $_POST['username'];
}
$user = $_SESSION['user'];
?>
<html>
<head><title><?php echo( $user ) ?> - Chatting</title>
<script src="prototype.js"></script>
</head>
<body>
<div style="height:400px;overflow:auto;">
<table id="chat">
</table>
</div>

<script>
function addmessage()
{
  new Ajax.Request( 'add.php', {
     method: 'post',
     parameters: $('chatmessage').serialize(),
     onSuccess: function( transport ) {
       $('messagetext').value = '';
     }
  } );
}
</script>

<form id="chatmessage">
<textarea name="message" id="messagetext">
</textarea>
</form>

<button on_click="addmessage()">Add</button>

<script>
var lastid = 0;
function getMessages()
{
  new Ajax.Request( 'messages.php?id='+lastid, {
    onSuccess: function( transport ) {
      var messages = transport.responseXML.getElementsByTagName( 'message' );
      for( var i = 0; i < messages.length; i++ )
      {
        var message = messages[i].firstChild.nodeValue;
        var user = messages[i].getAttribute('user');
        var id = parseInt( messages[i].getAttribute('id') );

        if ( id > lastid )
        {
          var elTR = $('chat').insertRow( -1 );
          var elTD1 = elTR.insertCell( -1 );
          elTD1.appendChild( document.createTextNode( user ) );
          var elTD2 = elTR.insertCell( -1 );
          elTD2.appendChild( document.createTextNode( message ) );

          lastid = id;
        }
      }
      window.setTimeout( getMessages, 1000 );
    }
  } );
}
getMessages();
</script>

</body>
</html>
