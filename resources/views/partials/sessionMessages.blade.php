<div class="alert alert-danger center-block offset" {{!Session::has('error') ? 'hidden' : ''}}>
    {{Session::get('error')}}
</div>
<div class="alert alert-success center-block offset"{{!Session::has('success') ? 'hidden' : ''}}>
    {{Session::get('success')}}
</div>