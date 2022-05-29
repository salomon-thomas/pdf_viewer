@if ($message = Session::get('success'))
<div id="toast-container" aria-live="polite" class="toast-top-right alert alert-block">
    <div class="toast toast-success" aria-live="polite" style="display: block;">
        <div class="toast-message">
            {{ $message }}
        </div>
    </div>
</div>
{{session()->forget('success')}}
@endif

@if($messages = Session::get('error'))
<div id="toast-container" aria-live="polite" class="toast-top-right alert alert-block">
    <div class="toast toast-error" aria-live="polite" style="display: block;">
        <div class="toast-message">
            @if(is_array($messages))
            <ul>
                @foreach($messages as $message)
                <li><strong>{{ $message }}</strong></li>
                @endforeach
            </ul>
            @else
            <strong>{{ $messages }}</strong>
            @endif
        </div>
    </div>
</div>
{{session()->forget('error')}}
@endif

@if ($errors->any())
<div id="toast-container" aria-live="polite" class="toast-top-right alert alert-block">
    <div class="toast toast-error" aria-live="polite" style="display: block;">
        <div class="toast-message">
            @if(is_array($errors))
            <ul>
                @foreach($errors->all() as $message)
                <li>
                    <p class="mb-0">{{ $message }}</p>
                </li>
                @endforeach
            </ul>
            @else
            <p class="mb-0">{{ $errors }}</p>
            @endif
        </div>
    </div>
</div>
@endif