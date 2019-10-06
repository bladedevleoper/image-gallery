<?php
require_once __DIR__ .  '/app/Classes/FileDirectoryChecker.php';
$file = new FileDirectoryChecker('images');
?>
<!doctype html>
<html>
    <head>
        <title>Building Image Gallery PHP and JS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="src/css/stylesheet.css"">
    </head>
    <body>

    <div class="container">

        <div class="row" id="image-board">

        </div>

    </div>


    <div id="box" hidden>
        <p>Hello</p>
    </div>

    <script>

        const jsonObject = '<?php $file->openFileDirectory(); ?>';
        const data = JSON.parse(jsonObject);

        document.addEventListener('DOMContentLoaded', () => {
            buildGallery(data);
            setEventListener('#image-board', 'click', show);
        });


        function buildGallery(data)
        {
            const target = document.querySelector('#image-board');

            data.forEach((image) => {
                const div = createElement('div');
                div.className = 'col-sm-5';
                const img = createElement('img');
                img.src = `${image.path}${image.file_name}`;
                img.className = 'img-thumbnail';

                div.appendChild(img);
                target.append(div);
            });

        }

        function createElement(element)
        {
            return document.createElement(`${element}`);
        }

        function setEventListener(div, type, func)
        {
            div = document.querySelector(div);
            div.addEventListener(`${type}`, (e) => {
                    //trigger(e);
                if (typeof func == 'function') {
                    func(e);
                }
            });
        }


        function show(element)
        {
          this.box = document.querySelector('#box');

          if (this.box.hasAttribute('hidden')) {
                this.box.removeAttribute('hidden');
                return;
          }

          this.box.setAttribute('hidden', 'true');
        }


    </script>
    </body>
</html>