@extends('layout')

@section('content')
<div class="container my-5">
    <h1>Libro de Reclamaciones</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reclamaciones.store') }}" method="POST">
        @csrf

        <!-- Tipo de Documento -->
        <div class="form-group">
            <label for="tipo_documento">Tipo de Documento:</label>
            <select class="form-control" id="tipo_documento" name="tipo_documento" required>
                <option value="" disabled selected>Selecciona un tipo</option>
                <option value="dni" {{ old('tipo_documento') == 'dni' ? 'selected' : '' }}>DNI</option>
                <option value="carnet_extranjeria" {{ old('tipo_documento') == 'carnet_extranjeria' ? 'selected' : '' }}>Carnet de Extranjería</option>
            </select>
        </div>

        <!-- Número de Documento -->
        <div class="form-group">
            <label for="numero_documento">Número de Documento:</label>
            <input type="text" class="form-control" id="numero_documento" name="numero_documento"
                value="{{ old('numero_documento') }}" required pattern="[0-9]{8,}" title="Debe tener 8 dígitos si es DNI y al menos 8 si es Carnet de Extranjería"
                inputmode="numeric" oninput="this.value = this.value.replace(/\D+/g, '')">
            @error('numero_documento')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Nombre Completo -->
        <div class="form-group">
            <label for="nombre_completo">Nombre Completo:</label>
            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo"
                value="{{ old('nombre_completo') }}" required pattern="^[a-zA-Z\s]+$" title="Solo letras y espacios">
            @error('nombre_completo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Correo Electrónico -->
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico:</label>
            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico"
                value="{{ old('correo_electronico') }}" required>
            @error('correo_electronico')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono"
                value="{{ old('telefono') }}" required pattern="[0-9]{9}" title="Debe tener 9 dígitos"
                inputmode="numeric" oninput="this.value = this.value.replace(/\D+/g, '')">
            @error('telefono')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Reclamo -->
        <!-- Tipo de Reclamo -->
        <div class="form-group">
            <label for="tipo_reclamo">Tipo de Reclamo:</label>
            <select class="form-control" id="tipo_reclamo" name="tipo_reclamo" required>
                <option value="" disabled selected>Selecciona un tipo</option>
                <option value="Reclamación" {{ old('tipo_reclamo') == 'Reclamación' ? 'selected' : '' }}>Reclamación</option>
                <option value="Queja" {{ old('tipo_reclamo') == 'Queja' ? 'selected' : '' }}>Queja</option>
            </select>
        </div>
        <!--CONTENIDO DEL RECLAMO-->
        <div class="form-group">
            <label for="reclamo">Reclamo:</label>
            <textarea class="form-control" id="reclamo" name="reclamo" rows="5" required>{{ old('reclamo') }}</textarea>
            @error('reclamo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <br>

        <p>
            <strong>(1) Reclamación: </strong>Desacuerdo relacionado con productos y / o servicios. <br>
            <strong>(2) Queja: </strong>Desacuerdo no relacionado con productos y / o servicios; o, malestar o insatisfacción con la atención al público.
        </p>

        <br>
        <div name="validaciones del reclamo">
            <div class="column-two">
                <input type="checkbox" name="acepto" value="1" {{ old('acepto') ? 'checked' : '' }} required>
                Declaro que soy el dueño del servicio y acepto el contenido de este formulario al declarar bajo Declaración Jurada la veracidad de los hechos descritos.
                @error('acepto')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        
            <div class="column-two" style="font-size:10px">

                <br>
                <p>
                    <b class="alert">*</b> La formulación del reclamo no excluye el recurso a otros medios de resolución de controversias ni es un requisito previo para presentar una denuncia ante el Indecopi. <br>
                    <b class="alert">*</b> El proveedor debe responder a la reclamación en un plazo no superior a quince (15) días naturales, pudiendo ampliar el plazo hasta quince días.<br>
                    <b class="alert">*</b> Con la firma de este documento, el cliente autoriza a ser contactado después de la tramitación de la reclamación para evaluar la calidad y satisfacción del proceso de atención de reclamaciones. 
                </p>

                <br>
                
            </div>
        
            <div class="column-full">
                <input type="checkbox" name="politica" value="1" {{ old('politica') ? 'checked' : '' }} required>
                <a href="#" target="_black">He leído y acepto la Política de privacidad y seguridad y la Política de cookies.</a>
                @error('politica')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <br> 
        <button type="submit" class="btn btn-primary">Enviar Reclamo</button>
    </form>

    
</div>
@endsection

<script>
    // Validar que no se ingresen números negativos
    function checkNumberInput(input) {
        input.value = input.value.replace(/[^0-9]/g, ''); // Elimina cualquier carácter que no sea un número
    }
</script>