<div class="m-2 flex no-wrap gap-2">
    <div class="bg-green-500 text-white p-2 rounded-full" type="button">
        <?php
            echo "Hola " . $userNick;
        ?>
    </div>

    <select class="bg-red-500 text-white p-2 rounded-sm cursor-pointer appearance-none hover:bg-red-700 focus:bg-gray-700" name="forma" onchange="location = this.value;">
        <option disabled="" selected="">Menu</option>
        <option value="Home.php">Home</option>
        <option value="./pages/crud/crud.php">Crud</option>
        <option value="./">Log Out</option>
    </select>     
</div>