<!-- to define variable and default variable to pass to components-->
@props([
'name',
'value' => '',
'label' => false,
'placeholder' => false,
])

<!-- {{$attributes}} to echo any un except attribute insert into input -->
<!-- {{$attributes}} to allow insert attributes into input  -->
<div>
    @if($label)
    <label> {{$label}}</label>
    @endif
    <textarea name="{{$name}}" {{$attributes->class(['form-control' , 'is-invalid' => $errors->has($name)])}}> {{ old($name , $value ) }} </textarea>
    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>