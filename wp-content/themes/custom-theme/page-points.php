<?php get_header();?>

<legend><h1>Points Page</h1></legend>

<p>Display reward points here</p>

<?php

if(isset($_SESSION['id']))
{
    $customer_id = $_SESSION['id'];

    $customer = get_data('tbl_accounts', $customer_id);

    echo "<h1>ID: $customer->id </h1>";
    echo "<h1>Name: $customer->name </h1>";
}

?>
<button id="logout"> Logout </button>

<?php get_footer();?>
