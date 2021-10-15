{{--  <div class="form-row">
    <div class="form-group col-md-6">
      
    </div>
    <div class="form-group col-md-4">
       
    </div>
    <div class="form-group col-md-2">
        
    </div>
</div>  --}}
<div class="form-row">
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="names">Nombres</label>
            <input type="text" class="form-control" name="names" id="names" aria-describedby="helpId" required>
        </div>
    </div>

    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="names">Apellidos</label>
            <input type="text" class="form-control" name="lastname" id="lastnames" aria-describedby="helpId" required>
        </div>
    </div>

    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId">
            <!-- <small id="helpId" class="form-text text-muted">Este campo es opcional.</small> -->
        </div>
    </div>
    
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="cedula">Cedula</label>
            <input type="text" class="form-control" name="cedula" id="cedula" aria-describedby="helpId" required>
        </div>
    </div>
   
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="phone">Teléfono \ Celular</label>
            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId">
            <!-- <small id="helpId" class="form-text text-muted">Este campo es opcional.</small> -->
        </div>
    </div>
</div>
<div class="form-group">
    <label for="address">Dirección</label>
    <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId">
    <!-- <small id="helpId" class="form-text text-muted">Este campo es opcional.</small> -->
</div>

<div class="form-row">
    <div class="form-group col-md-4">

        
        <div class="form-group">
            <label for="cedula">Selecionar cliente</label>
            <select name="referido" id="referido" class="selectpicker" data-live-search="true">
                @foreach($clients as $client)
                    <option  value="{{$client->id}}">{{ $client->full_name}}</option>
                @endforeach
            </select>
            <!-- <input type="text" class="form-control" name="cedula" id="cedula" aria-describedby="helpId" required> -->
        </div>
    </div>
   
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="points">Puntos</label>
            <input type="text" class="form-control" name="points" id="points" aria-describedby="helpId">
            <!-- <small id="helpId" class="form-text text-muted">Este campo es opcional.</small> -->
        </div>
    </div>
</div>