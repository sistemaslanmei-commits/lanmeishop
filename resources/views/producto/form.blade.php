<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group pb-2">
                    {{ Form::label('nombre') }}
                    {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group pb-2">
                    {{ Form::label('precio') }}
                    {{ Form::number('precio', $producto->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio','step' => '0.01', 'min' => '1']) }}
                    {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group pb-2">
                    {{ Form::label('stock') }}
                    {{ Form::number('stock', $producto->stock, ['class' => 'form-control' . ($errors->has('stock') ? ' is-invalid' : ''), 'placeholder' => 'Stock', 'step' => '1']) }}
                    {!! $errors->first('stock', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group pb-2">
                    {{ Form::label('enlace Falabella') }}
                    {{ Form::text('enlace', $producto->enlace, ['class' => 'form-control' . ($errors->has('enlace') ? ' is-invalid' : ''), 'placeholder' => 'enlace Falabella']) }}
                    {!! $errors->first('enlace', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group pb-2">
                    {{ Form::label('enlace Plaza Vea') }}
                    {{ Form::text('enlaceVea', $producto->enlaceVea, ['class' => 'form-control' . ($errors->has('enlaceVea') ? ' is-invalid' : ''), 'placeholder' => 'enlace Plaza Vea']) }}
                    {!! $errors->first('enlaceVea', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group pb-2">
                    {{ Form::label('categoria_id', 'Categoría') }}
                    {{ Form::select('categoria_id', $categorias, $producto->categoria_id, ['class' => 'form-control' . ($errors->has('categoria_id') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('categoria_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group pb-2">
                    {{ Form::label('imagen') }} <br>
                    {{ Form::file('imagen', [
                        'class' => 'form-control-file' . ($errors->has('imagen') ? ' is-invalid' : ''), 
                        'accept' => 'image/*', 
                        'id' => 'imagenInput'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    @if ($producto->imagen)
                    <img id="imagenPreview" src="{{ asset('img/' . $producto->imagen) }}" alt="Vista Previa" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                    @else
                    <img id="imagenPreview" src="#" alt="Vista Previa" class="img-thumbnail" style="display: none; max-width: 300px; max-height: 300px;">
                    @endif
                </div>
                <div class="text-center"><i>imagen previa </i> </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">
            {{ $producto->id ? __('Editar') : __('Crear') }}
        </button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#imagenInput').on('change', function(event) {
                const imagenPreview = $('#imagenPreview')[0];
                const imagenInput = event.target;

                if (imagenInput.files && imagenInput.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        $(imagenPreview).attr('src', e.target.result).show();
                    };

                    reader.readAsDataURL(imagenInput.files[0]);
                }
            });
        });
    </script>
</div>
