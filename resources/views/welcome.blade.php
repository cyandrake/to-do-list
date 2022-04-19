<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>To Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<link rel="stylesheet" href="{{ asset('gallery/css/bootstrap.min.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('gallery/fontawesome-free/css/all.min.css') }}"> -->

<link rel="stylesheet" href="{{ asset('gallery/css/templatemo-style.css') }}">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<!-- <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script> -->
<!-- <link rel="stylesheet" href="{{ asset('gallery/fontawesome/css/all.min.css') }}"> -->

<!-- Dropzone -->
<link rel="stylesheet" href="{{ asset('gallery/dropzone/min/dropzone.min.css') }}">

</head>

<div id="app">
  <to-do-list />
</div>
<!-- dropzone -->
<script src="{{ asset('gallery/dropzone/min/dropzone.min.js') }}"></script>

<script src="{{ mix('/js/app.js') }}"></script>
<script src="{{ asset('gallery/js/plugins.js') }}"></script>


<script>
    $(window).on("load", function() {
        $('body').addClass('loaded');
    });
</script>