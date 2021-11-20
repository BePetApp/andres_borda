<div class="m-2 flex no-wrap gap-2">
    <div class="bg-green-500 text-white p-2 rounded-xl" type="button">
        <?php echo "Hola " . $_SESSION['user'] ?>
    </div>

    <select class="bg-red-500 text-white p-2 rounded-xl cursor-pointer appearance-none hover:bg-red-700 focus:bg-gray-700" name="forma" onchange="location = this.value;">
        <option disabled="" selected="">Menu</option>
        <option value="#">Home</option>
        <option value="index.php?page=Crud">Crud</option>
        <option value="index.php?page=LogOut">Log Out</option>
    </select>     
</div>