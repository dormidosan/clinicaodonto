<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Primer Nombre</label>
            <input type="text" class="form-control border-input" name="primer_nombre" placeholder="Primer Nombre" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Segundo Nombre</label>
            <input type="text" class="form-control border-input" name="segundo_nombre" placeholder="Segundo Nombre" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Primer Apellido</label>
            <input type="text" class="form-control border-input" name="primer_apellido" placeholder="Primer Apellido" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Segundo Apellido</label>
            <input type="text" class="form-control border-input" name="segundo_apellido" placeholder="Segundo Apellido" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-1">
        Sexo:
    </div>
    <div class="col-md-5">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo_id" id="exampleRadios1" value="1">
            <label class="form-check-label" for="exampleRadios1">
                Hombre
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo_id" id="exampleRadios2" value="2">
            <label class="form-check-label" for="exampleRadios2">
                Mujer
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Fecha Nacimiento (Mes-Dia-Año)</label>
            <input type="date" id="fecha_nac" name="fecha_nac" class="form-control border-input" min="1960-04-01" max="{{ Date::now()->format('Y-m-d') }}" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="form-group">
            <label>Direccion</label>
            <input type="text" name="direccion" class="form-control border-input" placeholder="Direccion residencial" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Telefono</label>
            <input type="tel" name="telefono" pattern="[0-9]{4}-[0-9]{4}" class="form-control border-input" placeholder="9999-9999">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Correo</label>
            <input type="email" name="email" class="form-control border-input" placeholder='usuario@correo.com' required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Tipo Sanguineo</label>
            <select name="tipo_sanguineo" class="form-control select2custom" >
                <option value="" disabled selected>--selecionar--</option>
                @forelse($tipo_sanguineos as $tipo_sanguineo)
                <option value="{{ $tipo_sanguineo->id }}">{{ $tipo_sanguineo->tipo_nombre }}</option>
                @empty @endforelse
            </select>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>Alergias</label>
            <select name="alergias[]" class="form-control select2custom" multiple >
                @forelse($alergias as $alergia)
                <option value="{{ $alergia->id }}">{{ $alergia->tipo_nombre }}</option>
                @empty @endforelse
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Observaciones</label>
            <textarea name="observacion" class="form-control" id="exampleTextarea" rows="3"></textarea>
        </div>
    </div>
</div>