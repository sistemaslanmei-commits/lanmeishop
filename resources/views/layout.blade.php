<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:site_name" content="LANMEI" />
    <link rel="canonical" href="https://shop.lanmei.com.pe/" />
    <title>LANMEI - tecnologia que destaca</title>
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "LANMEI",
        "alternateName": "LANMEI Shop",
        "url": "https://shop.lanmei.com.pe/"
      }
    </script>

    <!--iconos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Agrega estos enlaces en el encabezado de tu HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inder|Inter|Baloo&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@800&display=swap" rel="stylesheet">



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
 

</head>
<body>
  <style>
        body {
          display: flex;
          flex-direction: column;
          min-height: 100vh;
        }

        .btn-back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;

        }
    </style>
    <livewire:header />
    <a href="#" class="btn btn-secondary btn-back-to-top" role="button">
      <i class="bi bi-arrow-up-circle"></i> Volver Arriba
    </a>

    @yield('content') <!-- Aquí se muestra el contenido de cada página individual -->
    
    <livewire:footer />

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Incluye la librería JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
  

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>



    <script>
    var whatsappButtons = document.querySelectorAll('.whatsappButton');
    
      whatsappButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          var phoneNumber = '+51905467384'; // Número de teléfono personalizado
          //var message = 'Acabo de visitar su página y quiero hacerle una consulta por favor'; // Mensaje personalizado

          var message = this.getAttribute('data-message');
          console.log(message)

          // Codificar el número de teléfono y el mensaje para usar en el enlace
          var encodedPhoneNumber = encodeURIComponent(phoneNumber);
          var encodedMessage = encodeURIComponent(message);

          // Construir el enlace con los parámetros personalizados
          var whatsappLink = 'https://api.whatsapp.com/send?phone=' + encodedPhoneNumber + '&text=' + encodedMessage;
    
          // Abrir la página de WhatsApp en una nueva ventana
          window.open(whatsappLink);
        });
      });

  </script>


    
    <!-- Script para el comportamiento del botón -->
    <script>
      $(document).ready(function() {
          // Al hacer clic en el botón, anima el desplazamiento suavemente al inicio de la página
          $(".btn-back-to-top").click(function() {
              $("html, body").animate({ scrollTop: 0 }, "normal");
              return false;
          });

          // Muestra u oculta el botón basado en la posición de desplazamiento
          $(window).scroll(function() {
              if ($(this).scrollTop() > 200) {
                  $(".btn-back-to-top").fadeIn();
              } else {
                  $(".btn-back-to-top").fadeOut();
              }
          });
      });
  </script>
</body>
</html>