<?php
    // Controlla se i campi sono definiti
    $originalParagraph = isset($_GET['paragraph']) ? $_GET['paragraph'] : '';
    $badword = isset($_GET['badword']) ? $_GET['badword'] : '';
    $removeword = isset($_GET['removeword']) ? $_GET['removeword'] : '';
    $censoredParagraph = $originalParagraph;

    // Sostituisce la parola solo se fornita
    if ($badword !== '') {
        $censoredParagraph = str_replace($badword, '*****', $originalParagraph);
    }

    // Rimuove la parola solo se fornita
    if ($removeword !== '') {
        $censoredParagraph = str_replace($removeword, '', $censoredParagraph);
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
                            <button type="submit">Invia</button>
                        </div>
                        <div class="col mt-4">
                            <div>
                                <label for="removeword"><h4>Parola da eliminare</h4></label>
                            </div>
                            <input type="text" name="removeword" id="removeword" placeholder="Inserisci parola...">
                            <button type="submit">Invia</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php if ($originalParagraph !== '' || $badword !== ''): ?>
                <div class="mt-4">
                    <h4>Testo originale:</h4>
                    <p><?php echo $originalParagraph; ?></p>
                </div>
                <hr>
                <div class="mt-4">
                    <h4>Testo modificato:</h4>
                    <p><?php echo $censoredParagraph; ?></p>
                </div>
                <?php if ($badword !== ''): ?>
                    <div class="mt-4">
                        <h5>Parola censurata: <?php echo $badword; ?></h5>
                    </div>
                <?php endif; ?>
                <?php if ($removeword !== ''): ?>
                    <div class="mt-4">
                        <h5>Parola eliminata: <?php echo $removeword; ?></h5>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </main>
        <script>
            // Resetta i campi del form dopo il refresh
            document.getElementById('paragraph').value = "";
            document.getElementById('badword').value = "";
            document.getElementById('removeword').value = "";
        </script>
    </body>
</html>
