<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $web_name ?? '-' }}</title>
    <meta name="keywords" content="{{ $keyword ?? '-' }}">
    <meta name="description" content="{{ $description ?? '-' }}" />

        <!-- 开发环境使用Vite加载 -->
        @vite(['resources/js/app.js', 'resources/js/plugins/css/base.scss'])
        <!-- 生产环境使用CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/element-plus@2.3.12/dist/index.css" />
        <script src="https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-router@4.2.4/dist/vue-router.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vuex@4.1.0/dist/vuex.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/element-plus@2.3.12/dist/index.full.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/dayjs@1.11.9/dayjs.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/qrcode.vue@3.3.3/dist/qrcode.vue.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@antv/g2plot@2.4.20/dist/g2plot.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@amap/amap-jsapi-loader@1.0.1/dist/index.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/@wangeditor/editor@5.1.23/dist/css/style.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@wangeditor/editor@5.1.23/dist/index.min.js"></script>

        <link href="{{ asset('dist/css/base.css') }}" rel="stylesheet" />

</head>

<body>
<div id="app">
    <app></app>
</div>

        @vite('resources/js/app.js')
    </body>
</html>
