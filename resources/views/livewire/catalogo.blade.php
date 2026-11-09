<div>
    <style>
        .product-card {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            transition: all 0.2s ease-in-out;
            background-color: #ffffff;
            border: 1px solid #eef2f5;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
        }
        .category-item.active {
            background-color: #328CC1 !important;
            color: white !important;
            font-weight: bold;
        }
        .category-scroll-list::-webkit-scrollbar {
            width: 5px;
        }
        .category-scroll-list::-webkit-scrollbar-thumb {
            background-color: #328CC1;
            border-radius: 4px;
        }
        .horizontal-category-bar {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            gap: 8px;
            padding-bottom: 8px;
            scroll-behavior: smooth;
        }
        .horizontal-category-bar::-webkit-scrollbar {
            height: 4px;
        }
        .horizontal-category-bar::-webkit-scrollbar-thumb {
            background-color: #328CC1;
            border-radius: 4px;
        }

        /* Paginación Adaptativa (PC y Móvil) */
        .pagination-container {
            display: flex;
            justify-content: center;
            overflow-x: auto;
            padding: 10px 0;
        }
        .pagination {
            flex-wrap: wrap;
            justify-content: center;
            gap: 4px;
            margin-bottom: 0;
        }
        .pagination .page-item .page-link {
            color: #0B3E5C;
            border-radius: 6px !important;
            padding: 6px 12px;
            font-size: 14px;
            border: 1px solid #dee2e6;
        }
        .pagination .page-item.active .page-link {
            background-color: #328CC1 !important;
            border-color: #328CC1 !important;
            color: #ffffff !important;
            font-weight: bold;
        }
        @media (max-width: 576px) {
            .pagination .page-item .page-link {
                padding: 4px 8px;
                font-size: 12px;
            }
            .pagination .page-item:not(.active):not(:first-child):not(:last-child):not(:nth-child(2)):not(:nth-last-child(2)) {
                display: none;
            }
        }
    </style>

    <!-- Encabezado Principal -->
    <div class="d-flex justify-content-center align-items-center text-center py-3 px-2" style="background-color: #0B3E5C;">
        <h1 class="m-0 text-white fw-bold" style="font-family: 'Baloo', sans-serif; font-size: clamp(22px, 4vw, 32px);">
            Catálogo de Productos
        </h1>
    </div>
    
    <!-- Contenedor Principal Responsive -->
    <div class="container-fluid px-2 px-md-4 py-3">
        <div class="row g-3">
            
            <!-- BARRA LATERAL: Categorías en PC / Tablet -->
            <div class="col-12 col-md-3 col-lg-2 d-none d-md-block">
                <div class="card border-0 shadow-sm sticky-top" style="top: 15px; z-index: 10; border-top: 3px solid #328CC1 !important;">
                    <div class="card-header bg-white py-2 px-3 fw-bold text-dark border-bottom d-flex justify-content-between align-items-center">
                        <span>📂 Categorías</span>
                        <span class="badge bg-primary rounded-pill small">{{ $categorias->count() }}</span>
                    </div>
                    
                    <div class="card-body p-2">
                        <div class="mb-2">
                            <input type="text" 
                                   id="searchCatInput" 
                                   class="form-control form-control-sm" 
                                   placeholder="🔍 Filtrar categoría..." 
                                   onkeyup="filtrarCategoriasSidebar()">
                        </div>

                        <div id="catListGroup" class="list-group list-group-flush category-scroll-list" style="max-height: 380px; overflow-y: auto;">
                            <button wire:click="seleccionarCategoria(null)" 
                                    class="list-group-item list-group-item-action py-2 px-2 small border-0 rounded mb-1 category-item {{ is_null($categoria_id) ? 'active' : 'text-dark' }}">
                                🌐 Todas las Categorías
                            </button>

                            @foreach ($categorias as $cat)
                                <button wire:click="seleccionarCategoria({{ $cat->id }})" 
                                        class="list-group-item list-group-item-action py-2 px-2 small border-0 rounded mb-1 cat-sidebar-item category-item {{ $categoria_id == $cat->id ? 'active' : 'text-dark' }}">
                                    {{ $cat->nombreCategoria }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENIDO PRINCIPAL -->
            <div class="col-12 col-md-9 col-lg-10">
                
                <!-- Categorías Móvil -->
                <div class="d-md-none mb-3">
                    <button class="btn btn-outline-primary btn-sm w-100 fw-bold mb-2 d-flex justify-content-between align-items-center px-3" 
                            type="button" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#offcanvasCategorias">
                        <span>📂 Ver todas las categorías</span>
                        <span class="badge bg-primary">{{ $categoriaSeleccionada ? $categoriaSeleccionada->nombreCategoria : 'Todas' }}</span>
                    </button>

                    <div class="horizontal-category-bar">
                        <button wire:click="seleccionarCategoria(null)" 
                                class="btn btn-sm rounded-pill px-3 {{ is_null($categoria_id) ? 'btn-primary' : 'btn-outline-secondary bg-white text-dark' }}">
                            Todas
                        </button>
                        @foreach ($categorias as $cat)
                            <button wire:click="seleccionarCategoria({{ $cat->id }})" 
                                    class="btn btn-sm rounded-pill px-3 {{ $categoria_id == $cat->id ? 'btn-primary' : 'btn-outline-secondary bg-white text-dark' }}">
                                {{ $cat->nombreCategoria }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Barra Superior de Filtros y Búsqueda -->
                <div class="d-flex flex-wrap justify-content-between align-items-center p-3 mb-3 bg-white rounded shadow-sm border">
                    <h2 class="m-0 fw-bold text-truncate" style="font-family: 'inder', sans-serif; font-size: clamp(18px, 3vw, 22px); color: #0B3E5C; max-width: 60%;">
                        {{ $categoriaSeleccionada ? $categoriaSeleccionada->nombreCategoria : 'Todos los Productos' }}
                        <span class="badge bg-secondary fs-6 ms-2 align-middle">{{ $productos->total() }}</span>
                    </h2>

                    <div class="mt-2 mt-sm-0 w-100 w-sm-auto" style="min-width: 240px; max-width: 320px;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0">🔍</span>
                            <input type="text" 
                                   wire:model.live.debounce.300ms="search" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Buscar por nombre...">
                        </div>
                    </div>
                </div>

                <!-- Grid de Productos -->
                @if($productos->count() > 0)
                    <div class="row g-2 g-md-3 justify-content-center justify-content-sm-start">
                        @foreach ($productos as $producto)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                                <div class="card product-card w-100 text-center d-flex flex-column justify-content-between p-2">
                                    
                                    @php
                                        $url = trim($producto->imagen ?? '');
                                        if (empty($url) || str_contains($url, 'blanco.jpg')) {
                                            $imgSrc = asset('img/no-image.png');
                                        } else {
                                            $imgSrc = str_starts_with($url, 'http') 
                                                ? $url 
                                                : asset('img/' . $url);
                                        }
                                    @endphp
                                    
                                    <div class="d-flex align-items-center justify-content-center bg-white rounded p-1 p-md-2" style="height: 160px; width: 100%;">
                                        <img src="{{ $imgSrc }}" 
                                             class="card-img-top img-fluid" 
                                             alt="{{ $producto->nombre }}" 
                                             onerror="this.onerror=null; this.src='https://via.placeholder.com/200x180?text=Sin+Imagen';"
                                             style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                    </div>
                                    
                                    <div class="card-body d-flex flex-column justify-content-between p-1 p-md-2">
                                        <div style="min-height: 40px; max-height: 52px; overflow: hidden;" class="mb-2">
                                            <h5 class="card-title text-dark small fw-bold m-0" style="font-family: 'Baloo', sans-serif; line-height: 1.2; font-size: clamp(12px, 2.5vw, 14px);">
                                                {{ $producto->nombre }} 
                                            </h5>
                                            <!-- Opción B: Mostrar N/A en caso de que sea un producto local sin SKU -->
                                            <small class="text-muted d-block mt-1" style="font-size: 11px; font-weight: 600;">
                                                SKU: {{ $producto->sku ?? 'N/A' }}
                                            </small>
                                            
                                        </div>

                                        <p class="card-text fw-bold mb-2" style="font-size: clamp(14px, 3vw, 16px); color: #0B3E5C;">
                                            S/.{{ number_format($producto->precio ?? 0, 2) }}
                                        </p>

                                        @if(!empty($producto->enlaceVea))
                                            <div class="dropdown-center w-100">
                                                <button class="btn btn-warning btn-sm w-100 dropdown-toggle fw-bold py-1 px-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                                                    Comprar por
                                                </button>
                                                <ul class="dropdown-menu text-center p-2 shadow-sm" style="min-width: 100%;">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ $producto->enlace }}" target="_blank" class="btn btn-danger btn-sm p-1" style="background: #ec4e04; border:none;"> 
                                                            <img src="{{ asset('img/falabella.png') }}" alt="Falabella" style="width: 28px; height: 28px;">
                                                        </a>
                                                        <a href="{{ $producto->enlaceVea }}" target="_blank" class="btn btn-info btn-sm p-1" style="background: #04a2ec; border:none;">
                                                            <img src="{{ asset('img/mp.png') }}" alt="Plaza Vea" style="width: 28px; height: 28px;"> 
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                        @else
                                            <a href="{{ $producto->enlace ?? '#' }}" target="_blank" class="btn btn-success btn-sm w-100 fw-bold py-1 px-2" style="background-color: #25D366; border: none; font-size: 12px;">
                                                WhatsApp
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Enlaces de Paginación Responsive -->
                    <div class="pagination-container mt-4">
                        <div class="w-100 d-flex justify-content-center overflow-auto px-2">
                            {{ $productos->links() }}
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center my-4 py-4 rounded shadow-sm">
                        No se encontraron productos coincidentes con esta categoría o término de búsqueda.
                    </div>
                @endif

            </div>

        </div>
    </div>

    <!-- PANEL FLOTANTE (Offcanvas) Móvil -->
    <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="offcanvasCategorias" aria-labelledby="offcanvasCategoriasLabel">
        <div class="offcanvas-header" style="background-color: #0B3E5C; color: white;">
            <h5 class="offcanvas-title fw-bold" id="offcanvasCategoriasLabel">Categorías</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-2">
            <div class="list-group list-group-flush">
                <button wire:click="seleccionarCategoria(null)" 
                        data-bs-dismiss="offcanvas" 
                        class="list-group-item list-group-item-action py-2 border-0 fw-bold {{ is_null($categoria_id) ? 'text-primary' : 'text-dark' }}">
                    🌐 Todas las Categorías
                </button>
                @foreach ($categorias as $cat)
                    <button wire:click="seleccionarCategoria({{ $cat->id }})" 
                            data-bs-dismiss="offcanvas" 
                            class="list-group-item list-group-item-action py-2 border-0 {{ $categoria_id == $cat->id ? 'text-primary fw-bold' : 'text-dark' }}">
                        {{ $cat->nombreCategoria }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
function filtrarCategoriasSidebar() {
    let input = document.getElementById('searchCatInput').value.toLowerCase();
    let items = document.querySelectorAll('#catListGroup .cat-sidebar-item');

    items.forEach(item => {
        let text = item.textContent.toLowerCase();
        item.style.display = text.includes(input) ? 'block' : 'none';
    });
}
</script>