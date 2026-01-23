{{--Meta--}}
<title>@yield('title', config('app.name'))</title>
<meta name="description"
      content="@yield('description', 'Log your poos, track your throne time, and uncover patterns in your personal poo history.')"/>
<meta property="og:image" content="@yield('og-image', url('assets/images/core/ogimage.jpg'))">
<meta property="og:title" content="@yield('og-title', 'PooTally – Log Your Poos')">
<meta name="keywords"
      content="@yield('keywords', 'Poo')"/>
