<section class="main">

    <ul class="ch-grid">

        <?php
        $encontrouImage = 0;
        $output = "";
        $files = scandir('images/');

        if (false !== $files) {
            foreach ($files as $file) {
                if ('.' !=  $file && '..' != $file && 'bg.jpg' != $file && 'noise.png' != $file && 'Thumbs.db' != $file) {
                    $encontrouImage++;

                    $output .= '<li>';
                    $output .= '<div class="ch-item">';
                    $output .= '<div class="ch-info">';
                    $output .= '<h3>Trevo News TV</h3>';
                    $output .= '<p>Se inscreva no canal <a href="https://www.youtube.com/channel/UChaU5MRijGF34Xyi6jRJo0g?sub_confirmation=1">Vamos lá</a></p>';
                    $output .= '</div>';
                    $output .= '<div class="ch-thumb ch-img-' . $encontrouImage . '"></div>';
                    $output .= '</div>';
                    $output .= '</li>';
                }
            }
        }

        echo $output;

        ?>


    </ul>

</section>

<script>
    $(".ch-img-0").css({
        'background-image': 'url(images/0.jpg)',
        'z-index': '12',
        'object-fit': 'fill'
    });
</script>

<?php

$encontrouScript = 0;

$files = scandir('images/');

if (false !== $files) {
    foreach ($files as $file) {
        if ('.' !=  $file && '..' != $file && 'bg.jpg' != $file && 'noise.png' != $file && 'Thumbs.db' != $file) {
            $encontrouScript++;
?>
            <script>
                $(".ch-img-<?= $encontrouScript; ?>").css({
                    'background-image': 'url(images/<?= $file; ?>)',
                    'z-index': '12-<?= $encontrouScript; ?>'
                });
            </script>
<?php

        }
    }
}

?>