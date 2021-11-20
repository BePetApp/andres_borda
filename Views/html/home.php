<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/fe08a25bb7.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" href="Views/css/style.css">
    <title>Blog</title>
</head>
<body>
    <div class="container-fluid"  style="background: #212529;">
        <!-- Barra de Navegacion -->
        <div class="flex items-center text-white overflow-x-auto" style="background: #131313;">
            <div class="flex-1" style="min-width: 60px;">
                <img src="Views/img/image.png" alt="logo" class="w-16 m-2">
            </div>
            <div class="m-2" >
                <a href="#" class="hover:text-red-600">Inicio</a>
            </div>
            <div class="m-2">
                <a href="#" class="hover:text-red-600">Articulos</a>
            </div>
            <?php include $navBar ?>
        </div>
        <!-- FIn Barra de Navegacion -->
        
        <!-- Header -->
        <div class="header gap-x-4 max-w-screen-lg mx-auto" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
            <div class="flex justify-center items-center">
                <img src="Views/img/Logo.png" alt="logo-principal">
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

                <!-- articulos -->

                <div class="py-8 gap-x-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div class="flex items-center flex-wrap h-full">
                        <div class="articles">
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

                        <div class="articles">
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
                    <!-- Articulo principal -->
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

                <!-- Boton 'Mas Articulos'' -->
                <div style="text-align: center;" class="p-3">
                    <a href="#" class="bg-red-500 rounded-lg p-3 hover:bg-red-700">Mas Articulos</a>
                </div>
            </div>

            <!-- Footer  -->
            <footer class="container-fluid flex flex-row flex-wrap items-center">
                <div class="p-2 flex justify-center flex-grow sm:flex-1">
                    <img src="Views/img/information.png" alt="" class="w-36">
                </div>
                <div class="p-2 text-center flex-grow sm:flex-1">
                    <h4 class="text-lg pb-2 font-bold">About US</h4>
                    <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nesciunt debitis voluptatibus possimus maxime, voluptates corrupti natus officiis odit!</P>
                </div>
                <div class="p-2 special flex-grow sm:flex-1">
                    <h4 class="text-center text-lg pb-2 font-bold">Siguenos en:</h4>
                    <div class="flex flex-row items-center justify-center gap-2 ">
                        <div id="facebook"><i class="fab fa-facebook-f text-4xl p-3"></i></div>
                        <div id="youtube"><i class="fab fa-youtube text-4xl p-3"></i></div>
                        <div id="reddit"><i class="fab fa-reddit-alien text-4xl p-3"></i></div>
                    </div>
                </div>
                <div class="p-2 flex flex-col special flex-grow sm:flex-1">
                    <h4 class="text-center text-lg pb-2 font-bold">Contactanos</h4>
                    <div class="contact text-center">
                        <ul>
                            <li>320-222-2222</li>
                            <li>emailTest@bepet.com</li>
                            <li>Direccion xx - 22xx</li>
                        </ul>
                    </div>
                </div>
            </footer>          
        </div>
        <!-- Fin Contenido -->
    </div>

<!-- Modal LogIn -->
    <div id="modal"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-gray-900 bg-opacity-50 transform scale-0 transition-transform duration-300">
    <!-- Modal content -->
        <div class="container text-white h-3/4 flex flex-col" style="background: rgba( 19, 19, 19, .8);"> 
            <div class="test w-full h-full flex flex-row items-center justify-center">
                <div class="flex-1" style="margin: 5vw; z-index: 999999;">
                    <h2 class="text-3xl">Log <span class="text-red-500 font-semibold">In</span></h2>
                    <form method="post" autocomplete="off">
                        <div class="flex flex-col gap-2 my-3">
                            <label for="">Nickname</label>
                            <input type="text" name="Log_Nick" class="text-black p-1" required>
                        </div>
                        <div class="flex flex-col gap-2 my-3">
                            <label for="">Password</label>
                            <input type="password" name="Log_Pass" class="text-black p-1" required>
                        </div>
                        <label class="text-xs"><input type="checkbox" name="" id=""> Recordar Datos</label>
                        <div class="grid justify-items-end">
                            <button class="bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-700" type="submit" name="Log_Enter">Enter</button>
                        </div>
                    </form>
                </div>
                <div class="h-full w-1/2 hidden sm:inline md:inline lg:inline xl:inline 2xl:inline" style="background: url('Views/img/php.jpg'); background-size: cover; background-position: center;">
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
</body>
<script> 
    const button = document.getElementById('buttonmodal')
    const closebutton = document.getElementById('closebutton')
    const modal = document.getElementById('modal')

    button.addEventListener('click',()=>modal.classList.add('scale-100'))
    closebutton.addEventListener('click',()=>modal.classList.remove('scale-100'))
</script>
</html>