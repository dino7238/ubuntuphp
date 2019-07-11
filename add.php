
<?php
// Install the DB module using 'pear install DB'
require_once("db.php");

$db =& DB::Connect( 'mysql://root@localhost/chat', array() );
if (PEAR::isError($db)) { die($db->getMessage()); }

$sth = $db->prepare( 'INSERT INTO messages VALUES ( null, ?, ? )' );
$db->execute( $sth, array( $_SESSION['user'], $_POST['message'] ) );
?>
<table>
<?php
$res = $db->query('SELECT * FROM messages' );
while( $res->fetchInto( $row ) )
{
?>
<tr><td><?php echo($row[1]) ?></td>
<td><?php echo($row[2]) ?></td></tr>
<?php
}
?>
</table>
