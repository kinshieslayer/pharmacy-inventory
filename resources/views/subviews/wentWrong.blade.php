@include('subviews.header')

<div class="container">
    @if (session('accessError'))
        <div class="PageError">
            <img src="{{ asset('imgs/Not Authorized.png') }}" alt="Not Authorized">
            <span>
                <span class="error">Access Error!</span>
                You are not authorized to access this page...
            </span>
        </div>
    @else
        <img class="PnotFound" src="{{ asset('imgs/notFound.png') }}" alt="Page Not Found">
    @endif
</div>

<style>
    img {
        width: 55%;
        height: auto;
        margin: auto;
    }

    .container {
        user-select: none;
    }

    .PageError {
        width: 60%;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .PageError span {
        font-size: 50px;
        text-align: center;
        width: 150%;
        font-weight: bold;
        white-space: pre-line;
    }
</style>

<script>
    function prind() {
        window.print();
    }

    const img = document.querySelector('img');
    img.addEventListener('contextmenu', e => e.preventDefault());
    img.addEventListener('dragstart', e => e.preventDefault());
</script>
