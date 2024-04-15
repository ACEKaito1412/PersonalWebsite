<script>
    var urlLocation = "<?= site_url() ?>"

    let theme = localStorage.getItem("theme");
    let stylesheet = document.getElementById("stylesheet");

    if (theme == "dark") {
        document.getElementById("light").style.color = "gray";
        document.getElementById("dark").style.color = "#faa356";
        stylesheet.setAttribute(
            "href",
            urlLocation + "public/theme-dark.css?version=3"
        );
    } else {
        document.getElementById("dark").style.color = "gray";
        document.getElementById("light").style.color = "#faa356";
        stylesheet.setAttribute(
            "href",
            urlLocation + "public/theme-light.css?version=3"
        );
    }

    function changeTheme(ev) {
        var target = ev.target;
        if (target.id == "dark") {
            target.style.color = "#faa356";
            document.getElementById("light").style.color = "gray";
            localStorage.setItem("theme", "dark");
            stylesheet.setAttribute(
                "href",
                urlLocation + "public/theme-dark.css?version=3"
            );
        } else {
            target.style.color = "#faa356";
            document.getElementById("dark").style.color = "gray";
            localStorage.setItem("theme", "light");
            stylesheet.setAttribute(
                "href",
                urlLocation + "public/theme-light.css?version=3"
            );
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="<?= site_url() ?>/public/js/utils.js?version=1"></script>
<script src="<?= site_url() ?>/public/js/create_post.js?version=8"></script>
<script>
    <?php
    if ($page == 'pages/openProject' && $admin) {
        if ($project['content'] == '') { ?>
            createTitleOne('Project Title');
            createParagraph('Overview');
            createParagraph('[Provide a brief overview of your project. What does it solve? What is its purpose?]');
            createTitleTwo('Key Features');
            createUIElement('Feature ');
            createTitleTwo('Technologies Used');
            createUIElement('Technology ');
            createTitleTwo('Demo');
            createParagraph('[If applicable provide a link to a live demo of your project.]');
            createTitleTwo('GitHub Repository');
            createParagraph('[Provide a link to the GitHub repository of your project for users who want to explore the code.]');
    <?php }
    }
    ?>
</script>

</body>

</html>