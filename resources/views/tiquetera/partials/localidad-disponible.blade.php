<div class="form-group">
    <label class="mdb-main-label" for="cantidad" >Cantidad</label>
    <select  class="mdb-select md-form colorful-select dropdown-primary" id="cantidad"
        name="cantidad">
        <option value=""  selected>Seleccionar</option> 
    
        @if($localDis->disponibles >= 8)
            @for ($i = 1; $i <=8; $i++)
                <option value="{{$i }}">{{ $i }}</option>
            @endfor
        
            
        @else
            @for ($i = 1; $i <= $localDis->disponibles; $i++)
                <option value="{{$i }}">{{ $i }}</option>
            @endfor

        @endif
    </select>
    <div class="error" id="error-cantidad"></div>
</div>