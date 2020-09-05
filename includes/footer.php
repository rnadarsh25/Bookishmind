<div id="footer">
            <h1>Copyright &copy; bookishmind 2020</h1>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
    $("#reg_head").click(function(){
        $("#signup").show(700);
        $("#login").hide();
    });

    $("#login_head").click(function(){
        $("#signup").hide();
        $("#login").show(700);
    });
})
</script>

</body>
</html>