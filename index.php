<?php
    // Controlla se i campi sono definiti
    $originalParagraph = isset($_GET['paragraph']) ? $_GET['paragraph'] : '';
    $badword = isset($_GET['badword']) ? $_GET['badword'] : '';
    $removeword = isset($_GET['removeword']) ? $_GET['removeword'] : '';
    $underline = isset($_GET['underline']) ? $_GET['underline'] : '';
    $replaceword = isset($_GET['replaceword']) ? $_GET['replaceword'] : '';
    $newword = isset($_GET['newword']) ? $_GET['newword'] : '';
    $censoredParagraph = $originalParagraph;

    // Sostituisce la parola solo se fornita
    if ($badword !== '') {
        $censoredParagraph = preg_replace_callback(
            '/\b' . preg_quote($badword, '/') . '\b/i',
            function ($matches) {
                // Calcola la lunghezza della parola e genera spazi neri
                return str_repeat('█', mb_strlen($matches[0])); // Usa il blocco nero Unicode
            },
            $originalParagraph
        );
    }

    // Rimuove la parola solo se fornita
    if ($removeword !== '') {
        $censoredParagraph = str_ireplace($removeword, '', $censoredParagraph);
    }

    if ($underline !== '') {
        $censoredParagraph = preg_replace('/\b' . preg_quote($underline, '/') . '\b/i', '<strong>' . $underline . '</strong>', $censoredParagraph);
    }

    // Sostituisce la parola con una nuova solo se entrambe sono fornite (case-insensitive)
    if ($replaceword !== '' && $newword !== '') {
        $censoredParagraph = str_ireplace($replaceword, $newword, $censoredParagraph);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Censorship</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <header>
        <div class="mx-auto p-2 mt-4" style="width: 200px;">
            <h1>
                Censorship
            </h1>
        </div>   
        </header>
        <main class="container-lg">
            <form action="?" method="get">
                <div class="mt-4">
                    <div>
                        <label for=""><h4>Testo da modificare</h4></label>
                    </div>
                    <textarea class="form-control" style="height: 100px" name="paragraph" id="paragraph" placeholder="Inserisci il testo ..."></textarea>
                </div>
                <div class="container text-center mt-4">
                    <div class="row">
                        <div class="col mt-4">
                            <div>
                                <label for="badword"><h4>Parola da censurare</h4></label>
                            </div>
                            <input type="text" name="badword" id="badword" placeholder="Inserisci parola...">
                        </div>
                        <div class="col mt-4">
                            <div>
                                <label for="removeword"><h4>Parola da eliminare</h4></label>
                            </div>
                            <input type="text" name="removeword" id="removeword" placeholder="Inserisci parola...">
                        </div>
                        <div class="col mt-4">
                            <div>
                                <label for="underline"><h4>Parola da evidenziare</h4></label>
                            </div>
                            <input type="text" name="underline" id="underline" placeholder="Inserisci parola...">
                        </div>
                        <div class="col mt-4">
                            <div>
                                <label for="replaceword"><h4>Parola da sostituire</h4></label>
                            </div>
                            <input type="text" name="replaceword" id="replaceword" placeholder="Parola da sostituire...">
                            <input type="text" name="newword" id="newword" placeholder="Nuova parola...">
                            <div>
                                <label for="newword"><h4>Nuova parola</h4></label>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto p-2 mt-4" >
                        <button class="btn btn-primary btn-lg" type="submit">Invia</button>
                    </div>
                </div>
            </form>
            <?php if ($originalParagraph !== '' || $badword !== ''): ?>
                <div class="mt-4" id="result">
                    <h4>Testo originale:</h4>
                    <p><?php echo $originalParagraph; ?></p>
                </div>
                <hr>
                <div class="mt-4" id="result">
                    <h4>Testo modificato:</h4>
                    <p><?php echo $censoredParagraph; ?></p>
                </div>
                <?php if ($badword !== ''): ?>
                    <div class="mt-4" id="result">
                        <h5>La parola "<?php echo $badword; ?>" è stata censurata <?php echo substr_count(strtolower($originalParagraph), strtolower($badword)); ?> volte nel testo.</h5>
                    </div>
                <?php endif; ?>
                <?php if ($removeword !== ''): ?>
                    <div class="mt-4" id="result">
                        <h5>La parola "<?php echo $removeword; ?>" è stata elimminata <?php echo substr_count(strtolower($originalParagraph), strtolower($removeword)); ?> volte nel testo.</h5>
                    </div>
                <?php endif; ?>
                <?php if ($underline !== ''): ?>
                    <div class="mt-4" id="result">
                        <h5>La parola "<?php echo $underline; ?>" è stata evidenziata <?php echo substr_count(strtolower($originalParagraph), strtolower($underline)); ?> volte nel testo.</h5>
                    </div>
                <?php endif; ?>
                <?php if ($replaceword !== '' && $newword !== ''): ?>
                    <div class="mt-4" id="result">
                        <h5>La parola "<?php echo $replaceword; ?>" è stata sostituita con "<?php echo $newword; ?>" <?php echo substr_count(strtolower($censoredParagraph), strtolower($newword)); ?> volte nel testo.</h5>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </main>
        <script>
            // Resetta i campi del form dopo il refresh
            document.getElementById('paragraph').value = "";
            document.getElementById('badword').value = "";
            document.getElementById('removeword').value = "";
            document.getElementById('underline').value = "";
            document.getElementById('replaceword').value = "";
            document.getElementById('newword').value = "";

            // Resetta le sezioni dei risultati
            const resultIds = [
                'result'
            ];

            resultIds.forEach(id => {
                const section = document.getElementById(id);
                if (section) {
                    section.innerHTML = ""; // Svuota il contenuto
                }
            });
        </script>
    </body>
</html>
