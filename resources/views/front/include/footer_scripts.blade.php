<script src="{{ asset('js/app.js') }}"></script>

<script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    $(document).ready(function() {

        $('.alert-component').delay('3000').fadeOut();

    })
</script>
<link rel="stylesheet" href="{{ asset('assets/plugins/ckeditor/plugins/codesnippet/lib/highlight/styles/dark.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
<script>hljs.initHighlightingOnLoad();</script>
