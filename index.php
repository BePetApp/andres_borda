<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fe08a25bb7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <title>Blog</title>
</head>
<body>
    <div class="container-fluid" style="background: #212529;">
        <!-- Barra de Navegacion -->
        <div class="flex items-center text-white sticky inset-0" style="background: #131313; box-shadow: 0 5px 10px rgb(239, 68, 68);">
            <div class="flex-1 bg-transparent">
                <img src="image.png" alt="logo" class="h-14 w-auto m-2" style="min-width: 3.5rem">
            </div>
            <div class="m-2 bg-transparent">
                Inicio
            </div>
            <div class="m-2" id="articulos_1">
                Articulos
            </div>
            <?php if(isset($_GET['Log_Username'])) : ?>
                    <div x-data="{ dropdownOpen: false }" class="m-2 flex flex-wrap items-center justify-center gap-2">
                            <p class="font-bold text-center"> Hola <span class="text-red-300"><?php print_r($_GET["Log_Username"]) ?></span></p>
                            
                            <button @click="dropdownOpen = !dropdownOpen" class="block rounded-md bg-red-500 text-white text-center p-2 focus:outline-none">
                                
                                <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                </p>      
                            </button>
                      
                            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
                        
                            <div x-show="dropdownOpen" class="absolute top-14 right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                your profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Your projects
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Help
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Settings
                            </a>
                            <a href="/blog/index.php" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                Sign Out
                            </a>
                            </div>
                        </div>

                <?php else: ?>
                        <div class="m-2 flex gap-2 flex-wrap">
                            <button id="buttonmodal" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-700" type="button">LogIn</button>
                            <button id="buttonmodal_2" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-700" type="button">Registrate</button>     
                        </div>
                
                <?php endif; ?>
        </div>
        <!-- FIn Barra de Navegacion -->
        
        <!-- Header -->
        <div class="header gap-x-4 max-w-screen-lg mx-auto" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
            <div class="flex justify-center items-center">
                <img src="image.png" alt="logo-principal">
            </div>
            <div class="text-white p-4 flex items-center">
                <div>
                    <h1 class="text-4xl font-semibold"><span class="text-red-500">Burogu</span> Blog</h1><br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam ex architecto iste a esse corrupti aperiam sit, enim iure, consectetur voluptatem obcaecati sapiente error quis inventore suscipit amet facilis sunt!</p><br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, odit corrupti magnam sit cumque saepe voluptatibus dolor pariatur eaque iure, omnis quam ducimus reiciendis dolore eveniet excepturi. Nulla, est inventore.</p>
                </div>

            </div>
        </div>
        <!-- Fin Header -->

        <!-- Contenido -->
        <div class="flex flex-col text-white" style="background: #131313;">
            <div class="max-w-screen-lg mx-auto my-3">
                <h2 class="text-center pt-3 text-2xl font-semibold">Articulos destacados</h2>
                <div class="py-8 gap-x-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div class="flex items-center flex-wrap h-full">
                        <div class="flex">
                            <div class="p-3 m-2" style="background: #212529;">
                                <h3 class="py-2 font-semibold text-red-500">Articulo 1</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, magnam.</p>
                                <br><p class="italic text-gray-100 opacity-25 text-sm">Tags: Una, dos, tres</p>
                                <p class="italic text-gray-100 opacity-30 text-sm">Fecha: xx/xx/xxxx</p>
                                <p class="italic text-gray-100 opacity-30 text-sm">Autor: Nombre-Autor</p> 
                            </div>
                            <div class="p-3 m-2" style="background: #212529;">
                                <h3 class="py-2 font-semibold text-red-500">Articulo 2</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, magnam.</p>
                                <br><p class="italic text-gray-100 opacity-30 text-sm">Tags: Una, dos, tres</p>
                                <p class="italic text-gray-100 opacity-30 text-sm">Fecha: xx/xx/xxxx</p>
                                <p class="italic text-gray-100 opacity-30 text-sm">Autor: Nombre-Autor</p>  
                            </div>
                        </div>
                        <div class="flex">
                            <div class="p-3 m-2" style="background: #212529;">
                                <h3 class="py-2 font-semibold text-red-500">Articulo 3</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, magnam.</p>
                                <br><p class="italic text-gray-100 opacity-30 text-sm">Tags: Una, dos, tres</p>
                                <p class="italic text-gray-100 opacity-30 text-sm">Fecha: xx/xx/xxxx</p>
                                <p class="italic text-gray-100 opacity-30 text-sm">Autor: Nombre-Autor</p>    
                            </div>
                            <div class="p-3 m-2" style="background: #212529;">
                                <h3 class="py-2 font-semibold text-red-500">Articulo 4</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, magnam.</p>
                                <br><p class="italic text-gray-100 opacity-30 text-sm">Tags: Una, dos, tres</p>
                                <p class="italic text-gray-100 opacity-30 text-sm">Fecha: xx/xx/xxxx</p>
                                <p class="italic text-gray-100 opacity-30 text-sm">Autor: Nombre-Autor</p>    
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="p-3 bg-blue-500 h-full">
                            <h3 class="py-2 font-semibold">Articulo 5</h3>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore consequuntur hic numquam. Quam iure corporis quo perspiciatis accusantium, recusandae totam cumque, consequuntur nostrum voluptates quos cupiditate quidem veniam voluptatibus libero?</p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, culpa. Laborum nulla atque nobis dolore tempore necessitatibus fugiat! Provident ea voluptatem eligendi dolore delectus molestias illo autem veritatis consectetur ullam.</p>
                            <br><p class="italic text-gray-100 opacity-30 text-sm">Tags: Una, dos, tres</p>
                            <p class="italic text-gray-100 opacity-30 text-sm">Fecha: xx/xx/xxxx</p>
                            <p class="italic text-gray-100 opacity-30 text-sm">Autor: Nombre-Autor</p>    
                        </div>
                    </div>
                </div>
                <div style="text-align: center;" class="p-3">
                    <a href="#" class="bg-red-500 rounded-lg p-3 hover:bg-red-700">Mas Articulos</a>

                </div>
                <!-- <h3 class="text-center"><a href="#" class="p-3 rounded-lg" style="background: #212529;">Mas Articulos</a></h3> -->
            </div>
            <div style="padding-left: 5vw; padding-right: 5vw;">
                <h2 class="text-center pt-3 text-2xl font-semibold">Redes Sociales</h2>
                <div class="py-8 gap-2 flex flex-row flex-wrap">
                    <div class="bac flex-1 h-24 flex justify-center items-center" id="facebook">
                        <i class="fab fa-facebook-f text-6xl p-3"></i>
                    </div>
                    <div class="bac flex-1 h-24 flex justify-center items-center" id="youtube">
                        <i class="fab fa-youtube text-6xl p-3"></i>
                    </div>
                    <div class="bac flex-1 h-24 flex justify-center items-center" id="twitter">
                        <i class="fab fa-twitter text-6xl p-3"></i>
                    </div>
                    <div class="bac flex-1 h-24 flex justify-center items-center" id="reddit">
                        <i class="fab fa-reddit-alien text-6xl p-3"></i>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Fin Contenido -->
    </div>


    <div id="modal"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-gray-900 bg-opacity-50 transform scale-0 transition-transform duration-300">
    <!-- Modal content -->
        <div class="container text-white h-3/4 flex flex-col" style="background: rgba( 19, 19, 19, .8);"> 
            <div class="test w-full h-full flex flex-row items-center justify-center">
                <div class="flex-1" style="margin: 5vw; z-index: 999999;">
                    <h2 class="text-3xl">Log <span class="text-red-500 font-semibold">In</span></h2>
                    <form>
                        <div class="flex flex-col gap-2 my-3">
                            <label for="">Username</label>
                            <input type="text" name="Log_Username" class="text-black p-1">
                        </div>
                        <div class="flex flex-col gap-2 my-3">
                            <label for="">Password</label>
                            <input type="password" name="Log_password" class="text-black p-1">
                        </div>
                        <label class="text-xs"><input type="checkbox" name="" id=""> Recordar Datos</label>
                        <div class="grid justify-items-end">
                            <button class="bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-700" type="submit">Enter</button>
                        </div>
                    </form>
                </div>
                <div class="h-full w-1/2 hidden sm:inline md:inline lg:inline xl:inline 2xl:inline" style="background: url('img/php.jpg'); background-size: cover; background-position: center;">
                </div>
                <div class="absolute inset-1.5 font-bold">
                    <button id="closebutton" type="button" class="focus:outline-none p-3">
                        <!-- Hero icon - close button -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Registro -->
    <div id="modal_2"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-gray-900 bg-opacity-50 transform scale-0 transition-transform duration-300">
    <!-- Modal content -->
        <div class="container text-white h-3/4 bg-opacity-50 flex flex-col" style="background: rgba( 19, 19, 19, .8);"> 
            <!-- Test content -->
            <div class="test w-full h-full flex flex-row items-center justify-center">
                <div class="h-full w-1/2 hidden sm:inline md:inline lg:inline xl:inline 2xl:inline" style="background: url('img/php.jpg'); background-size: cover; background-position: center;"></div>
                <div class="flex-1" style="margin: 5vw;">
                    <h2 class="text-3xl">Registrate<span class="text-red-500 font-semibold"> Aqui</span></h2>
                    <form action="" class="">
                        <div class="flex flex-col gap-2 my-3">
                            <label for="">Nombre</label>
                            <input type="text" name="Nombre" class="text-black p-1">
                        </div>
                        <div class="flex flex-col gap-2 my-3">
                            <label for="">Username</label>
                            <input type="text" name="Reg_usermane" class="text-black p-1">
                        </div>
                        <div class="flex flex-col gap-2 my-3">
                            <label for="">Email</label>
                            <input type="email" name="Reg_email" class="text-black p-1">
                        </div>
                        <div class="flex flex-col gap-2 my-3">
                            <label for="">Password</label>
                            <input type="password" name="Reg_password" class="text-black p-1">
                        </div>
                        <div class="grid justify-items-end">
                            <button class="bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-700" type="submit">Enter</button>
                        </div>
                    </form>
                    <div class="absolute inset-1.5 font-bold" style="z-index: -1;">
                        <button id="closebutton_2" type="button" class="focus:outline-none p-3">
                            <!-- Hero icon - close button -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
<script> 
    const button = document.getElementById('buttonmodal')
    const closebutton = document.getElementById('closebutton')
    const modal = document.getElementById('modal')
    // dos
    const button2 = document.getElementById('buttonmodal_2')
    const closebutton2 = document.getElementById('closebutton_2')
    const modal2 = document.getElementById('modal_2')


    button.addEventListener('click',()=>modal.classList.add('scale-100'))
    closebutton.addEventListener('click',()=>modal.classList.remove('scale-100'))
    //dos 
    button2.addEventListener('click',()=>modal2.classList.add('scale-100'))
    closebutton2.addEventListener('click',()=>modal2.classList.remove('scale-100'))
</script>
</html>

