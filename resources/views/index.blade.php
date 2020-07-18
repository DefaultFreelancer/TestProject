@extends('layouts.front')

@section('content')
    <!-- Banner -->
    <section id="banner">
        <h2><strong>Calendar</strong> Test project for creating events</h2>
        <p>This project for testing my skills</p>
        <ul class="actions">
            <li><a href="{{ route('login') }}" class="button special">Look up into the project</a></li>
        </ul>
    </section>

    <!-- One -->
    <section id="one" class="wrapper special">
        <div class="inner">
            <header class="major">
                <h2>Here we will explain the project</h2>
            </header>
            <div class="features">
                <div class="feature">
                    <i class="fa fa-diamond"></i>
                    <h3>Etiam consequat</h3>
                    <p>Sed tempus feugiat adipiscing nisl cursus aliquam dolore.</p>
                </div>
                <div class="feature">
                    <i class="fa fa-copy"></i>
                    <h3>Sed adipiscing</h3>
                    <p>Sed tempus feugiat adipiscing nisl cursus aliquam dolore.</p>
                </div>
                <div class="feature">
                    <i class="fa fa-paper-plane-o"></i>
                    <h3>Feugiat nullam</h3>
                    <p>Sed tempus feugiat adipiscing nisl cursus aliquam dolore.</p>
                </div>
                <div class="feature">
                    <i class="fa fa-save"></i>
                    <h3>Amet imperdiet</h3>
                    <p>Sed tempus feugiat adipiscing nisl cursus aliquam dolore.</p>
                </div>
                <div class="feature">
                    <i class="fa fa-envelope-o"></i>
                    <h3>Tempus lorem</h3>
                    <p>Sed tempus feugiat adipiscing nisl cursus aliquam dolore.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Two -->
    <section id="two" class="wrapper style2 special">
        <div class="inner narrow">
            <header>
                <h2>Get in touch</h2>
            </header>
            <form class="grid-form" method="post" action="#">
                <div class="form-control narrow">
                    <label for="name">Name</label>
                    <input name="name" id="name" type="text">
                </div>
                <div class="form-control narrow">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="email">
                </div>
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="4"></textarea>
                </div>
                <ul class="actions">
                    <li><input value="Send Message" type="submit"></li>
                </ul>
            </form>
        </div>
    </section>

@endsection
