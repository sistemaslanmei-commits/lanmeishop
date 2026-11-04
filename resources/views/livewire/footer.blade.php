<div>
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <div class="footer">
        <div class="detalle-footer">
            <div class="texto-footer-d">
                <div class="linea-footer"></div>
                <div class="title-tf">
                    <h2>LANMEI</h2></div>
                        
                <span>Somos una empresa de Perú especialistas en diseño web responsive, en desarrollar paginas 
                    web amigables con el usuario, además de ofrecer otros servicios de paginas web y mantenimiento de articulos tecnologicos</span>
            </div>
            <div class="contacto-footer-d">
                <div class="iconsfooter">
                    <i class="bi bi-telephone whatsappButton"></i>
                    <i class="bi bi-envelope"></i>
                </div>
                <div class="title-cf">Contactanos</div>
                <div class="det-cf">
                    <div class="d-flex">
                        <span>Telefono: </span>
                        <span class="whatsappButton" data-message="Hola, quiero conocer mas de la pagina web"> +51 905 467 384</span>
                    </div>
                    <span>sistemas@lanmei.com.pe</span>
                </div>
            </div>
            <div class="horario-footer-d">
                <div class="title-hf">Horario de atención</div>
                <div class="det-hf">
                    <div class="d-flex">
                        <span>Lunes-Viernes :</span>
                        <span> 9am - 6pm</span>
                    </div>
                    <div class="d-flex">
                        <a href="{{ url('/libro-de-reclamaciones') }}" class="reclamaciones-link">
                            <img src="{{ asset('img/libro_reclamaciones.png') }}" alt="Libro de Reclamaciones" style="width: 150px;margin-top: 4px;margin-right: -150px; border-radius: 15px;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-footer">
            <span>Copyright © {{ now()->year }} LANMEI Perú</span>            
            
        </div>
</div>

</div>
