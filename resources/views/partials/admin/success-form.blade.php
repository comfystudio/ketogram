@if(session('status'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><strong>Success</strong></h4>
        <ul>
            <li>{{ session('status') }}</li>
        </ul>
    </div>
@endif