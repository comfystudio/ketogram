@if(session('status'))
    <div class="success">
        <ul>
            <li>{{ session('status') }}</li>
         </ul>
    </div>
@endif