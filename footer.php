<footer>
    Volga Books&copy;
</footer>

<script>
    // For genre-chooser
    document.getElementById('genre-chooser').addEventListener('change', function () {
        window.location = "/search.php?genre=" + this.value;
    });
</script>
</body>
</html>
