<!-- Userid Field -->
<div class="col-sm-12">
    {!! Form::label('Userid', 'Userid:') !!}
    <p>{{ $logs->Userid }}</p>
</div>

<!-- Log Field -->
<div class="col-sm-12">
    {!! Form::label('log', 'Log:') !!}
    <p>{{ $logs->log }}</p>
</div>

<!-- Logdetails Field -->
<div class="col-sm-12">
    {!! Form::label('logdetails', 'Logdetails:') !!}
    <p>{{ $logs->logdetails }}</p>
</div>

<!-- Logtype Field -->
<div class="col-sm-12">
    {!! Form::label('logtype', 'Logtype:') !!}
    <p>{{ $logs->logtype }}</p>
</div>

