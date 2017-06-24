<?php get_header(); ?>

<div class="container">

<legend><h1>Profile Page</h1></legend>

<p>Customer profile info goes here....</p>

<?php

    if(isset($_SESSION['status']) && $_SESSION['status'] == 'logged_in')
    {
        $customer_id = $_SESSION['id'];
        $customer = get_data('tbl_accounts', $customer_id);

        echo "<h1>ID: $customer->id </h1>";
        echo "<h1>Name: $customer->name </h1>";
    }
?>

<button id="edit-profile" class="btn btn-primary btn-edit">Edit</button>
<button id="logout" class="btn btn-edit">Logout</button>
</div>

<style>
.btn-edit {
    width: 80px;
    height: 35px;
}
</style>

<?php get_footer(); ?>
