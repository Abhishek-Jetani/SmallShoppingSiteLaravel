@extends('layouts.app')

@section('content')

<script>
    // Redirect to home and open register tab in auth modal
    window.location.replace('/?openAuth=register');
</script>
<noscript>
    <meta http-equiv="refresh" content="0;url=/?openAuth=register">
</noscript>

@endsection
