<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ URL::asset('js/formValidation.js') }}" defer></script>
<script>
    const toastShow = function() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>
@if(session('toast'))
    <script>
    window.onload = function() {
        toastShow();
    }
    </script>
@endif