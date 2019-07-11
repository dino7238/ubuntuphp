<?php
// Install the DB module using 'pear install DB'
require_once("db.php");

header( 'Content-type: text/xml' );

$id = 0;
if ( array_key_exists( 'id', $_GET ) ) { $id = $_GET['id']; }

$db =& DB::Connect( 'mysql://root@localhost/chat', array() );
if (PEAR::isError($db)) { die($db->getMessage()); }
?>
<messages>
<?php
$res = $db->query( 'SELECT * FROM messages WHERE message_id > ?', $id );
while( $res->fetchInto( $row ) )
{
?>
<message id="<?php echo($row[0]) ?>" user="<?php echo($row[1]) ?>">
<?php echo($row[2]) ?>
</message>
<?php
}
?>
</messages>
