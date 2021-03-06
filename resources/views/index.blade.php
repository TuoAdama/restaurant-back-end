@extends('layouts.base', ['title' => 'Tableau de board'])

@section('content')
<div id="overlay" class="overlay"></div>
<div class="container-fluid p-5">
    <div class="row">
        <div class="form-group col-md-12">
            <h2>Pro Sidebar</h2>
            <p>This is a responsive sidebar template with dropdown menu based on bootstrap framework.</p>

        </div>
        <div class="form-group col-md-12">
            <iframe
                src="https://ghbtns.com/github-btn.html?user=azouaoui-med&repo=pro-sidebar-template&type=star&count=true&size=small"
                frameborder="0" scrolling="0" width="100px" height="30px"></iframe>
            <iframe
                src="https://ghbtns.com/github-btn.html?user=azouaoui-med&repo=pro-sidebar-template&type=fork&count=true&size=small"
                frameborder="0" scrolling="0" width="100px" height="30px"></iframe>
        </div>

        <div class="form-group col-md-12">
            <a id="toggle-sidebar" class="btn btn-secondary rounded-0" href="#">
                <span>Toggle Sidebar</span>
            </a>
            <a id="pin-sidebar" class="btn btn-outline-secondary rounded-0" href="#">
                <span>Pin Sidebar</span>
            </a>

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-md-12">
            <h3>Themes</h3>
            <p>Here are more themes that you can use</p>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <a href="#" data-theme="default-theme" class="theme default-theme selected"></a>
            <a href="#" data-theme="chiller-theme" class="theme chiller-theme"></a>
            <a href="#" data-theme="legacy-theme" class="theme legacy-theme"></a>
            <a href="#" data-theme="ice-theme" class="theme ice-theme"></a>
            <a href="#" data-theme="cool-theme" class="theme cool-theme"></a>
            <a href="#" data-theme="light-theme" class="theme light-theme"></a>
        </div>
        <div class="form-group col-md-12">
            <p>You can also use background image </p>
        </div>
        <div class="form-group col-md-12">
            <a href="#" data-bg="bg1" class="theme theme-bg selected"></a>
            <a href="#" data-bg="bg2" class="theme theme-bg"></a>
            <a href="#" data-bg="bg3" class="theme theme-bg"></a>
            <a href="#" data-bg="bg4" class="theme theme-bg"></a>
        </div>
        <div class="form-group col-md-12">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="toggle-bg" checked>
                <label class="custom-control-label" for="toggle-bg">Background image</label>
            </div>
        </div>
        <div class="form-group col-md-12">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="toggle-border-radius">
                <label class="custom-control-label" for="toggle-border-radius">Border radius</label>
            </div>
        </div>

    </div>


    <hr>
    <div class="row ">
        <div class="form-group col-md-12">
            <small>Made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <span
                    class="text-secondary font-weight-bold">Mohamed
                    Azouaoui</span></small>
        </div>
        <div class="form-group col-md-12">
            <a href="https://github.com/azouaoui-med" target="_blank"
                class="btn btn-sm bg-secondary shadow-sm rounded-0 text-light mr-3 mb-3">
                <i class="fab fa-github" aria-hidden="true"></i>
            </a>
            <a href="https://twitter.com/azouaoui_med" target="_blank"
                class="btn btn-sm bg-secondary shadow-sm rounded-0 text-light mr-3 mb-3">
                <i class="fab fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="https://www.instagram.com/azouaoui_med/" target="_blank"
                class="btn btn-sm bg-secondary shadow-sm rounded-0 text-light mr-3 mb-3">
                <i class="fab fa-instagram" aria-hidden="true"></i>
            </a>
            <a href="https://www.linkedin.com/in/mohamed-azouaoui/" target="_blank"
                class="btn btn-sm bg-secondary shadow-sm rounded-0 text-light mr-3 mb-3">
                <i class="fab fa-linkedin-in" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>
@endsection