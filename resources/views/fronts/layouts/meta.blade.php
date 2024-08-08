<title>@yield('meta_title', get_setting('meta_title'))</title>
<meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords'))" />
<meta name="description" content="@yield('meta_description', get_setting('meta_description'))" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">

