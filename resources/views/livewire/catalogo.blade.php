<div>
    <style>
        .accordion-button:not(.collapsed){
            background-color: white
        }

    </style>
    <div class="d-flex justify-content-center align-items-center text-center" style="background-color: #0B3E5C; height: 124px ">
        <p style="font-family: 'Baloo', sans-serif; font-size:32px; color:white;">catalogo de productos</p>
    </div>
    
    <div class="d-flex">
        <div style="width: 315px; height: 1280px; background-color: #CFCFCF;">
            <div class="accordion" id="accordionExample" >
                <div class="accordion-item" >
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color:#fffff; border-radius: 0; border-top: 3px solid #328CC1; border-bottom: 3px solid #328CC1;">
                      -- Selecciona la categoria
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body" style="border: 1px solid #328CC1">
                        @foreach ($categorias as $index => $categoria)
                        <a href="#{{ $categoria->id }}" class="d-block mb-3" 
                        style="color: #333; text-decoration: none;">{{ $categoria->nombreCategoria }}</a>
                        @endforeach
                    </div>

                  </div>

                </div>

            </div>
        </div>
        
        
        <div class="w-100">
            @foreach ($categorias as $index => $categoria)
            
                <div class="conteiner" style="background-color: {{ $index % 2 === 0 ? '#e7e7e7' : 'white' }}; padding:0px" id="{{$categoria->id}}">
                    <p class="mb-3 text-center" style="font-family: 'inder', sans-serif; font-size: 32px;">{{ $categoria->nombreCategoria }}</p>
                    <div class="row w-100 justify-content-around">
                        @foreach ($categoria->productos as $producto)
                        <div class="col-lg-3 col-md-4 mb-3 col-sm-12 d-flex justify-content-center ">
                         
                            <div class="card text-center" style="box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25); min-width:200px; height:350px">
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
            

            @endforeach
        </div>

    </div>
</div>
