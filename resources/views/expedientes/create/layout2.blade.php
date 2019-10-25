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
<div class="row">

</div>