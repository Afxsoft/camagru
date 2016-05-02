<div class="center">
    <form action="index.php?page=admin_page&action=new_product" method="post" class="form_style">
        <h1 style="text-align: center">
            New product
        </h1>
        <label>
            <span>Name :</span>
            <input  type="text" name="name" placeholder="Name" required/>
        </label>

		<label>
			<span>Price :</span>
			<input  type="text" name="price" placeholder="Price" required/>
		</label>

		<label>
			<span>Category :</span>
			<input  type="text" name="category" placeholder="Category" required/>
		</label>

		<label>
			<span>Image :</span>
			<input  type="text" name="img" placeholder="Image" required/>
		</label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" value="Ok" />
        </label>
    </form>
</div>
<div class="center">
    <form action="index.php?page=admin_page&action=mod_product" method="post" class="form_style">
        <h1 style="text-align: center">
            Modify product
        </h1>
        <label>
            <span>Name :</span>
            <input  type="text" name="name" placeholder="Name" required/>
        </label>

		<label>
			<span>Price :</span>
			<input  type="text" name="price" placeholder="Price" required/>
		</label>

		<label>
			<span>Category :</span>
			<input  type="text" name="category" placeholder="Category" required/>
		</label>

		<label>
			<span>Image :</span>
			<input  type="text" name="img" placeholder="Image" required/>
		</label>
        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" value="Ok" />
        </label>
    </form>
</div>
<div class="center">
    <form action="index.php?page=admin_page&action=add_cat_prod" method="post" class="form_style">
        <h1 style="text-align: center">
            Add a category to a product<br />
        </h1>
        <label>
            <span>Name of the product :</span>
            <input  type="text" name="p_name" placeholder="Product's name" required/>
        </label>
		<label>
			<span>Name of the category :</span>
			<input  type="text" name="name" placeholder="Category's name" required/>
		</label>

		<label>
			<span>&nbsp;</span>
			<input type="submit" class="button" value="Ok" />
		</label>
    </form>
</div>
<div class="center">
    <form action="index.php?page=admin_page&action=del_cat_prod" method="post" class="form_style">
        <h1 style="text-align: center">
            Delete a category from a product<br />
        </h1>
        <label>
            <span>Name of the product :</span>
            <input  type="text" name="p_name" placeholder="Product's name" required/>
        </label>
		<label>
			<span>Name of the category :</span>
			<input  type="text" name="name" placeholder="Category's name" required/>
		</label>

		<label>
			<span>&nbsp;</span>
			<input type="submit" class="button" value="Ok" />
		</label>
    </form>
</div>
<div class="center">
    <form action="index.php?page=admin_page&action=delete_product" method="post" class="form_style">
        <h1 style="text-align: center">
            Delete a product
        </h1>
        <label>
            <span>Name :</span>
            <input  type="text" name="name" placeholder="Name" required/>
        </label>

		<label>
			<span>&nbsp;</span>
			<input type="submit" class="button" value="Ok" />
		</label>
    </form>
</div>
<div class="center">
    <form action="index.php?page=admin_page&action=new_category" method="post" class="form_style">
        <h1 style="text-align: center">
            New Category
        </h1>
        <label>
            <span>Name :</span>
            <input  type="text" name="name" placeholder="Name" required/>
        </label>

        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" value="Ok" />
        </label>
    </form>
</div>
<div class="center">
    <form action="index.php?page=admin_page&action=mod_category" method="post" class="form_style">
        <h1 style="text-align: center">
            Modify category
        </h1>
        <label>
            <span>Name :</span>
            <input  type="text" name="old_name" placeholder="Old name" required/>
        </label>
		<label>
			<span>New name :</span>
			<input  type="text" name="name" placeholder="New name" required/>
		</label>

        <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" value="Ok" />
        </label>
    </form>
</div>
<div class="center">
    <form action="index.php?page=admin_page&action=delete_category" method="post" class="form_style">
        <h1 style="text-align: center">
            Delete a category
        </h1>
        <label>
            <span>Name :</span>
            <input  type="text" name="name" placeholder="Name" required/>
        </label>

		<label>
			<span>&nbsp;</span>
			<input type="submit" class="button" value="Ok" />
		</label>
    </form>
</div>
<div class="center">
	<form action="index.php?page=admin_page&action=modif_user" method="post" class="form_style">
		<h1 style="text-align: center">
			Modify an account
		</h1>
		<label>
			<span>First name :</span>
			<input type="text" name="first_name" value="" required>
		</label>
		<label>
			<span>Last name :</span>
			<input type="text" name="last_name" value="" required>
		</label>
		<label>
			<span>Login :</span>
			<input  type="text" name="login" required />
		</label>
		<label>
			<span>Email :</span>
			<input type="email" name="email" value="" required>
		</label>
		<label>
			<span>Billing address :</span>
			<input type="text" name="billing" value="" required>
		</label>
		<label>
			<span>Shipping address :</span>
			<input type="text" name="shipping" value="" required>
		</label>
		<label>
			<span>&nbsp;</span>
			<input type="submit" name="submit" class="button" value="Ok" />
		</label>
	</form>
</div>
<div class="center">
    <form action="index.php?page=admin_page&action=delete_user" method="post" class="form_style">
        <h1 style="text-align: center">
            Delete an user
        </h1>
        <label>
            <span>Login :</span>
            <input  type="text" name="login" placeholder="Login" required/>
        </label>
		<label>
			<span>&nbsp;</span>
			<input type="submit" name="submit" class="button" value="Ok" />
		</label>
    </form>

</div>
