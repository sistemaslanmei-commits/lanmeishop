
<div>
    
    <div class="container p-2">
        <div class="row carrusel-tienda">
            @foreach ($productos as $producto)
            <div class="col" style="height:360px; display:flex; justify-content:center">
                <div class="card text-center" style="box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25); width:200px; height:350px">
                    <img src="{{ asset('img/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}" style="width: 100%; height: 180px;">
                    <div class="card-body">
                        <div style="width:150px; height: 63px;">
                            <p class="card-title" style="font-family: 'Baloo', sans-serif; font-size:14px">{{ $producto->nombre }}</p>
                        </div>
                        <p class="card-text">Precio: S/.{{ $producto->precio }} </p>
                        
                        <div class="dropdown-center">
                            <a class="btn btn-warning dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Comprar por
                            </a>
                            
                            <ul class="dropdown-menu" style="min-width: 134px ">
                                <div class="d-flex flex-wrap" style="width: 134px">
                                    <a href='{{$producto->enlace}}' target='_blank' class='btn btn-danger' role='button' style='background: #ec4e04'> 
                                        <img src="{{ asset('img/falabella.png') }}" alt='Falabella' class='img-fluid' style='width: 38px; height: 38px;'>
                                    </a>
                                    <a href='{{$producto->enlaceVea}}' target='_blank' class='btn btn-info' role='button' style='background: #04a2ec'>
                                        <img src="{{ asset('img/mp.png') }}" alt='Falabella' class='img-fluid' style='width: 38px; height: 38px;'> 
                                    </a>
                                </div>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    
    <style>
        .left_arrow, .right_arrow{
            position: absolute;
            top: 35%;
            font-size: 25px;
            z-index: 99;
            width: 35px;
            height: 35px;
            background: #1d9481;
            border-radius: 50%;
            color: #ffffff;
            text-align: center;
            padding: 0;
            transition: .3s;
        }
        .left_arrow{
            left: -10px;
        }
        .right_arrow{
            right:-10px;
        }
        .right_arrow:hover, .left_arrow:hover{
            background: #187c6b;
            color: #ffffff;
            width: 37px;
            height: 37px;
            top: 34%;
        }
        
    </style>

    <script>
    $(document).ready(function(){
        $('.carrusel-tienda').slick({
            dots: false,
            infinite: true,
            autoplay: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            prevArrow: '<i class="bi bi-caret-left-fill left_arrow"></i>',
            nextArrow: '<i class="bi bi-caret-right-fill right_arrow"></i>',
            responsive: [
                {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
                },
                {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
                },
                {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
    </script>
</div>