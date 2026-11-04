<div>
    <style>
        .header{
    background-color: #0B3E5C;
    width: 100%;
    
}

/* Estilos generales del navbar */
.header .navbar{
    background-color: #0B3E5C;
    width: 100%;
    align-content: stretch;

    
}
.header .navbar .navbar-nav{
    justify-content: space-around;
}
.header .bi-whatsapp{
    color: #00FF1A;
    font-size: 24px;
}
.header .bi-facebook{
    color: #328CC1;
    font-size: 24px;
}
.header .bi-instagram{
    padding: 4px;
    color: #8E04D9;
    font-size: 24px;
}
.header .bi-tiktok {
    background-color: transparent;
    color: #000; /* Cambiado a negro para que se distinga sobre fondo claro */
    border: 2px solid #000; /* Borde de color negro */
    padding: 0 5px;
    border-radius: 10px;
    font-size: 18px;
    
    display: inline-block;
}
.titleCon {
    font-family: 'Baloo', sans-serif;
    color: #D9B40F;
    font-size: 36px;
    text-decoration: none;
    margin: 0;
}
a.navbar-brand.titleCon:hover {
  color: #EDFF24;
  ; /* Color que se mantendrá al pasar el mouse o cuando el enlace ha sido visitado */
}

.header .nav-link{
    font-family: 'inder', sans-serif;
    color: white;
}
.nav-item.active a {
    color: yellow; /* Cambiar el color del texto cuando el enlace está activo */
    font-weight: bold;
}

.menuSmall .btn-menu-f{
    order: 1;
    width: 164px;
}
.menuSmall .tituloSmall{
    order: 2;
    width: 100%;
}
.menuSmall .iconsSmall{
    order: 3;
    width: 130px;
}

@media (max-width: 320px) {
    .menuSmall{      
        flex-direction: column;
        height: auto !important;
    }
    .menuSmall .btn-menu-f{
        display: flex;
        justify-content: center;
        order: 2;
    }
    .menuSmall .tituloSmall{
        order: 1;
    }
    .menuSmall .iconsSmall{
        order: 3;
    }

}

a {
        text-decoration: none; /* Quita el subrayado */
}
    </style>


<div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container w-100" >
            <div class="d-flex d-none d-lg-block p-2 gap-2" style="opacity:0; min-width:97px;">
                <i class="bi bi-whatsapp whatsappButton" ></i>
                <a href="https://www.facebook.com/profile.php?id=61590498130919" target="_blank">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.instagram.com/lanmei.web/" target="_blank">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.tiktok.com/@lanmei.pe" target="_blank">
                    <i class="bi bi-tiktok"></i>
                </a>
            </div>
            <div class="d-flex align-items-center d-lg-none w-100 menuSmall" style="height: 54px">
                <div class=" btn-menu-f">
                    <button class="navbar-toggler btn-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </div>
                <div class="navbar-brand d-lg-none d-flex flex-row w-100 m-0 tituloSmall">
                    <div class="p-2 flex-grow-1 justify-content-center text-center titleCon">
                        <a class="titleCon" href="https://lanmei.com.pe/">LANMEI</a></div>
                </div>
                <div class="d-flex p-2 gap-2 align-items-center iconsSmall">
                    <i class="bi bi-whatsapp whatsappButton" data-message="Hola, quiero mas informacion general"></i>
                    <a href="https://www.facebook.com/profile.php?id=61590498130919" target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/lanmei.web/" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/@lanmei.pe" target="_blank">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>      
            </div>
          
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav d-flex align-items-center gap-4">
                    <li class="nav-item">
                        <a class="nav-link" href="https://lanmei.com.pe/nosotros/">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://lanmei.com.pe/servicios/" id="servicio-header">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://lanmei.com.pe/clientes/">Clientes</a>
                    </li>
                    <div class="d-none d-lg-block titleConc">
                        <a class="navbar-brand titleCon" href="https://lanmei.com.pe/">LANMEI</a>
                    </div>
                    <li class="nav-item active">
                        <a class="nav-link" href="/" style="white-space: nowrap;">Tienda Virtual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://lanmei.com.pe/contacto/">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://blog.lanmei.com.pe/">Blog</a>
                    </li>
                </ul>
            </div>
          <div class="d-flex d-none d-lg-block p-2 gap-2" style="min-width:97px;">
              <i class="bi bi-whatsapp whatsappButton" data-message="Hola, quiero mas informacion general"></i>
              <a href="https://www.facebook.com/profile.php?id=61590498130919" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://www.instagram.com/lanmei.web/" target="_blank">
                <i class="bi bi-instagram"></i>
            </a>

            <a href="https://www.tiktok.com/@lanmei.pe" target="_blank">
                <i class="bi bi-tiktok"></i>
            </a>
          </div>
          
        </div>
    </nav>
</div>

</div>
